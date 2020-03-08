<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Order;
use App\Customer;
class FoodController extends Controller
{
    public function index(Request $request)
    {
        $Category=$request->input('Category');
        $food= new Food();
        $foods=$food->where('Category', $Category)->get();
        //  dd($foods);
          return view('addto')->with('foods', $foods);



    }


    public function NewFood(Request $request)
    {
       // dd($request->input());
       $request->validate([
        'FoodName' => 'required|string|max:255',
        'Category'=>'required|string|max:255',
        'FoodPrice'=>'required|numeric', ]);

        $food= new Food();
        $food->Category=$request->input('Category');
        $food->Food_Type=$request->input('FoodName');
        //dd($sandwich->SandwichType);
        $food->Food_Price=$request->input('FoodPrice');
        $food->Food_IMG_ID="";
        $food->save();
        return redirect('addto');



    }
    public function RemoveFood(Request $request)
    {
       // dd($request->input());

       $request->message='successfull';
       $response = array(
        'status' => 'success',
        'msg' => $request->message,
    );
    $id=$request->input('id');
    $food=  Food::findOrFail($id);

    $food->delete();


    return response()->json($response);




    }


}
