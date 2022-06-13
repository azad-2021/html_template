<?php 

include"connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=3;
$TakenLeave=0;


if (isset($_POST['SaveLeave'])) {
  $Description=$_POST['Description'];
  $SDate=$_POST['SDate'];
  $EDate=$_POST['EDate'];

  $sql = "INSERT INTO LeaveApplication (StaffID, Description, StartDate, EndDate, ApplyDate)
  VALUES ($userid, '$Description', '$SDate', '$EDate', '$timestamp')";

  if ($con->query($sql) === TRUE) {

    $query ="SELECT TakenLeave FROM `staff` WHERE StaffID=$userid";
    $result2 = mysqli_query($con, $query);
    $arr=mysqli_fetch_assoc($result2);
    $Taken=$arr['TakenLeave'];
    $interval = date_diff(date_create($SDate), date_create($EDate));
    $d= $interval->format('%R%a');
    $int = (int)$d;   
    $TakenLeave=$int+$Taken;

    $sql = "UPDATE staff SET TakenLeave=$TakenLeave WHERE StaffID=$userid";
    if ($con->query($sql) === TRUE) {

      echo '<script>alert("Leave applied successfully")</script>';
      echo "<meta http-equiv='refresh' content='0'>";
    }else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$query ="SELECT * FROM staff WHERE StaffID=$userid";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$TotalLeave=$row['StaffLeave'];
$TakenLeave=$row['TakenLeave'];
$BranchID=$row['BranchID'];

$query ="SELECT count(StudentID) FROM students WHERE BranchID=$BranchID and Passout=0";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$NoStudents=$row['count(StudentID)'];

$query ="SELECT sum(SalaryAmount), sum(ReceivedAmount) FROM salarydetails WHERE StaffID=$userid";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$PendingSalary=$row['sum(SalaryAmount)']-$row['sum(ReceivedAmount)'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <script src="../assets/js/sweetalert.min.js"></script>
  <style type="text/css">
    input, textarea{
      color: white;
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

          <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><?php echo $NoStudents; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Students</h6>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><?php echo $TotalLeave.' / '.$TakenLeave; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Leave / Taken leave</h6>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><i class="mdi mdi-currency-inr"></i><?php echo $PendingSalary; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Pending Salary</h6>
              </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Your Leave Status</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <th>Sr. No</th>
                      <th>Application No</th>
                      <th>Description</th>
                      <th> Duration</th>                    
                      <th>Status</th>
                      <th>Apply Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $query="SELECT * from LeaveApplication WHERE StaffID=$userid";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)>0){
                      $Sr=0;
                      while($row=mysqli_fetch_assoc($result)){
                        if ($row['Status']==0) {
                          $Status='<div class="badge badge-outline-warning">Pending</div>';
                        }elseif($row['Status']==1){
                          $Status='<div class="badge badge-outline-success">Approved</div>';
                        }elseif($row['Status']==2){
                          $Status='<div class="badge badge-outline-danger">Rejected</div>';
                        }
                        $Sr++;
                        print "<tr>";
                        print '<td>'.$Sr."</td>";
                        print '<td>'.$row['ApplicationID']."</td>";
                        print '<td>'.$row['Description']."</td>";
                        print '<td>'.date('d-m-Y',strtotime($row['StartDate'])).' to '.date('d-m-Y',strtotime($row['EndDate']))."</td>";
                        print '<td>'.$Status."</td>";
                        print '<td>'.date('d-m-Y',strtotime($row['ApplyDate']))."</td>";
                        print "</tr>";
                      }
                    }?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <h4>Your Salary of current year</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <th>Sr No</th>
                <th>Month</th>
                <th>Release Date</th>
                <th>Amount</th>
              </thead>
              <tbody>
                <?php 
                $query="SELECT * from salarydetails WHERE StaffID=$userid";

                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result)>0){
                  $Sr=0;
                  while($row=mysqli_fetch_assoc($result)){
                    if (!empty($row['UpdatedDate'])) {
                      $UpdateDate=date('d-m-Y',strtotime($row['UpdatedDate']));
                    }else{
                      $UpdateDate='';
                    }
                    $Sr++;
                    print "<tr>";
                    print '<td>'.$Sr."</td>";
                    print '<td>'.date('M-Y',strtotime($row['SalaryOfMonth']))."</td>";
                    print '<td>'.$UpdateDate."</td>";
                    print '<td>'.$row['ReceivedAmount']."</td>";
                    print "</tr>";
                  }
                }?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12 col-xl-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">To do list</h4>
              <div class="add-items d-flex">
                <input style="color:white" type="text" class="form-control todo-list-input" placeholder="enter task..">
                <button class="add btn btn-primary todo-list-add-btn">Add</button>
              </div>
              <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                  <li>
                    <div class="form-check form-check-primary">
                      <label class="form-check-label">
                        <input style="color:white" class="checkbox" type="checkbox"> Create invoice </label>
                      </div>
                      <i class="remove mdi mdi-close-box"></i>
                    </li>
                    <li>
                      <div class="form-check form-check-primary">
                        <label class="form-check-label">
                          <input style="color:white" class="checkbox" type="checkbox"> Meeting with Alita </label>
                        </div>
                        <i class="remove mdi mdi-close-box"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check form-check-primary">
                          <label class="form-check-label">
                            <input style="color:white" class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                          </div>
                          <i class="remove mdi mdi-close-box"></i>
                        </li>
                        <li>
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input style="color:white" class="checkbox" type="checkbox"> Plan weekend outing </label>
                            </div>
                            <i class="remove mdi mdi-close-box"></i>
                          </li>
                          <li>
                            <div class="form-check form-check-primary">
                              <label class="form-check-label">
                                <input style="color:white" class="checkbox" type="checkbox"> Pick up kids from school </label>
                              </div>
                              <i class="remove mdi mdi-close-box"></i>
                            </li>
                          </ul>
                        </div>
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

        <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../assets/vendors/chart.js/Chart.min.js"></script>
        <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
        <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
        <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
        <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../assets/vendors/chart.js/Chart.min.js"></script>
        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/hoverable-collapse.js"></script>
        <script src="../assets/js/misc.js"></script>
        <script src="../assets/js/settings.js"></script>
        <script src="../assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="../assets/js/dashboard.js"></script>
        <!-- End custom js for this page -->

        <script type="text/javascript">
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

      <?php  $con->close(); ?>