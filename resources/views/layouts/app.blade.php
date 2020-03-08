<!DOCTYPE html>

    <html lang="en">

            <head>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">



                <link href="{{ asset('css/maincont.css') }}" rel="stylesheet">
                <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
                <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">


               <title>Holly....</title>

            </head>

            <body>


     <div  class="d-flex" id="wrapper">
               <div class=" border-right " id="sidebar-wrapper">
                          <div class="sidebar-heading ">Holly Cafe</div>
                                   <div class="list-group list-group-flush">

                                                <a href="{{ route('home') }}" class="list-group-item list-group-item-action "><img id="icon-home" src="{{asset("imgs/home-icon.png")}}" width="40px" height="40px"> Home</a>
                                                <a href="addto" class="list-group-item list-group-item-action "><img id="icon-home" src="{{asset("imgs/Settings-icon.png")}}" width="40px" height="40px"> Create Menu</a>
                                                <a href="takeorder" class="list-group-item list-group-item-action "><img id="icon-home" src="{{asset("imgs/takeorder.png")}}" width="40px" height="40px"> Take Order</a>
                                                <a href="basket" class="list-group-item list-group-item-action "><img id="icon-home" src="{{asset("imgs/basket.png")}}" width="40px" height="40px"> Basket</a>
                                                <a href="billing" class="list-group-item list-group-item-action "> <img id="icon-home" src="{{asset("imgs/billing.png")}}" width="40px" height="40px"> Billing</a>


                                   </div>
               </div>



     <div id="page-content-wrapper">

                    <nav class="navbar navbar-expand-lg  border-bottom" id="navbarPanel">
                               <button class="btn bg-dark "style="color:green; " id="menu-toggle">&#9776;</button>



                                             <div class="navbar-header">
                                             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                 <div class="nav navbar-nav navbar-center">

                                                    <a> Holly & Bites</a>


                                             </div>
                                             <div class="nav navbar-nav navbar-right">

                                                @guest
                                                @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                                @endif
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                </li>

                                            @else
                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->name }} <span class="caret"></span>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <li>
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </ul>


                                                </li>
                                            @endguest


                                            </div>



                                            </div>

                                        </div>


                        </nav>


<div>


                        @yield('maincontent')








  <!-- /#Main Container -->
          </div>



            </div>


</div>



        <!-- /#page-content-wrapper -->


              </div>

         <!-- Bootstrap core JavaScript -->

         <script src="{{asset("bootstrap/jquery/jquery.min.js")}}"></script>
         <script src="{{asset("bootstrap/js/bootstrap.bundle.min.js")}}"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

           <!-- MyJquery/Js -->
         <script src="{{asset("js/user_handling.js")}}"></script>





            </body>


</html>
