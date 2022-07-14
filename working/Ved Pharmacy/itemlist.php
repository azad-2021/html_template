<?php include "connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Items</title>
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

  <script src="js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

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

      <div class="table-responsive">
        <table class="table table-hover table-bordered border-primary" id="example">
          <thead>
            <th>Item Name</th>
            <th>Category</th>
            <th>In stock</th>
            <th>Expiry Date</th>
            <th>Purchase From</th>
            <th>Purchase Amount</th>
            <th>Purchase Discount</th>
            <th>Selling Rate</th>
            <th>Purchase Date</th>
          </thead>
          <tbody id="">
            <?php 

            $query="SELECT * FROM `purchase` 
            JOIN items on purchase.ItemID=items.ItemID
            JOIN sellers ON purchase.SellerID=sellers.SellerID
            join category on items.CategoryID=category.CategoryID";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result)>0)
            {

              $Sr=1;
              while ($row=mysqli_fetch_assoc($result))
              {
                print "<tr>";
                print '<td>'.$row['ItemName']."</td>";
                print '<td>'.$row['Category']."</td>";
                print '<td>0</td>';
                print '<td><span class="d-none">'.$row['ExpiryDate'].'</span>'.date('d-M-Y',strtotime($row['ExpiryDate']))."</td>";
                print '<td>'.$row['SellerName']."</td>";
                print '<td>'.$row['PaidAmount']."</td>";
                print '<td>'.$row['Discount']."</td>";
                print '<td>'.$row['SellingRate']."</td>";
                print '<td><span class="d-none">'.$row['PurchaseDate'].'</span>'.date('d-M-Y',strtotime($row['PurchaseDate']))."</td>";
                print "</tr>";  
              }


            }

            ?>
          </tbody>
        </table>
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
  <!-- Main File-->
  <script src="js/front.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
  <script>
    $(document).ready(function() {
     var table = $('#example').DataTable( {
      rowReorder: {
        selector: 'td:nth-child(2)'
      },

      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: true

    } );
   } );
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
      injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
      
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
  </html>