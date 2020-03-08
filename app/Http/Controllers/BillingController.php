<?php

namespace App\Http\Controllers;

use App\Billing;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use Carbon\Carbon;

class BillingController extends Controller
{
    public function index(Request $request)
    {

        if($request->exists('date1'))
        {
            //dd($request->date1);
            $billing= new Billing();
            $date1=$request->date1;
            $date2=$request->date2;
            $bills=$billing->whereBetween('created_at', [$date1, $date2])->get();


        }

        else {
            $billing= new Billing();
      $date=Carbon::now()->format('Y-m-d');
      $report = [];
      $bills= $billing->whereDate('created_at', $date)->get();
     /*dd($bills->groupBy('Product_Type')->orderBy('desc'));

     foreach($bills as $bill){

      $reports = [
        'product_type' => $bill->Product_Type ,
        'Quantity'     => $bills->groupby('Product_Type')->sum('Quantity'),
        'Price'        => $bill->Products_Price_Perorder

      ];
    }*/
        }

        return view('billing')->with('bills',$bills);
    }

}

