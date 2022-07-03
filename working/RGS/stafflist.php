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
  <title>Staff</title>
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
                <h4 class="card-title">Staff Details</h4>

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
                      <th>Staff Name</th>
                      <th>Gender</th>    
                      <th>Aadhaar Card</th>                      
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Email</th>
                      <th>Education Details</th>
                      <th>Salary Amount</th>
                      <th>Pending Amount</th>
                      <th>Total Leave</th>
                      <th>Taken Leave</th>
                      <th>Joining Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="StaffData">

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
        data:{'BranchIDSta':BranchID},
        success:function(result){
          $('#example').DataTable().clear();
          $('#example').DataTable().destroy();
          $('#StaffData').html(result);
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

  $(document).on('click', '.SalaryDetailsS', function(){

    var StaffID=$(this).attr("id");
    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      if (StaffID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'StaffIDSalary':StaffID},
          success:function(result){
            $('#SalaryDataS').html(result);
          }
        });
      }
    }, delayInMilliseconds)
  });

</script>

</body>
</html>

<?php   $con->close(); ?>