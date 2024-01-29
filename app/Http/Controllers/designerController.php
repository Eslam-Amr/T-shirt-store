<?php

namespace App\Http\Controllers;

use App\Models\admin_design_request;
use App\Models\Designer;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class designerController extends Controller
{
    //
    function index()
    {
        return view('designer.index');
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
        // dd("eslam");
        // $x=auth()->user('designer');
        // dd($x['id']);
        //         $designers = Designer::where('role', 'designer')->get();
        // $designerIds = $designers->pluck('id');
        // dd($designerIds);

        $x = auth()->user();
        // dd($x);
// dd( implode('-',$x->id));

        // $x = auth()->user();
        // dd($x->email);
        // dd(Designer::where('email',$x->email)->first()['id']);
// $designerUsers = auth()->user('designer');

// foreach ($designerUsers as $designerUser) {
    // dd($designerUsers);
    // }
    // foreach($x as $val =>$key){
    //     dump($key,$val);
    // }
    // die;
// dd($x['id']);

    $request->validate([
        'designName' => 'required|min:3|max:30',
        'designCategory' => 'required|min:3|max:30',
        'design' => 'required|image|mimes:png,jpg,jpeg,gif|mimetypes:image/jpeg,image/png,image/gif',
        'price'=>'required',
        'discount'=>'required',
        'description'=>'required'
        ]);
        // dd("eslam");
        $imageName = $this->imageProcessing($request, 'RequestDesign');
        admin_design_request::create([
            // 'user_id' => Designer::where('email',$x->email)->first()['id'],
            'user_id' =>'16dff78c-f4cb-3818-9de2-3cccf6492265',
            'design_name' => $request->designName,
            'design_category' => $request->designCategory,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'design' => $imageName
        ]);
        // return redirect()->route('admin.addBanner')->with('message', 'added successfly');
        return redirect()->back()->with('message', 'send successfly');
    }
    function message(){
        // dd('slkdfnk');
        $messages=Message::where('user_id',auth()->user()['id'])->get()->all();
    // dd(auth()->user()['id']);
        return view('designer.message',['messages'=>$messages]);
    }



    public function displayProfit()
    {
        return view('designer.displayProfit');
    }
    public function displayYearProfit()
    {
//         dd(Designer::where('id',auth('designer')->user()->id)->first());
//         dd();
//         $userIds = \App\Models\User::pluck('id')->toArray();
// dd($userIds);

//         $users = auth()->user(); // Assuming you're getting a collection of users

// foreach ($users as $user) {
//     dd((string)$user->id);
// }

        // dd((string)auth()->user()->id);
//         $user = auth()->user();
// dd((string)$user->id);

        // $userIds = auth()->user()->pluck('id')->toArray();
        // dd($userIds);

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
        return view('designer.displayDayProfit', ['monthProfit' => $monthProfit]);
    }
    function calculateProfitForDay( $day) {

        return Order::where('day', $day)->where('status', 'completed')->where('designer_id', auth('designer')->user()->id)->sum('total');
    }



}
