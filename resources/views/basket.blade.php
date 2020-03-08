@extends('/layouts/app')

@section('maincontent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container-fluid bg-light " id="flscr">
    <hr style="border:2px solid green">

    <div class="row">

        <div class="col-md-4 "><img src="{{asset("imgs/adto_logo.jpg")}}" class="img-circle" width="100" height="80"></div>
        <div class="col-md-4 "><h1>Basket</h1></div>
    </div>
    <hr style="border:2px solid green">
    <div class="row">
        @foreach($customers as $customer)


    <div class="col-md-3 top-buffer" style="background-color:rgb(129, 165, 137); border-radius:20px; left:5%" id="{{$customer->id}}">
            <strong>Holy Cafe</strong>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <h1>{{$customer->Customer_Name}}</h1>
                </div>
                <div class="col-md-4">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a type="button" href="basket/remove_basket/{{$customer->id}}" class="btn btn-danger btn-sm border-radius:60px; " style="color:#fff;">Remove</a>
                </div>
                </div>

                    <table  class="table table-striped">
                        <thead>

                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->order as $order)
                            <tr>
                                <td scope="col" ><em>{{$foods->find($order->Product_ID)->Food_Type}}</em></h4></td>
                                <td scope="col" class="text-center">{{$order->Product_Quantity}} </td>
                                <td scope="col" class=" text-center">{{$foods->find($order->Product_ID)->Food_Price}} TL</td>
                                <td scope="col" class=" text-center">{{$order->Product_Quantity*$foods->find($order->Product_ID)->Food_Price}} TL</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td scope="col"></td>
                                <td scope="col"></td>
                                <td scope="col" class="text-right"><h4><strong>Total:</strong></h4></td>
                                <td scope="col" class="text-center text-danger"><h4><strong>{{$customer->order->sum('Products_Price_Tot')}}</strong></h4></td>
                            </tr>
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Sauces</th>
                                    <th scope="col" class="text-center">Description</th>

                                </tr>
                            </thead>
                            <tr>
                                @foreach($customer->basket as $basket)
                                @if($basket->Product_Description!="" || $basket->Sauce2!="" ||$basket->Sauce3!="" || $basket->Sauce4!="" ||$basket->Sauce5!="" || $basket->Sauce1!="")
                                <td scope="col" >{{$basket->Product_Name}}</td>
                                <td scope="col" > {{$basket->Sauce1}} {{$basket->Sauce2}} {{$basket->Sauce3}} {{$basket->Sauce4}} {{$basket->Sauce5}}   </td>
                                <td scope="col" >{{$basket->Product_Description}}</td>
                                </tr>
                                @endif
                                    @endforeach

                                    <tr><td scope="col"> <button class="btn btn-success" id="markSold" onclick="markAsSold({{$customer->id}})" >Mark Completed</button></td><td scope="col" id="msgDone"></td scope="col"><td scope="col"></td scope="col"><td scope="col">
                                 <a type="button" href="basket/sell_basket/{{$customer->id}}" class="btn btn-info btn-md border-radius:60px; " style="color:#ddd; ">
                                    <strong style="color:blue">Sell</strong>
                                 </a>
                                   </td></tr>

                        </tbody>

                    </table>

                </div>
                &nbsp;&nbsp;&nbsp;


        @endforeach

    </div>










</div>
<script>
 function markAsSold(divId){
     document.getElementById(divId).style.backgroundColor= "#F56141";
     document.getElementById("msgDone").innerText="Awaiting For Some Juicy Cash...";
 }
  var elem = document.documentElement;
  var elem1= document.getElementById('flscr');
    $(window).on("load",function () {

       if ($(window).width() <= 768){

           if (elem.requestFullscreen || elem.webkitRequestFullscreen) {
    //elem.requestFullscreen();
     elem1.webkitRequestFullscreen();
  } else if (elem.mozRequestFullScreen) {
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen();
  }

        }


    });


    </script>


@endsection
