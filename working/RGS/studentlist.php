<?php 

include"connection.php";
include"session.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=$_SESSION['userid'];

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <script src="assets/js/sweetalert.min.js"></script>


  <link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap5.min.css">

  <style type="text/css">
    /*:root {

      --theadColor: #38000e;

      --theadTextColor: #fff;

      --darkColor:#000;

    
    tr.selected {
      background-color: green;
    }

    table.dataTable {

      border:1px solid #000;

      background-color: #000;

    }

    th,tr,td

    {

      border-color: #000 !important;

    }

    thead {

      background-color: var(--theadColor);



    }

    thead > tr,

    thead > tr > th {

      background-color: transparent;

      color: var(--theadTextColor) !important;

      font-weight: normal;

      text-align: start;

    }

    table.dataTable thead th,

    table.dataTable thead td {

      border-bottom: 0px solid #111 !important;

    }

    .dataTables_wrapper > div {

      margin: 5px;

    }

    table.dataTable.display tbody tr.even > .sorting_1,

    table.dataTable.order-column.stripe tbody tr.even> .sorting_1, 

    table.dataTable.display   tbody tr.even,

    table.dataTable.display tbody tr.odd > .sorting_1,

    table.dataTable.order-column.stripe tbody tr.odd > .sorting_1,

    table.dataTable.display tbody tr.odd {

      background-color: var(--darkRowColor);

      color:var(--lightColor);

    }

    table.dataTable thead th {

      position: relative;

      background-image: none !important;

    }

    table.dataTable thead th.sorting:after,

    table.dataTable thead th.sorting_asc:after,

    table.dataTable thead th.sorting_desc:after {

      position: absolute;

      top: 12px;

      right: 8px;

      display: block;

      font-family: "Font Awesome\ 5 Free";

    }

    table.dataTable thead th.sorting:after {

      content: "\f0dc";

      color: #ddd;

      font-size: 0.8em;

      padding-top: 0.12em;

    }

    table.dataTable thead th.sorting_asc:after {

      content: "\f0de";

    }

    table.dataTable thead th.sorting_desc:after {

      content: "\f0dd";

    }

    table.dataTable.display tbody tr:hover > .sorting_1,

    table.dataTable.order-column.hover tbody tr:hover > .sorting_1,

    tbody tr:hover {

      background-color: var(--darkColor) !important;

      color: #fff;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {

      background: none !important;

      border-radius: 50px;

      background-color: var(--theadColor) !important;

      color:var(--lightColor) !important

    }





    .dataTables_wrapper .dataTables_paginate .paginate_button {

      background: none !important;

      color:var(--darkColor) !important

    }

    .paginate_button.current:hover

    {

      background: none !important;

      border-radius: 50px;

      background-color: var(--theadColor) !important;

      color:#fff !important

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

      border: 1px solid #979797;

      background: none !important;

      border-radius: 50px !important;

      background-color: #000 !important;

      color: #fff !important;

    }
*/
  </style>
</head>
<body>
  <div class="container-scroller">
    <?php 

    include"nav.php";
    ?>
    <!-- partial -->
    <div class="main-panel">

      <?php 

      include"modals.php";
      ?>
      <div class="content-wrapper">

        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Student Details</h4>

                <form align="center" id="SalaryForm">
                  <div class="row">

                    <div class="col-lg-6">
                      <label for="recipient-name" class="col-form-label">Select Course</label>
                      <select style="color:white" class="form-control" id="CourseIDSt" required="">
                        <option value="">Select</option>
                        <?php 
                        $query ="SELECT * FROM courses";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)>0){
                          while($row=mysqli_fetch_assoc($result)){
                            echo '<option value="'.$row['CourseID'].'">'.$row['Course'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="col-lg-6">
                      <label for="recipient-name" class="col-form-label">Select Branch</label>
                      <select style="color:white" class="form-control" id="BranchIDSt" required="">
                        <option value="">Select</option>
                      </select>
                    </div>

                  </div>
                </form>

                <div class="table-responsive" style="margin:20px;">
                  <table class="table table-hover table-bordered border-primary table-light" id="example">
                    <thead>
                      <th>Student Name</th>
                      <th>Father's Name</th>
                      <th>Mother's Name</th>
                      <th>Gender</th>    
                      <th>Aadhaar Card</th>                      
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Lateral Entry</th>
                      <th>Course Amount</th>
                      <th>Received Amount</th>
                      <th>Pending Amount</th>
                      <th>Registration Date</th>
                      <th>Remark</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="StudentData">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer" style="margin-top:200px;">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022 abc </span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed and monitored by <a href="https://starlaboratories.in/" target="_blank">STAR Laboratories</a>
          </span>
        </div>
      </footer>

    </div>
  </div>
</div>

<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<!-- End custom js for this page -->

<script src="datatable/js/jquery.dataTables.min.js"></script>
<script src="datatable/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">




  $(document).on('change', '#CourseIDSt', function(){
    var CourseID= $(this).val();
    console.log(CourseID);
    if(CourseID){
      $.ajax({
        type:'POST',
        url:'search.php',
        data:{'CourseID':CourseID},
        success:function(result){
          $('#BranchIDSt').html(result);
        }
      }); 
    }else{
      $('#BranchIDSt').html('<option value="">Branch</option>'); 
    }

  });

  $(document).on('change', '#BranchIDSt', function(){
    var BranchID= $(this).val();

    if(BranchID){
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'BranchIDSt':BranchID},
        success:function(result){
          $('#example').DataTable().clear();
          $('#example').DataTable().destroy();
          $('#StudentData').html(result);
          $('#example').DataTable();
        }
      }); 
    }

  });



  $(document).on('click', '.FeesDetails', function(){

    var StudentID=$(this).attr("id");
    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      if (StudentID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'StudentIDFees':StudentID},
          success:function(result){
            $('#FeesData').html(result);
          }
        });
      }
    }, delayInMilliseconds)
  });



</script>

</body>
</html>

<?php   $con->close(); ?>