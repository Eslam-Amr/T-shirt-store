<?php

namespace App\Http\Controllers;

use App\Models\admin_design_request;
use App\Models\Designer;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class designerController extends Controller
{
    //
    function index()
    {
        $bestSeller = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.designer_id')
        ->where('orders.status', '=', 'completed')
        ->where('users.role', '=', 'designer')
        ->select('users.name' , 'orders.designer_id' ,DB::raw('SUM(orders.total) as total_sum'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('total_sum')
        ->limit(1)
        ->first();
        $bestSellerFlag=false;
        if($bestSeller->designer_id==auth()->user()->id)
        $bestSellerFlag=true;

        // dd($bestSeller);
        return view('designer.index',['bestSeller'=>$bestSellerFlag]);
    }
    function addDesign()
    {
        return view('designer.addDesign');
    }

    function imageProcessing($data, $folderName)
    {
        $image = $data->file('design');
        $ext = $image->getClientOriginalExtension();
        $img = time() . rand(10000, 20000) . rand(10000, 20000) . '.' . $ext;
        $image->move(public_path("uplode/$folderName"), $img);
        return $img;
    }
    function sendDesignRequest(Request $request)
    {
        $x = auth()->user();
        $request->validate([
            'designName' => 'required|min:3|max:30',
            'designCategory' => 'required',
            'design' => 'required|image|mimes:png,jpg,jpeg,gif|mimetypes:image/jpeg,image/png,image/gif',
            'price' => 'required',
            'discount' => 'required',
            'description' => 'required'
        ]);
        $imageName = $this->imageProcessing($request, 'RequestDesign');
        admin_design_request::create([
            'user_id' => $x['id'],
            'design_name' => $request->designName,
            'design_category' => $request->designCategory,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'design' => $imageName
        ]);
        return redirect()->back()->with('message', 'send successfly');
    }
    function message()
    {
        $messages = Message::where('user_id', auth()->user()['id'])->get()->all();
        return view('designer.message', ['messages' => $messages]);
    }
    public function displayProfit()
    {
        return view('designer.displayProfit');
    }
    public function displayYearProfit()
    {
        $yearProfit = [];
        for ($year = now()->year; $year >= now()->year - 4; $year--) {
            $completedOrdersCount = Order::where('year', $year)->where('status', 'completed')->where('designer_id', auth('designer')->user()->id)->sum('total');
            $yearProfit[$year] = $completedOrdersCount;
        }
        return view('designer.displayYearProfit', ['profit' => $yearProfit]);
    }
    public function displayMonthProfit()
    {
        $monthProfit = [];
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        foreach ($months as $month) {
            $monthProfit[strtolower($month)] = Order::where('month', $month)->where('status', 'completed')->where('designer_id', auth('designer')->user()->id)->sum('total');
        }
        return view('designer.displayMonthProfit', ['profit' => $monthProfit]);
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
            $profit = $this->calculateProfitForDay($day);
            $monthProfit[$day] = $profit;
        }
        return view('designer.displayDayProfit', ['monthProfit' => $monthProfit]);
    }
    function calculateProfitForDay($day)
    {
        return Order::where('day', $day)->where('status', 'completed')->where('designer_id', auth('designer')->user()->id)->sum('total');
    }
}
