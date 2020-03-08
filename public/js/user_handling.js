 /* Disable Default Logout */


             /* Menu Toggle Script */
 $("#menu-toggle").click(
 function(e)
         {
                e.preventDefault();
                   $("#wrapper").toggleClass("toggled");
         }

                        );


                        /*AngulaJS*/


/*Register Modal*/
   /*
var reg_ap = angular.module('reg_ap', []);

reg_ap.controller(


  'reg_ctrl',function($scope,$http)

{




  $scope.addUser = function() {
    $http(
      {

         method: 'POST',
         url:  'regestration.php',
         data: {rname: $scope.uname, rsurname: $scope.usurname, remail: $scope.uemail , rpassword: $scope.upassword , rpassword_verify: $scope.upassverify}

    }
    ).then(function (response)
              {

                $scope.err_msg="Başarılı";



    }, function (response) {
      $scope.err_msg="Hata!";
         console.log(response.data,response.status);


    });
};




  }

  );*/
