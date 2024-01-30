<?php

namespace App\Http\Controllers;

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
        // $users=User::paginate(5);
        $users = User::where('role', 'user')->paginate(
            $perPage = 5,
            $columns = ['*'],
            $pageName = 'users'
        );
        return view('admin.displayUser', ['users' => $users]);
    }
    function displayDesigner()
    {
        // $designers = designer::paginate(5);
    //     $designers = Portfolio::join('users', 'users.id', '=', 'portofolios.user_id')
    // ->select('users.name', 'portofolios.portfolio','portofolios.user_id', 'users.email', 'users.phone')
    // ->paginate(12);
    $designers = Portfolio::join('users', 'users.id', '=', 'portofolios.user_id')
    ->where('users.role', '=', 'designer')
    ->select('users.name', 'portofolios.portfolio', 'users.id', 'users.email', 'users.phone')
    ->paginate(12);
        // $designers = designer::where('role', 'user')->paginate(
        //     $perPage = 5, $columns = ['*'], $pageName = 'designers'
        // );
        // dd($designers);
        // dd($results);
        return view('admin.displayDesigner', ['designers' => $designers]);
    }
    // public function deleteDesigner($id){

    //     // dd(Designer::where('role','designer')->first());
    //     $designer = User::where('id', $id)->first();
    //     dd($id);
    //     $designer->role = 'user';
    //     $designer->save();
    //     // dd($id);
    //     return redirect()->back()->with('message', 'status edited successfully');

    //     dd($id);
    // }



    public function deleteDesigner($id){
        // Retrieve the designer by ID
        // dd($id);
        $designer = Designer::where('name','=', $id)->first();
        // dd($designer['id']);

        // Dump the designer variable to see its details
        // dd(Portfolio::where('user_id',$designer['id'])->get());
        Portfolio::where('user_id',$designer['id'])->delete();
        // Check if the designer exists
        if ($designer) {
            // Update the role to 'user'
            $designer->role = 'user';
            $designer->save();

            // Redirect back with a success message
            return redirect()->back()->with('message', 'Designer status edited successfully');
        } else {
            // Redirect back with an error message if the designer is not found
            return redirect()->back()->with('message', 'Designer not found');
        }
    }





    function deleteUser($id)
    {
        // dd($id);
        User::find($id)->delete();
        return redirect()->to('/admin/user')->with('message', 'deleted successfly');
    }
    function updateUserForm($id)
    {
        // dd($id);
        $user = User::find($id);
        return view('admin.userUpdateForm', ['user' => $user]);
    }
    function updateUser($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3|max:15',
            'phone' => 'required|numeric|min_digits:11|max_digits:11',
        ]);
        $request->only('name', 'email', 'phone');
        User::find($id)->update($request->except('token', 'image', 'password'));
        return redirect()->to('/admin/user')->with('message', 'updated successfly');
    }
    function displayDesignerRequest()
    {
        $usersId = ToBeDesigner::select('user_id', 'portfolio')->get()->all();
        // dd($usersId);
        // $users=[];
        // foreach($usersId as $userId){

        //     $user=User::where('id',$userId['user_id'])->first();
        //     $users.append($user);
        // }
        // $users = [];

        // foreach ($usersId as $userId) {
        //     $user = User::where('id', $userId['user_id'])->first();
        //     if ($user) {
        //         $users[] = [$user + $userId['portfolio']];
        //     }
        // }
        $users = [];

        foreach ($usersId as $userId) {
            $user = User::where('id', $userId['user_id'])->first();
            if ($user) {
                $userWithPortfolio = $user->toArray() + ['portfolio' => $userId['portfolio']];
                $users[] = $userWithPortfolio;
            }
        }
        // dd($userId['user_id']);
        // dd($users);

        // $users=User::where('id','3549ce7b-414a-345c-b7df-01fbf60d82c7')->get()->all();
        // $user = User::first();

        // dd($users);
        return view('admin.displayDesignerRequest', ['users' => $users]);
    }
    function designerConfirmed($id)
    {
        // dd($id);
        User::where('id', $id)->update(['role' => 'designer']);
        $Portfolio = ToBeDesigner::select('Portfolio')->where('user_id', $id)->first()['Portfolio'];
        // dd($Portfolio);
        Portfolio::create(['user_id' => $id, 'Portfolio' => $Portfolio]);
        ToBeDesigner::where('user_id', $id)->delete();
        return redirect()->back()->with('message', 'confirmed successfly');

        // $usersId = ToBeDesigner::select('user_id')->get()->all();
        // dd($usersId);
        // $users=[];
        // foreach($usersId as $userId){

        //     $user=User::where('id',$userId['user_id'])->first();
        //     $users.append($user);
        // }
    }
    function displayDesignRequest()
    {
        // designRequest
        $designs = admin_design_request::paginate(5);
        // dd($designs);
        return view('admin.designRequest', ['designs' => $designs]);
    }
    function showSpecificDesign($id)
    {
        // dd($id);
        $design = admin_design_request::where('id', $id)->first();
        $description = admin_design_request::select('description')->where('id', $id)->first()['description'];
        // dd($description);
        return view('admin.showSpecificDesign', ['design' => $design, 'description' => $description]);
    }
    function rejectSpecificDesign($id)
    {
        // (sdafasafdfsahuuuuuuuuuuuuuuuuu);
        // dd('kk');
        // dd($id);
        // dd(admin_design_request::select('user_id')->where('id',$id)->first()['user_id']);
        // admin
        Message::create([
            'user_id' => admin_design_request::select('user_id')->where('id', $id)->first()['user_id'],
            'message' => 'your design has been reject'
        ]);
        admin_design_request::where('id', $id)->delete();
        return redirect()->to('admin/designRequest')->with('message', 'deleted successfly');
    }
    function addSpecificDesign(Request $request, $id)
    {
        $design = admin_design_request::where('id', $id)->first();
        // dd($design);
        // (sdafasafdfsahuuuuuuuuuuuuuuuuu);
        $request->validate([
            'stock' => 'required',
        ]);
        $category_id=0;
        if($design['design_category']=='men')
        $category_id=1;
        else if($design['design_category']=='women')
        $category_id=2;
        else if($design['design_category']=='kids')
        $category_id=3;
        // dd($design['design_category']);
        // $x = auth()->user();
        // dd($x['id']);
        // dd($design['user_id']);
        // $user = auth()->user();
        // $numericId = Str::uuid($user['id'])->getHex();
        // // dd($numericId);
        // $numericId = hexdec($numericId);
        // dd($numericId);
        $stock = $request->all()['stock'];
        // dd($request->all()['stock']);
        // dd($design);
        Product::create([
            'stock' => $stock,
            'discount' => $design['discount'],
            'price' => $design['price'],
            'price_after_discount' => $design['price'] * (1 - ($design['discount'] / 100)),
            'name' => $design['design_name'],
            'desinger' => $design['design_name'],
            'bestSeller' => 0,
            'image' => $design['design'],
            // 'category'=>$design['design_category'],
            'category_id' => $category_id,
            'designer_id' => $design['user_id'],
            'status' => 'pending',
            'description' => $design['description'],
            // 'designer_id'=>
        ]);
        Message::create([
            'user_id' => $design['user_id'],
            'message' => 'congratulation 🎉 your design have been approved'
        ]);
        admin_design_request::where('id', $id)->delete();
        return redirect()->to('admin/designRequest')->with('message', 'added successfly');
        // dd($id);
        // admin_design_request::where('id',$id)->delete();
        // return redirect()->to('admin/designRequest')->with('message', 'deleted successfly');

    }
    public function displayOrder()
    {
        // $orders = Order_products::join('orders', 'order_products.order_id', '=', 'orders.id')
        //     ->join('products', 'order_products.product_id', '=', 'products.id')
        //     ->select('orders.*', 'products.*', 'order_products.order_id', 'order_products.product_id')
        //     ->get();
        $orders = Order_products::join('orders', 'order_products.order_id', '=', 'orders.id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('orders.*', 'products.*', 'order_products.order_id', 'order_products.product_id', 'orders.status as orderStatus')
            ->paginate(12);

        //     dd($currentMonth = now()->format('F')
        // ,$currentYear = now()->format('Y'),$currentDayOfWeek = now()->format('l'));
        // dd($orders);
        return view('admin.displayOrder', ['orders' => $orders]);
    }
    public function displayProfit()
    {
        //     $result = DB::table('orders')
        // ->join('users', 'orders.designer_id', '=', 'users.id')
        // ->orderBy('users.name')
        // ->select(DB::raw('SUM(orders.total) as total_sum'), 'orders.total', 'orders.designer_id', 'users.name')
        // ->groupBy('orders.total', 'orders.designer_id', 'users.name')
        // ->get();
        // $result = DB::table('orders')
        // ->join('users', 'orders.designer_id', '=', 'users.id')
        // ->where('orders.status', '=', 'completed')
        // ->orderBy('users.name')
        // ->select(DB::raw('SUM(orders.total) as total_sum'), 'orders.total', 'orders.designer_id', 'users.name')
        // ->groupBy('orders.total', 'orders.designer_id', 'users.name')
        // ->get();
        $totalProfit = Order::where('status', 'completed')->sum('total');
        return view('admin.displayProfit', ['totalProfit' => $totalProfit]);
    }
    public function designerProfit()
    {
        $result = DB::table('orders')
            ->join('users', 'orders.designer_id', '=', 'users.id')
            ->where('orders.status', '=', 'completed')
            ->where('users.role', '=', 'designer')
            ->orderBy('users.name')
            ->select(DB::raw('SUM(orders.total) as total_sum'), 'orders.total', 'orders.designer_id', 'users.name')
            ->groupBy('orders.total', 'orders.designer_id', 'users.name')
            ->paginate(12);

        // dd($result);
        return view('admin.designerProfit', ['profits' => $result]);
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
        // dd( date('j'));
        $monthProfit = [];
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Get the number of days in the current month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        // Loop through each day in the current month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // Handle leap year for February
            if ($currentMonth == 2 && date('L', strtotime("$currentYear-01-01")) && $day == 29) {
                continue; // Skip February 29 for non-leap years
            }

            // Replace the following sample data with your actual data retrieval logic
            $profit = $this->calculateProfitForDay($day);

            // Store the profit in the array
            $monthProfit[$day] = $profit;
        }
        // dd($monthProfit);
        return view('admin.displayDayProfit', ['monthProfit' => $monthProfit]);
    }
    function calculateProfitForDay($day)
    {

        return Order::where('day', $day)->where('status', 'completed')->sum('total');
    }
    public function rejectOrder($id)
    {
        $this->editOrderStatus($id, 'rejected');
        return redirect()->back()->with('message', 'status edited successfully');
    }
    public function shippingOrder($id)
    {
        $this->editOrderStatus($id, 'shipping');
        return redirect()->back()->with('message', 'status edited successfully');
    }
    public function completeOrder($id)
    {
        $this->editOrderStatus($id, 'completed');
        return redirect()->back()->with('message', 'status edited successfully');
    }
    public function editOrderStatus($id, $status)
    {
        $order = Order::where('id', $id)->first();
        $order->status = $status;
        $order->save();
    }
}
