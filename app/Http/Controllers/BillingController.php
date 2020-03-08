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

     // $bills= $billing->whereDate('created_at', $date)->get();
      $biller= $billing->whereDate('created_at', $date)->get()->groupby('Product_Type');
      $billTotal =$billing->whereDate('created_at', $date)->get();
      $Total=$billTotal->sum('Products_Price_Perorder');
      $Quantity = $billTotal->sum('Products_Price_Perorder');
      $bills=$reports=$this->getReport($biller);


        }

        return view('billing')->with('bills',$bills)->with('Total',$Total);
    }

    public function getReport($bills){
     $Total = 0;
     foreach($bills as $bill){
        foreach($bill as $b){

        }
            $reports[] = [
                'Product_Type' =>  $b->Product_Type,
                'Quantity'     =>  $bill->sum('Quantity'),
                'Products_Price_Perorder' => $b->Products_Price_Perorder/$b->Quantity*$bill->sum('Quantity')

              ];

      }
     return $reports;
    }


}


