@extends('/layouts/app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('maincontent')

<div class="container-fluid bg-light ">
    <hr style="border:2px solid green">
    <div class="row" >
        <div class="col-md-4 "><img src="{{asset("imgs/adto_logo.jpg")}}" class="img-circle" width="100" height="80"></div>
        <div class="col-md-4 "  ><h1 style="color:rgb(129, 165, 137);">Add New Product</h1></div>
    </div>
    <hr style="border:2px solid green">
    <div class="row" style="color:rgb(129, 165, 137);">
            <div class="col-md-4 ">
                    <form method="GET" action="addto/NewFood" id="new_food_form">
                        @csrf
                    <div class="form-group">

                           <strong> <label for="sell1">Choose The Product Category:</label></strong>

                            <select  class="form-control" id="sell1" name="Category">
                              <option selected="selected">Choose Category</option>
                              <option value="Sandwiches">Sandwiches</option>
                              <option value="Salads">Salads</option>
                              <option value="Soups">Soups</option>
                              <option value="Deserts">Deserts</option>
                              <option value="Cold-Drinks">Cold-Drinks</option>
                              <option value="Hot-Drinks">Hot-Drinks</option>
                            </select>
                        </div>
            </div>


            <div class="col-md-8 ">

                <div class="form-group row">
                    <div class="col-xs-2">
                        <label for="inp_name">Product Name:</label>
                        <input type="text" class="form-control" id="inp_name" name="FoodName">

                        <label for="inp_pr">Price:</label>
                        <input type="number" min="0" class="form-control" id="inp_pr" name="FoodPrice">
                        <input type="button" class="btn btn-info" data-toggle="modal" data-target="#Food_Modal" value="Add">
                    </div>




                 </div>
                 @if ($errors->any())

                 <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>

 @endif
             </div>








            </div>
                <!-- Modal -->
          <div class="modal fade" id="Food_Modal" tabindex="-1" role="dialog" aria-labelledby="Food_ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Food_Modal">Add Food</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are You Sure Bitch ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="button" onclick="save_validate()" class=" btn btn-info" value="Save">
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
    <hr style="border:2px solid green">
<div class="row" >

    <div class="col-md-4" >
      </div>
      <div class="col-md-4" >
        <h1 style="color:rgb(129, 165, 137);">Edit/Remove</h1>
      </div>

</div>

<hr>
    <div class="row" style="color:rgb(129, 165, 137);">
        <div class="col-md-4">
            <form method="GET" action="addto">
                @csrf
            <div class="form-group">

                   <strong> <label for="remove">Choose The Product Category To Edit</label></strong>

                    <select  class="form-control" id="remove" name="Category" onchange="myfunction();">
                      <option selected="selected">Choose Category</option>
                      <option value="Sandwiches">Sandwiches</option>
                      <option value="Salads">Salads</option>
                      <option value="Soups">Soups</option>
                      <option value="Deserts">Deserts</option>
                      <option value="Cold-Drinks">Cold-Drinks</option>
                      <option value="Hot-Drinks">Hot-Drinks</option>
                    </select>
                </div>
            </form>
        </div>
    </div>






  @if(isset($foods))
            <div class="row">
                @foreach($foods as $f)
                    <div class="col-md-4 top-buffer">
                        @if(isset($f))
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="button"  data-toggle="modal" data-target="#Food_Modal_Remove" data-slcfood="{{$f['id']}}" onclick="get_remove_info({{$f['Food_Price']}},'{{$f['Food_Type']}}' )" id="order_btn">
                        <img src="{{ asset('imgs/Sandwiches.png') }}" class="img-circle" width="230" height="120" ></a>
                        @endif
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="type">{{$f['Food_Type']}}<a>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <a class="price">{{$f['Food_Price']}} TL.<a>

                    </div>


                        @endforeach
            </div>
@endif




</div>

    <div class="modal fade" id="Food_Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="Food_ModalRemove1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Food_Modal_Remove">Remove Product</h5>
            <form >

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are You Sure You Want Remove That?<br>
              @if(isset($f))
              <img src="{{ asset('imgs/'.$f['category'].'.png') }}" class="img-circle" width="230" height="120"><br><br>
              <label id="sell_type"></label>@endif<br>
            <label id="sell_price"> TL.</label><br>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form  action="#" method="GET">
              <button type="button" class=" btn btn-info" id="remove_buton">Remove</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </form>
</div>


    </div>

<script>
$("#Food_Modal_Remove").on('hide.bs.modal', function(){
  location.reload();
});

function myfunction(){
   var select = document.getElementById('remove');
   select.form.submit();
}
function save_validate(){

    var categ_selected = $('#sell1').find(":selected").text();
    if(categ_selected !="Choose Category")
    $( "#new_food_form" ).submit();
    else
    alert("Please Select Category.");

}



  $('#Food_Modal_Remove').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var F_ID = button.data('slcfood') // Extract info from data-* attributes



$('#remove_buton').click(function(){


    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    /* the route pointing to the post function */
                    url: 'addto/RemoveFood',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN,id: F_ID},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        location.reload();
                    }
                })
})
 /* var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
  */


})

            function get_remove_info(fprice,ftype){
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
