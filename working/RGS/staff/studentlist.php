<?php 

include"connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=1;



$query ="SELECT count(StudentID) FROM students WHERE Passout=0";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$NoStudents=$row['count(StudentID)'];

$query ="SELECT count(StaffID) FROM staff WHERE Inservice=1";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$NoStaff=$row['count(StaffID)'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ERP Admin</title>
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


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.1/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">

  <style type="text/css">
  :root {

    --theadColor: #38000e;

    --theadTextColor: #fff;

    --darkColor:#000;

    --lightColor:#fff;

    --darkRowColor: #e8003a;

  }

  table.dataTable tbody >
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
                <h4 class="card-title">Staff Leave Status</h4>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered border-primary table-dark" id="example">
                    <thead>
                      <th>Student Name</th>
                      <th>Father's Name</th>
                      <th>Mother's Name</th>
                      <th>Gender</th>
                      <th>Course</th>
                      <th>Branch</th>    
                      <th>Aadhaar Card</th>                      
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Lateral Entry</th>
                      <th>Course Amount</th>
                      <th>Received Amount</th>
                      <th>Pending Amount</th>
                      <th>Registration Date</th>
                      <th>Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $query ="SELECT * FROM students
                    join branchs on students.BranchID=branchs.BranchID
                    join courses on branchs.CourseID=courses.CourseID
                    WHERE Passout=0";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_assoc($result)){
                        if ($row['LateralEntry']==1) {
                          $Lateral='Yes';
                        }else{
                          $Lateral='No';
                        }
                        ?>
                        <tr>
                          <td><?php echo $row['StudentName']; ?></td>
                          <td><?php echo $row['FatherName'];?></td>
                          <td><?php echo $row['MotherName']?></td>
                          <td><?php echo $row['Gender']?></td>
                          <td><?php echo $row['Course']?></td>
                          <td><?php echo $row['BranchName']?></td>
                          <td><?php echo $row['AadharCardNo']?></td>
                          <td><?php echo $row['MobileNo']?></td>
                          <td><?php echo $row['Address']?></td>
                          <td><?php echo $Lateral?></td>
                          <td><?php echo $row['CourseAmount']?></td>
                          <td><?php echo $row['ReceivedAmount']?></td>
                          <td><?php echo $row['CourseAmount']-$row['ReceivedAmount']?></td>
                          <td><?php echo $row['RegistrationDate']?></td>
                          <td><?php echo $row['Remark']?></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
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
  <script src="assets/js/chart.js"></script>
  <!-- End custom js for this page -->

  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.0.1/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

  <script type="text/javascript">

    $(document).ready(function() {
      $('#example').DataTable({
        searchPanes: {
          layout: 'columns-6'
        },
        dom: 'Plfrtip',
        columnDefs: [
        {
          searchPanes: {
            show: true
          },
          targets: [3, 4, 5,9,10,12]
        }
        ]
      });
    });



    $(document).on('click', '.SaveSubject', function(){
      var subject = document.getElementById("subject").value;
      var ClassID= document.getElementById("SubClass").value;
      if (subject!='' && ClassID !='') {
        $.ajax({
          type:'POST',
          url:'insert.php',
          data:{'subject':subject, 'ClassID':ClassID},
          success:function(data){
            swal("success","Subject added","success"); 
            $('#AddSubject').modal('hide');
            $('#Fsubject').trigger("reset");
          }
        });
      }
    });

    $(document).on('click', '.sublist', function(){
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'subjectlist':'subjectlist'},
        success:function(result){
          $('#sublist').html(result);
        }
      });
    });



    $(document).on('change', '#BranchIDF', function(){
      var BranchID=$(this).val();
      console.log(BranchID);
      if (BranchID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'BranchID':BranchID},
          success:function(result){
            $('#FeesStudent').html(result);
          }
        });
      }else{
        $('#FeesStudent').html('<option value="">No Students</option>'); 
      }
    });


    $(document).on('change', '#FeesStudent', function(){
      var StudentID=$(this).val();
      console.log(StudentID);
      if (StudentID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'StudentID':StudentID},
          success:function(result){
            var r = (result);
                  //document.getElementById("TotalAmount").disabled = false;
                  document.getElementById("TotalAmount").value = r;
                  //document.getElementById("TotalAmount").disabled = true;
                }
              });
      }
    });


    $(document).on('click', '.SaveFees', function(){
      var BranchID=document.getElementById("BranchIDF").value;
      var TotalAmount = document.getElementById("TotalAmount").value;
      var StudentID= document.getElementById("FeesStudent").value;
      var Year = document.getElementById("year").value;
      var ReceivedAmount=document.getElementById("FeesAmount").value;
      var Remark=document.getElementById("RemarkFees").value;


      if (StudentID!='' && BranchID !='' && TotalAmount!='' && ReceivedAmount!='' && Year!='' && Remark!='') {
        $.ajax({
          type:'POST',
          url:'insert.php',
          data:{'TotalAmount':TotalAmount, 'ReceivedAmount':ReceivedAmount, 'Year':Year, 'StudentID':StudentID, 'BranchID':BranchID, 'Remark':Remark},
          success:function(result){
            swal("success","Fees Updated","success"); 
            $('#re').html(result);
            $('#AddFees').modal('hide');
            $('#FeesForm').trigger("reset");
          }
        });
      }else{
        swal("error","Please enter all fields","error");
      }
    });


    $(document).on('click', '.SearchStudent', function(){
      var Name = document.getElementById("FStudentName").value;
      if (Name) {
        $.ajax({
          type:'POST',
          url:'search.php',
          data:{'StudentName':Name},
          success:function(result){
            $('#StudentData').html(result);
            $('#StudentDetails').modal('show');
          }
        });
      }
    });


    $(document).on('change', '#StaffIDS', function(){
      var StaffID=$(this).val();
      console.log(StaffID);
      if (StaffID) {
        $.ajax({
          type:'POST',
          url:'read.php',
          data:{'StaffID':StaffID},
          success:function(result){
            document.getElementById("SalaryAmount").value=(result);
          }
        });
      }
    });

    $(document).on('click', '.SaveSalary', function(){
      var Salary = document.getElementById("Salary").value;
      var StaffID= document.getElementById("StaffIDS").value;
      var Month = document.getElementById("SalaryMonth").value;
      var Amount = document.getElementById("SalaryAmount").value;
      console.log(Month);
      if (StaffID!='' && Salary !='' && Month!='' && Amount!='') {
        $.ajax({
          type:'POST',
          url:'insert.php',
          data:{'SalaryAmount':Amount, 'Salary':Salary, 'Month':Month, 'StaffID':StaffID},
          success:function(result){
            swal("success","Salary Updated","success"); 
            $('#re').html(result);
            $('#AddSalary').modal('hide');
            $('#SalaryForm').trigger("reset");
          }
        });
      }else{
        swal("error","Please enter all fields","error");
      }
    });


    $(document).on('change', '#CourseID', function(){
      var CourseID= $(this).val();

      if(CourseID){
        $.ajax({
          type:'POST',
          url:'search.php',
          data:{'CourseID':CourseID},
          success:function(result){
            $('#BranchID').html(result);
          }
        }); 
      }else{
        $('#BranchID').html('<option value="">Branch</option>'); 
      }

    });

    $(document).on('change', '#CourseIDF', function(){
      var CourseID= $(this).val();

      if(CourseID){
        $.ajax({
          type:'POST',
          url:'search.php',
          data:{'CourseIDF':CourseID},
          success:function(result){
            $('#BranchIDF').html(result);
          }
        }); 
      }else{
        $('#BranchIDF').html('<option value="">Branch</option>'); 
      }

    });

  </script>

</body>
</html>

<?php   $con->close(); ?>