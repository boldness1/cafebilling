<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Basket;
use App\Order;
use App\Customer;
use App\Drink;


class TakeOrderController extends Controller
{


    public function index(Request $request)
    {


       /* $food= new Food();

        $foods=$food->get()->toArray();

        return view('takeorder')->with('foods', $foods);*/
        $foods=[];
        $Category=$request->input('Food_Cat');
        $foods['category']=$Category;
        $food= new Food();
        $customer= new Customer();
        $customers=$customer->get();
        $allDrinks=$this->drinks();
       //dd($foods=$food->where('Category', $Category)->get()->toArray());
       $foods['list']=$food->where('Category', $Category)->get()->toArray();
      //  dd($foods);

        return view('takeorder')->with('foods', $foods)->with('customers', $customers)->with('allDrinks',$allDrinks);


    }


    public function get_order(Request $request){

    $valdator= $request->validate([
            'quantity' => 'required|integer',
            'desc'=>'max:255',
            's1'=>'max:20',
            's2'=>'max:20',
            's3'=>'max:20',
            's4'=>'max:20',
            's5'=>'max:20',
            'customer'=>'required|string|max:50',
            ]);
      $drink=$request->input('drink');
      $drinkQuantity = $request->input('drinkQuantity');

        $food=  Food::findOrFail($request->input('prod_id'));

        $basket = new Basket();
        $order= new Order();
        $drinkOrder = new Order();
        $newcustomer = new Customer();

        $basket->Product_Category=$food->Category;
        $basket->Product_Name=$food->Food_Type;
        $basket->Product_Description=$request->input('desc');
        $basket->Sauce1=$request->input('s1');
        $basket->Sauce2=$request->input('s2');
        $basket->Sauce3=$request->input('s3');
        $basket->Sauce4=$request->input('s4');
        $basket->Sauce5=$request->input('s5');
        $basket->Product_Prce=$food->Food_Price;

        $newcustomer->Customer_Name=$request->input('customer');

        $order->Product_ID=$request->input('prod_id');
        $order->Product_Quantity=$request->input('quantity');
        $order->Products_Price_Tot=$food->Food_Price*$order->Product_Quantity;

     $custom =Customer::where('Customer_Name',$newcustomer->Customer_Name)->get();

      if($custom->toArray()==null){

        $newcustomer->save();
        $newcustomer->order()->save($order);
        $newcustomer->basket()->save($basket);
        if( $this->wantsDrink($drink)){

            $drinkOrdered = Food::find($drink);
            $this->getDrink($newcustomer,$drinkOrdered,$drinkQuantity);
        }


    }


    else{
             foreach( $custom as $customer){
                    $customer->order()->save($order);
                    $customer->basket()->save($basket);
                }

                if( $this->wantsDrink($drink)){
                    $drinkOrdered = Food::find($drink);
                    $this->getDrink($customer,$drinkOrdered,$drinkQuantity);
                }

    }

        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        return response()->json($response);


    }
    public function wantsDrink($drinkset){

                if($drinkset!="")
                return true;
                else
                return false;



    }
    public function getDrink($customer,$drink,$drinkQuantity){

        $order = new Order;

        $order->Product_ID=$drink->id;
        $order->Product_Quantity=$drinkQuantity;
        $order->Products_Price_Tot=$drinkQuantity*$drink->Food_Price;
        $customer->order()->save($order);

    }

    public function drinks(){
        $food = new Food;
        $drinks = $food->where('Category','Cold-drinks')->get();

        return($drinks);
    }




}
