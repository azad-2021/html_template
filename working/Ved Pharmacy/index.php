<?php 
include "connection.php";
include "session.php";
$userid=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

function getdate_Date($DateFormat){

  return date('d-M-Y',strtotime($DateFormat));;
}


$query="SELECT sum(Amount) FROM billing WHERE BillDate=curdate() and Cancelled=0";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$BillToday=$arr['sum(Amount)'];

$query="SELECT sum(Amount) FROM billing WHERE Cancelled=0";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$BillTotal=$arr['sum(Amount)'];


$query="SELECT sum(Qty-SaledQty) as Stock FROM purchase WHERE (Qty-SaledQty)>0;";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$Stock=$arr['Stock'];

$query="SELECT SUM(billing.Amount-purchase.PaidAmount) as Income FROM `purchase`
join billing on purchase.ItemID=billing.ItemID and purchase.ExpiryDate=billing.ExpiryDate
WHERE month(BillDate)=month(CURRENT_DATE()) and year(BillDate)=year(CURRENT_DATE)";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$IncomeCurrent=$arr['Income'];

$query="SELECT SUM(billing.Amount-purchase.PaidAmount) as Income FROM `purchase`
join billing on purchase.ItemID=billing.ItemID and purchase.ExpiryDate=billing.ExpiryDate";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$TotalIncome=$arr['Income'];

$SalesAmount=array();
$SalesDate=array();

$query="SELECT sum(Amount), BillDate FROM `billing` WHERE year(BillDate)=year(CURRENT_DATE()) GROUP BY month(BillDate)";
$result = mysqli_query($con,$query);
while($arr=mysqli_fetch_assoc($result)){
  $SalesAmount[]=$arr['sum(Amount)'];
  $SalesDate[]=date('M',strtotime($arr['BillDate']));
}


$LeftItemQty=array();
$LeftItemName=array();

$query="SELECT SUM(Qty-SaledQty), ItemName FROM `purchase` JOIN items on purchase.ItemID=items.ItemID
WHERE (Qty-SaledQty)>0 GROUP BY purchase.ItemID ORDER BY SUM(Qty-SaledQty) LIMIT 20";
$result = mysqli_query($con,$query);
while($arr=mysqli_fetch_assoc($result)){
  $LeftItemQty[]=$arr['SUM(Qty-SaledQty)'];
  $LeftItemName[]=$arr['ItemName'];
}

$LeftExpDays=array();
$ExpItemName=array();

$query="SELECT DATEDIFF(ExpiryDate, CURRENT_DATE()) as LeftDays, ItemName FROM `purchase`
JOIN items on purchase.ItemID=items.ItemID
WHERE DATEDIFF(ExpiryDate, CURRENT_DATE())<=45 and (Qty-SaledQty)>0
GROUP BY purchase.ItemID ORDER BY DATEDIFF(ExpiryDate, CURRENT_DATE())";
$result = mysqli_query($con,$query);
while($arr=mysqli_fetch_assoc($result)){
  $LeftExpDays[]=$arr['LeftDays'];
  $ExpItemName[]=$arr['ItemName'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
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
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#numbers-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Today Billing</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 <?php echo number_format($BillToday,2); ?></h3>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#numbers-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total Billing</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 <?php echo number_format($BillTotal,2); ?></h3>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-3 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Items in stock</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0"><?php echo $Stock; ?></h3>
            </div>
          </div>
        </div>

        <!-- Count item widget-->
        <div class="col-xl-3 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Income current month</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 <?php echo $IncomeCurrent; ?></h3>
            </div>
          </div>
        </div>

        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total income</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 <?php echo $TotalIncome; ?></h3>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Header Section-->
  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">
        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Sales marketing report</h2>
            <p class="text-sm text-muted">Sale Report of Current Year</p>
            <canvas id="SalesReport"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">


        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Items about to end in stock (Limit 20 items)</h2>                       
            <canvas id="leftitems"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">

        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Item about to expire (Less than 45 days)</h2>
            <canvas id="ItemAboutExpire"></canvas>
          </div>
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
  <!-- Main File-->
  <script src="js/front.js"></script>


  <script type="text/javascript">

    var SalesAmount = <?php echo json_encode($SalesAmount) ?>;
    var SalesDate = <?php echo json_encode($SalesDate) ?>;

    var LeftItemQty = <?php echo json_encode($LeftItemQty) ?>;
    var LeftItemName = <?php echo json_encode($LeftItemName) ?>;

    var LeftExpDays = <?php echo json_encode($LeftExpDays) ?>;
    var ExpItemName = <?php echo json_encode($ExpItemName) ?>;

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
<script src="main.js"></script>
<script type="text/javascript">
</script>
</body>
</html>