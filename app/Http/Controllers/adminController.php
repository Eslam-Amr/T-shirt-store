<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Order;
use Illuminate\Support\Str;

use App\Http\Requests\userDataUpdateRequest;
use App\Models\Admin;
use App\Models\admin_design_request;
use App\Models\Designer;
use App\Models\Message;
use App\Models\Order_products;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\ToBeDesigner;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    //
    function index()
    {
        return view('admin.index');
    }
    function displayUser()
    {
        $users = User::where('role', 'user')->paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'users'
        );
        return view('admin.displayUser', ['users' => $users]);
    }
    function displayDesigner()
    {
        $designers = Portfolio::join('users', 'users.id', '=', 'portofolios.user_id')
            ->where('users.role', '=', 'designer')
            ->select('users.name', 'portofolios.portfolio', 'users.id', 'users.email', 'users.phone')
            ->paginate(12);
        return view('admin.displayDesigner', ['designers' => $designers]);
    }
    public function deleteDesigner($id)
    {
        $designer = Designer::where('name', '=', $id)->first();
        Portfolio::where('user_id', $designer['id'])->delete();
        if ($designer) {
            $designer->role = 'user';
            $designer->save();
            return redirect()->back()->with('message', 'Designer status edited successfully');
        } else {
            return redirect()->back()->with('message', 'Designer not found');
        }
    }
    function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->to('/admin/user')->with('message', 'deleted successfly');
    }
    function updateUserForm($id)
    {
        $user = User::find($id);
        return view('admin.userUpdateForm', ['user' => $user]);
    }
    function updateUser($id, UpdateUserRequest $request)
    {
        $request->only('name', 'email', 'phone');
        User::find($id)->update($request->except('token', 'image', 'password'));
        return redirect()->to('/admin/user')->with('message', 'updated successfly');
    }
    function displayDesignerRequest()
    {
        $usersId = ToBeDesigner::select('user_id', 'portfolio')->get()->all();
        $users = [];
        foreach ($usersId as $userId) {
            $user = User::where('id', $userId['user_id'])->first();
            if ($user) {
                $userWithPortfolio = $user->toArray() + ['portfolio' => $userId['portfolio']];
                $users[] = $userWithPortfolio;
            }
        }
        return view('admin.displayDesignerRequest', ['users' => $users]);
    }
    function designerConfirmed($id)
    {
        User::where('id', $id)->update(['role' => 'designer']);
        $Portfolio = ToBeDesigner::select('Portfolio')->where('user_id', $id)->first()['Portfolio'];
        Portfolio::create(['user_id' => $id, 'Portfolio' => $Portfolio]);
        ToBeDesigner::where('user_id', $id)->delete();
        return redirect()->back()->with('message', 'confirmed successfly');
    }
    function displayDesignRequest()
    {
        $designs = admin_design_request::paginate(12);
        return view('admin.designRequest', ['designs' => $designs]);
    }
    function showSpecificDesign($id)
    {
        $design = admin_design_request::where('id', $id)->first();
        $description = admin_design_request::select('description')->where('id', $id)->first()['description'];
        return view('admin.showSpecificDesign', ['design' => $design, 'description' => $description]);
    }
    function rejectSpecificDesign($id)
    {
        Message::create([
            'user_id' => admin_design_request::select('user_id')->where('id', $id)->first()['user_id'],
            'message' => 'your design has been reject'
        ]);
        admin_design_request::where('id', $id)->delete();
        return redirect()->to('admin/designRequest')->with('message', 'deleted successfly');
    }
    function addSpecificDesign(AddProductRequest $request, $id)
    {
        $design = admin_design_request::where('id', $id)->first();
        $category_id = Helper::getCategoryId($design['design_category']);
        // dd($design['design_category'],$category_id);
        $stock = $request->all()['stock'];
        Helper::setProduct($stock, $design, $category_id);
        admin_design_request::where('id', $id)->delete();
        return redirect()->to('admin/designRequest')->with('message', 'added successfly');
    }
    public function displayOrder()
    {
        $orders = Order_products::join('orders', 'order_products.order_id', '=', 'orders.id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('orders.*', 'products.*', 'order_products.order_id', 'order_products.product_id', 'orders.status as orderStatus')
            ->paginate(12);
        return view('admin.displayOrder', ['orders' => $orders]);
    }
    public function displayProfit()
    {
        $totalProfit = Order::where('status', 'completed')->sum('total');
        return view('admin.displayProfit', ['totalProfit' => $totalProfit]);
    }
    public function designerProfit()
    {

        $result = DB::table('orders')
            ->join('users', 'orders.designer_id', '=', 'users.id')
            ->where('orders.status', '=', 'completed')
            ->where('users.role', '=', 'designer')
            ->select(DB::raw('SUM(orders.total) as total_sum'), 'users.name')
            ->groupBy('users.name')
            ->orderBy('users.name')
            ->paginate(12);
        $bestSeller = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.designer_id')
            ->where('orders.status', '=', 'completed')
            ->where('users.role', '=', 'designer')
            ->select('users.name', DB::raw('SUM(orders.total) as total_sum'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_sum')
            ->limit(1)
            ->first();
        return view('admin.designerProfit', ['profits' => $result, 'bestSeller' => $bestSeller]);
    }
    public function displayYearProfit()
    {
        $yearProfit = [];
        for ($year = now()->year; $year >= now()->year - 4; $year--) {
            $completedOrdersCount = Order::where('year', $year)->where('status', 'completed')->sum('total');
            $yearProfit[$year] = $completedOrdersCount;
        }
        return view('admin.displayYearProfit', ['profit' => $yearProfit]);
    }
    public function displayMonthProfit()
    {
        $monthProfit = [];
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        foreach ($months as $month) {
            $monthProfit[strtolower($month)] = Order::where('month', $month)->where('status', 'completed')->sum('total');
        }
        return view('admin.displayMonthProfit', ['profit' => $monthProfit]);
    }
    public function displayDayProfit()
    {
        $monthProfit = [];
        $currentYear = date('Y');
        $currentMonth = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        for ($day = 1; $day <= $daysInMonth; $day++) {
            if ($currentMonth == 2 && date('L', strtotime("$currentYear-01-01")) && $day == 29) {
                continue;
            }
            $profit = Helper::calculateProfitForDay($day);
            $monthProfit[$day] = $profit;
        }
        return view('admin.displayDayProfit', ['monthProfit' => $monthProfit]);
    }
    public function rejectOrder($id)
    {
        Helper::editOrderStatus($id, 'rejected');
        return redirect()->back()->with('message', 'status edited successfully');
    }
    public function shippingOrder($id)
    {
        Helper::editOrderStatus($id, 'shipping');
        return redirect()->back()->with('message', 'status edited successfully');
    }
    public function completeOrder($id)
    {
        Helper::editOrderStatus($id, 'completed');
        return redirect()->back()->with('message', 'status edited successfully');
    }
}
