<?php 
include "connection.php";
session_start();

if (isset($_POST['submit'])) {

  $username=$_POST['username'];
  $password=$_POST['Password'];

  $query="SELECT * FROM user WHERE UserName='$username' and Password='$password'";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result)>0)
  {
    $arr=mysqli_fetch_assoc($result);
    $_SESSION['user']=$arr['UserName'];
    $_SESSION['userid']=$arr['UserID'];
    $_SESSION['usertype']=$arr['UserType'];
    header("location:index.php");
  }else{
    echo '<script>alert("User name or password is incorrect")</script>';
  }


}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ved Pharmacy Login</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
  <!-- Custom Scrollbar-->
  <link rel="stylesheet" href="vendor/overlayscrollbars/css/OverlayScrollbars.min.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        </head>
        <body>
          <div class="login-page d-flex align-items-center bg-gray-100">
            <div class="container mb-3">
              <div class="row">
                <div class="col-md-6 mx-auto">
                  <div class="card">
                    <div class="card-body p-5">
                      <header class="text-center mb-5">
                        <h1 class="text-xxl text-gray-400 text-uppercase"><strong class="text-primary">Ved Pharmacy</strong></h1>
                      </header>
                      <form class="" method="POST" action="">
                        <div class="row">
                          <div class="col-lg-7 mx-auto">
                            <div class="input-material-group mb-3">
                              <input class="input-material" id="login-username" type="text" name="username" autocomplete="off" required data-validate-field="loginUsername">
                              <label class="label-material" for="login-username">Username</label>
                            </div>
                            <div class="input-material-group mb-4">
                              <input class="input-material" id="login-password" type="password" name="Password" required data-validate-field="loginPassword">
                              <label class="label-material" for="login-password">Password</label>
                            </div>
                          </div>
                          <div class="col-12 text-center">       
                            <button class="btn btn-primary mb-3" name="submit" type="submit">Login</button><br>
                            <a class="text-xs text-paleBlue" href="#!">Forgot Password?  </a><br>                     
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center position-absolute bottom-0 start-0 w-100 z-index-20">
              <p class="text-gray-500">Design and monitor by <a class="external" href="https://starlaboratories.in">STAR Laboratories</a>
              </p>
            </div>
          </div>
          <!-- JavaScript files-->
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="vendor/chart.js/Chart.min.js"></script>
          <script src="vendor/just-validate/js/just-validate.min.js"></script>
          <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
          <script src="vendor/overlayscrollbars/js/OverlayScrollbars.min.js"></script>
          <!-- Main File-->
          <script src="js/front.js"></script>
          <script>
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function(e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
        }
      }
      // this is set to BootstrapTemple website as you cannot 
      // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
      // while using file:// protocol
      // pls don't forget to change to your domain :)
      injectSvgSprite('https://starlaboratories.in/files/icons/orion-svg-sprite.svg'); 
      
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
  </html>