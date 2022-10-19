<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\stock_quote;
use Calendar;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       $records=stock_quote::orderBy('id','desc');

       if (!empty($request->search)) {
           $records= $records
           ->orWhere('date','like','%' . $request->search . '%');
       }

       $records= $records
       ->select('id','quote_symbol',
        'quote_open',
        'quote_high',
        'quote_low',
        'quote_price',
        'quote_volume',
        'quote_latest_trading_day',
        'quote_previous_close',
        'quote_change',
        'quote_change_percent')
       ->paginate(25);



       return view('frontend.home',compact('records'));

   }



   public function store_stock_quote(Request $request)
   {

       $data = array(    
        'quote_symbol'=>$request->input('quote_symbol'),
        'quote_open'=>$request->input('quote_open'),
        'quote_high'=>$request->input('quote_high'),
        'quote_low'=>$request->input('quote_low'),
        'quote_price'=>$request->input('quote_price'),
        'quote_volume'=>$request->input('quote_volume'),
        'quote_latest_trading_day'=>$request->input('quote_latest_trading_day'),
        'quote_previous_close'=>$request->input('quote_previous_close'),
        'quote_change'=>$request->input('quote_change'),
        'quote_change_percent'=>$request->input('quote_change_percent'),
    );
       $stock_quote = new stock_quote($data);
       $stock_quote->save();
       


       $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

       return Redirect::back()->with($notification);

   }


   public function destroy(Request $request)
   {
       $stock_quote = stock_quote::find($request->id);
       $stock_quote->delete();

       return $stock_quote;
   }

}
