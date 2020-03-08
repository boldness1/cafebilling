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

        if($request->exists('date1') && $request->input('date1')!=null && $request->exists('date2') && $request->input('date2')!=null && $request->input('date1') < $request->input('date2'))
        {
            //dd($request->date1);
            $billing= new Billing();
            $date1=$request->date1;
            $date2=$request->date2;
            $biller=$billing->whereBetween('created_at', [$date1, $date2])->get()->groupby('Product_Type');
            $bills    =$this->getReport($biller);
            $Total    =$this->getTotalBill($bills);

        }

        else {
            $billing= new Billing();
      $date=Carbon::now()->format('Y-m-d');

     // $bills= $billing->whereDate('created_at', $date)->get();
      $biller   = $billing->whereDate('created_at', $date)->get()->groupby('Product_Type');
      $billTotal=$billing->whereDate('created_at', $date)->get();
      $bills    =$this->getReport($biller);
      $Total    =$this->getTotalBill($bills);


        }

        return view('billing')->with('bills',$bills)->with('Total',$Total);
    }

    public function getReport($bills){
     $Total = 0;
     foreach($bills as $bill){
        foreach($bill as $b){

        }
            $billVals[] = [
                'Product_Type' =>  $b->Product_Type,
                'Quantity'     =>  $bill->sum('Quantity'),
                'Products_Price_Perorder' => $b->Products_Price_Perorder/$b->Quantity*$bill->sum('Quantity')

              ];

      }
     return $billVals;
    }
public function getTotalBill($bills){
    $Total= 0;
    foreach($bills as $bill){
        $Total += $bill['Products_Price_Perorder'];


    }

    return $Total;
}

}



