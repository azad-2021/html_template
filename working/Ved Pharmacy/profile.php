<?php include "connection.php";
include "session.php";
$userid=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

if (isset($_POST['submit'])) {

  $password=$_POST['password'];


  $sql = "UPDATE user SET Password='$password' WHERE UserID=$userid";
  if ($con->query($sql) === TRUE) {
    header("location:index.php");
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profile</title>
  <?php include "header.php"; ?>
</head>
<body>

  <!-- Side Navbar -->
  <?php include "sidebar.php"; ?>
  <!-- Counts Section -->

  <section class="py-5">
    <div class="container-fluid">

      <!-- modals -->
      <?php include "modals.php"; ?>
      <!-- modal closed -->

      <div class="row">
      </div>
    </div>
  </section>
  <!-- Header Section-->
  <section class="pb-5"> 

    <div class="container-fluid" align="center">

      <div class="card">
        <div class="card-header border-bottom">
          <h3 class="h4 mb-0">Profile</h3>
        </div>
        <div class="card-body">
          <p class="text-sm"></p>
          
          <form method="POST" action="">
            <div class="row">
              <center>
                <div class="col-lg-4">
                  <div class="col-lg-12">
                    <label class="form-label" for="exampleInputEmail1">User Name</label>
                    <input class="form-control" value="<?php echo $_SESSION['user'] ?>" id="username" name="username" type="text" aria-describedby="emailHelp" disabled>
                  </div>
                  <div class="col-lg-12">
                    <label class="form-label" for="exampleInputPassword1">Change Password</label>
                    <input class="form-control" id="password" name="password" type="password">
                  </div>
                  <div class="col-lg-12" style="margin:10px;">
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                  </div>
                </div>
              </center>
            </div>
          </form>
          
        </div>
      </div>
    </div>
    
  </section>
  <?php include "footer.php"; 

  ?>

  <!-- JavaScript files-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/just-validate/js/just-validate.min.js"></script>
  <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="vendor/overlayscrollbars/js/OverlayScrollbars.min.js"></script>
  <script src="js/charts-home.js"></script>
  <script src="main.js"></script>
  <!-- Main File-->
  <script src="js/front.js"></script>


  <script type="text/javascript">
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
injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
</script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<?php 
include "js-php.php";

?>
<script type="text/javascript">

</script>
</body>
</html>