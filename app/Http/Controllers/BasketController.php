<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Basket;
use App\Billing;
use App\Order;
use App\Customer;
class BasketController extends Controller
{
    public function index()
    {
        $basket = new Basket;
        $Baskets=$basket->all();
       $customer= new Customer();
       $customers=$customer->orderBy('created_at','DESC')->get();
    $food= new Food();
    $foods=$food->all();
    $tot=0;

      /*foreach($foods as $food)
       dd($food->Food_Type);*/
//dd($orders);

          return view('basket')->with('customers',$customers)->with('foods',$foods);


    }
    public function addBill($customer,$orders){


                    foreach($orders as $order){
                $bill=new Billing();
                $bill->Product_Type=Food::find($order->Product_ID)->Food_Type;
                $bill->Quantity=$order->Product_Quantity;
                $bill->Products_Price_Perorder=$order->Products_Price_Tot;
                $bill->save();
            }

                $customer->delete();
    }


    public function sell_basket(Request $request)
    {


         $customer= Customer::find($request->id);
         $this->addBill($customer,$customer->order);

         return redirect('basket');




    }
    public function remove_basket(Request $request){
        $customer= Customer::find($request->id);
        $customer->delete();
        return redirect('basket');

    }


}
