@extends('/layouts/app')

@section('maincontent')

<div class="container-fluid bg-light ">
    <hr style="border:2px solid green">
    <div class="row">
        <div class="col-md-4 "><img src="{{asset("imgs/adto_logo.jpg")}}" class="img-circle" width="100" height="80"></div>
        <div class="col-md-4 "><h1>Billing</h1></div>
    </div>
    <hr style="border:2px solid green">
    <form action="billing/" method="GET">
    <div class="row">

        <div class="col-md-2 ">
            <label for="datestart">Start Date</label><br>

            <input name="date1" type="date" id="datestart">


        </div>
        <div class="col-md-2 ">
            <label  for="datestart">End Date</label><br>

            <input name="date2" type="date" id="dateend">


        </div>
        <div class="col-md-2">
<br>

            <input class="btn form-control" type="submit" name="Report" id="report" value="Report" style="background-color:rgb(129, 165, 137);">


        </div>
    </div>
</form>



    <div class="col-md-8 top-buffer" style="background-color:rgb(129, 165, 137); border-radius:20px; left:5%">

        <div class="row">
            <div class="col-md-4">
                        <strong>Holy Cafe</strong>
            </div>

                    <h1>Billing Table</h1>
        </div>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>

                        </tr>
                    </thead>
                    <tbody>

@foreach($bills as $bill)
                        <tr>
                            <td class="col-md-8"><em>{{$bill['Product_Type']}}</em></h4></td>
                        <td class="col-md-1" style="text-align: center">{{$bill['Quantity']}}</td>
                            <td class="col-md-1 text-center">{{$bill['Products_Price_Perorder']}}</td>


                        </tr>
@endforeach

<tr>


    <td></td>
    <td></td>
    <td class="text-right"><h4><strong>Total: </strong></h4></td>
    <td class="text-center text-danger"><h4><strong>{{$Total}}</strong></h4></td>
</tr>


                    </tbody>

                </table>

            </div>
            &nbsp;&nbsp;&nbsp;




</div>







</div>





@endsection
