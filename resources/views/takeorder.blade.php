@extends('/layouts/app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('maincontent')



<div class="container-fluid bg-light ">
        <hr style="border:2px solid green">
        <div class="row">
            <div class="col-md-4 "><img src="{{asset("imgs/adto_logo.jpg")}}" class="img-circle" width="100" height="80"></div>
            <div class="col-md-4 "><h1>Take Order</h1></div>
        </div>
        <hr style="border:2px solid green">

        <div class="row">
                <div class="col-md-4 ">
                        <div class="form-group">

                                <label>Choose The Product Category:</label>

                                <form action="takeorder" method="GET">
                                    @csrf
                                <select class="form-control" id="sel1" onchange="myfunction()" name="Food_Cat" >
                                  <option selected="selected">Choose Category</option>
                                  <option>Sandwiches</option>
                                  <option>Salads</option>
                                  <option>Soups</option>
                                  <option>Deserts</option>
                                  <option>Cold-Drinks</option>
                                  <option>Hot-Drinks</option>
                                </select>
                            </form>

                </div>

            </div>



</div>
<hr style="border:2px solid green">
@if(isset($foods))
<h5>{{$foods['category']}}</h5>
                <div class="row">
                    @foreach($foods['list'] as $f)
                        <div class="col-md-4 top-buffer">

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a  class="button" data-slcfood="{{$f['id']}}" data-toggle="modal" data-target="#Billing_Modal" onclick="get_order_func({{$f['Food_Price']}},'{{$f['Food_Type']}}' )" id="order_btn">
                            <img src="{{ asset('imgs/'.$foods['category'].'.png') }}" class="img-circle" width="230" height="120" ></a>

                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="type">{{$f['Food_Type']}}<a>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <a class="price">{{$f['Food_Price']}} TL.<a>

                        </div>


                            @endforeach
            </div>
            @endif
</div>

<div class="modal fade" id="Billing_Modal" tabindex="-1" role="dialog" aria-labelledby="Food_ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Food_ModalLabel">Add To Basket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div><form  action="#" id="order_forum">

        <div class="modal-body">
            <hr style="border:2px solid green">
            <img src="{{ asset('imgs/'.$foods['category'].'.png') }}" class="img-circle" width="180" height="120"><br><br>
            <hr style="border:2px solid green">
           <h4 style="color:green;"> <a id="sell_type"></a> - <a id="sell_price"></a></h4>
            <strong>Quantity:</strong><br>
            <input class="form-control" type="text" name="Quantity" placeholder="1" id="B_Quantity" style="width:10%;"><br>


            <strong>Customer-Name:</strong> <br>
            <input class="form-control" type="text" name="customer"placeholder="John" id="B_Name" style="max-width:50%;">
            <select class="form-control"  id="customer_select" name="customer_name" onchange="disable_manuel_customer()" style="max-width:50%;" >
                <option disabled selected="selected">Choose Existing</option>
                @foreach($customers as $customer)
            <option>{{$customer->Customer_Name}}</option>
@endforeach
            </select>
       <br>
            <input type="checkbox" name="drinkcheck" id="drinkCheck" > Drink
    <div class="row">

          <div class="col-md-3">
             <select class="form-control " id="selectDrink"  name="drinkOpt" hidden  >
                @foreach($allDrinks as $drink)
                <option value="{{$drink->id}}" >{{$drink->Food_Type}}</option>
                @endforeach
            </select>

    </div>
    <div class="col-md-3">
        <select class="form-control " id="selectQuantity"  name="drinkQuantity" hidden  >

            @for($i = 1; $i<11; $i++)
            <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>
    </div>

    <hr>
            <strong>Sauce Choice:</strong><br>
            <input  type="checkbox" name="Sauce1" value="Ketchup" id="B_s1"> Ketchup<br>
            <input type="checkbox" name="Sauce2" value="Mayonnaise" id="B_s2"> Mayonnaise<br>
            <input type="checkbox" name="Sauce3" value="Bigla" id="B_s3"> Bigla<br>
            <input type="checkbox" name="Sauce4" value="Hardal" id="B_s4"> Hardal<br>
            <input type="checkbox" name="Sauce5" value="BBQ" id="B_s5"> BBQ <hr>
            <textarea class="form-control" name="description" rows="4" cols="40" id="B_Desc" placeholder="Description"></textarea>


        </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="button" class="btn btn-info" value="Add To Basket" id="add_to_basket">

        </div>
      </div>
    </div>



<script>


$('#drinkCheck').change(function() {
    if($("#drinkCheck").is(":checked")){
        $("#selectDrink").attr("hidden",false);
        $("#selectQuantity").attr("hidden",false);
    }
        else{
        $("#selectDrink").attr("hidden",true);
        $("#selectQuantity").attr("hidden",true);
    }
});


$("#Billing_Modal").on('hide.bs.modal', function(){
  location.reload();
});
    function disable_manuel_customer(){

        $("#B_Name").prop('disabled', true);
        $("#B_Name").val("");
    }

    function myfunction(){
   var select = document.getElementById('sel1');
   select.form.submit();
}

$('#Billing_Modal').on('show.bs.modal', function (event) {


   button = $(event.relatedTarget) // Button that triggered the modal
   F_ID = button.data('slcfood') // Extract info from data-* attributes

$('#add_to_basket').click(function(){
// Set drink
    if($("#drinkCheck").is(":checked") && $("#selectDrink").val()!=null ){

              var  drink = $("#selectDrink").val();
              var  drinkQuantity=$("#selectQuantity").val();


    }
    else{
     var drink="";
      var  drinkQuantity="";
    }
//End of set drink

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 var quantity = $("#B_Quantity").val();
if($("#B_Name").val()=="" && $("#customer_select").val()!="Choose Existing" && $("#customer_select").val()!=""){

 var customer =$("#customer_select").val();
}
else{
var customer = $("#B_Name").val();
}
if ($("#B_s1").is(":checked"))
 var s1 = $("#B_s1").val();
else
var s1=""
if ($("#B_s2").is(":checked"))
var s2 = $("#B_s2").val();
else
var s2=""
if ($("#B_s3").is(":checked"))
var s3 = $("#B_s3").val();
else
var s3=""
if ($("#B_s4").is(":checked"))
var s4 = $("#B_s4").val();
else
var s4=""
if ($("#B_s5").is(":checked"))
var s5 = $("#B_s5").val();
else
 s5=""
var desc = $("#B_Desc").val();


            $.ajax({
                /* the route pointing to the post function */
                url: 'takeorder/get_order',
                type: 'GET',

                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN,prod_id: F_ID,quantity:quantity,customer:customer,s1:s1,s2:s2,s3:s3,s4:s4,s5:s5,desc:desc,drink:drink,drinkQuantity:drinkQuantity},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    location.href="basket";
                },
                error: function (xhr, status) {

                    alert("Please Enter Valid Quantity and Customer Name");
        }

            })
})
})

            function get_order_func(fprice,ftype){
              //var order=document.getElementById("order_btn").getElementsByTagName("a");
         //var type= document.getElementsByClassName("type");

              document.getElementById("sell_type").innerHTML=ftype;
              document.getElementById("sell_price").innerHTML=fprice+" TL";




              //console.log(food);


         /*var first_child=($("#order_btn").children());
         console.log(first_child.toArray());*/


}

    </script>

@endsection
