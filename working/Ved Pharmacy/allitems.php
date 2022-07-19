<?php include "connection.php";
include "session.php";
$userid=$_SESSION['userid'];

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
      <div class="modal fade" id="EditRate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Enter New Rate</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="row">
                <center>
                  <div class="col-lg-6">
                    <input type="number" min=0 class="form-control" name="NewRate" id="NewRate">
                    <input type="text" name="" id="NewRateID">
                  </div>
                </center>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary SaveNewRate">Save</button>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered border-primary" id="example" width="100%">
          <thead>
            <th>Item Name</th>
            <th>Category</th>
            <th>Rate</th>
            <th>Updated On</th>
            <th>Updated By</th>
            <th>Change Category</th>
          </thead>

          <tbody id="">
            <?php 

            $query="SELECT * FROM items
            join category on items.CategoryID=category.CategoryID
            join user on items.UpdatedByID=user.UserID";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result)>0)
            {

              $Sr=1;
              while ($row=mysqli_fetch_assoc($result))
              {
                print "<tr>";
                print '<td>'.$row['ItemName']."</td>";
                print '<td>'.$row['Category']."</td>";
                print '<td><a href="" class="EditQty" id="'.$row['ItemID'].'" data-bs-toggle="modal" data-bs-target="#EditRate">'.$row['SellingRate']."</a></td>";
                print '<td><span class="d-none">'.$row['UpdatedDate'].'</span>'.date('d-M-Y',strtotime($row['UpdatedDate']))."</td>";
                print '<td>'.$row['UserName']."</td>";
                print '<td>
                <select class="form-control" id="ChanageCategory" id2="'.$row['ItemID'].'">';
                print '<option value="">Select</option>';
                $query="SELECT * from category order by Category";
                $result1 = mysqli_query($con,$query);
                if(mysqli_num_rows($result1)>0)
                {
                  while ($row1=mysqli_fetch_assoc($result1))
                  {
                    echo "<option value='".$row1['CategoryID']."'>".$row1['Category']."</option><br>";
                  }
                }

                print '</select>
                </td>';
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
  <script src="main.js"></script>
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
      

      $(document).on('change', '#ChanageCategory', function(){

        var CategoryID=$(this).val();
        var ItemID = $(this).attr("id2");

        if (CategoryID && ItemID) {
          if (confirm("You want to change Category. Do you wish to continue?")) {
            $.ajax({
             url:"insert.php",
             method:"POST",
             data:{'CategoryIDChange':CategoryID, 'ItemIDC':ItemID},
             success:function(result){
              if((result)==1){
                SuccessAlert('Category Changed');
                var intervalId = window.setInterval(function(){
                  location.reload();
                }, 2000);
              }else{

                Swal.fire({
                  title: 'Error!',
                  text: (result),
                  icon: 'error',
                  confirmButtonText: 'OK'
                })

              }
            }
          });
          }
        }
      });

      $(document).on('click', '.EditQty', function(){
        var ItemID=$(this).attr("id");
        console.log(ItemID);
        document.getElementById("NewRateID").value=ItemID;

      })


      $(document).on('click', '.SaveNewRate', function(){

        var Rate=document.getElementById("NewRate").value;
        var ItemID = document.getElementById("NewRateID").value;

        if (Rate && ItemID) {
          if (confirm("You want to change Rate. Do you wish to continue?")) {
            $.ajax({
             url:"insert.php",
             method:"POST",
             data:{'RateChange':Rate, 'ItemIDCR':ItemID},
             success:function(result){
              if((result)==1){
                SuccessAlert('Rate Changed');
                var intervalId = window.setInterval(function(){
                  location.reload();
                }, 2000);
              }else{

                Swal.fire({
                  title: 'Error!',
                  text: (result),
                  icon: 'error',
                  confirmButtonText: 'OK'
                })

              }
            }
          });
          }
        }
      });

    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
  </html>