<?php 

include"connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Day = date('d',strtotime($timestamp));
$TakenLeave=0;

//echo $Date;
if ($Day==1) {

  $query="SELECT * from salarydetails WHERE SalaryOfMonth='$Date'";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result)>0)
  {

  }else{
    $query2="SELECT SalaryAmount, StaffID from staff WHERE Inservice=1";

    $result2 = mysqli_query($con,$query2);
    if(mysqli_num_rows($result2)>0)
    {

      while($arr=mysqli_fetch_assoc($result2)){
        $SalaryAmount=$arr['SalaryAmount'];
        $StaffID=$arr['StaffID'];

        $sql = "INSERT INTO salarydetails (StaffID, SalaryOfMonth, SalaryAmount)
        VALUES ($StaffID, '$Date', $SalaryAmount)";

        if ($con->query($sql) === TRUE) {



        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }


      }

    }
  }
}



$userid=1;

if (isset($_POST['SaveStaff'])) {
  $Name=$_POST['StaffName'];
  $Mobile=$_POST['StaffNumber'];
  $Aadhar=$_POST['StaffAadhar'];
  $Gender=$_POST['Gender'];
  $Address=$_POST['StaffAddress'];
  $Education=$_POST['StaffEducation'];
  $Email=$_POST['StaffEmail'];
  $Salary=$_POST['SalaryAmount'];
  $BranchID=$_POST['BIDAddStaff'];

  $file_name = $_FILES['Resume']['name'];
  $file_size =$_FILES['Resume']['size'];
  $file_tmp =$_FILES['Resume']['tmp_name'];
  $file_type=$_FILES['Resume']['type'];
  $tmp = explode('.', $_FILES['Resume']['name']);
  $file_ext = strtolower(end($tmp));    
  $Resume=$Name.".".$file_ext;         
  $extensions= array("pdf");

  $errors='';
  $query ="SELECT * FROM `staff` WHERE MobileNo=$Mobile";
  $result1 = mysqli_query($con, $query);
  

  $query ="SELECT * FROM `staff` WHERE Email='$Email'";
  $result2 = mysqli_query($con, $query);

  if(in_array($file_ext,$extensions)=== false){
    $errors ='<script>alert("File must be pdf")</script>';
  }elseif($file_size > 2097152){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif($file_size == 0){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif(strlen((string)$Mobile<10)){
    $errors='<script>alert("Mobile Number Must Be 10 Digit Long")</script>';
  }elseif (mysqli_num_rows($result1)>0){
    $errors='<script>alert("Mobile Number Already Exist")</script>';
  }elseif (mysqli_num_rows($result2)>0){
    $errors='<script>alert("Email Already Exist")</script>';
  }

  if (empty($errors)) {

    $sql = "INSERT INTO staff (StaffName, MobileNo, Email, AadharCardNo, Address, EducationDetails, Password, EntryDate, EntryByID, Gender, SalaryAmount, BranchID)
    VALUES ('$Name', $Mobile, '$Email', $Aadhar, '$Address', '$Education', 'demo@123', '$Date', $userid, '$Gender', $Salary, $BranchID)";

    if ($con->query($sql) === TRUE) {
      $StaffID = $con->insert_id;
      $Upload=move_uploaded_file($file_tmp,"resume/".$Resume);


      $date = new DateTime('now');
      $date->modify('last day of this month');
      $d=$date->format('Y-m-d');
      $d=date('Y-m-d', strtotime($d));
      $lastdate=date_create($d);
      $ldate= $lastdate->format('Y-m-d');
      $interval = date_diff(date_create($Date), date_create($ldate));
      $d= $interval->format('%R%a');
      $int = (int)$d;     
      $SalaryAmount=($Salary/30)*$int;

      $sql = "INSERT INTO salarydetails (StaffID, SalaryOfMonth, SalaryAmount)
      VALUES ($StaffID, '$Date', $SalaryAmount)";

      if ($con->query($sql) === TRUE) {
        echo '<script>alert("Staff added successfully")</script>';
        echo "<meta http-equiv='refresh' content='0'>";
      }else{
        echo "Error: " . $sql . "<br>" . $con->error;
      }

    }else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }

  }else{
    echo $errors;
  }
}



if (isset($_POST['SaveStudent'])) {
  $Name=$_POST['StudentName'];
  $BranchID=$_POST['BranchID'];
  $Father=$_POST['Father'];
  $Mother=$_POST['Mother'];
  $Gender=$_POST['Gender'];
  $Address=$_POST['Address'];
  $Aadhar=$_POST['Aadhar'];
  $Mobile=$_POST['Mobile'];
  $lateral=$_POST['lateral'];
  $Remark=$_POST['Remark'];
  $Amount=$_POST['Amount'];

  $file_name = $_FILES['image']['name'];
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];
  $tmp = explode('.', $_FILES['image']['name']);
  $file_ext = strtolower(end($tmp));    
  $file=$Aadhar.".".$file_ext;         
  $extensions= array("jpeg", "JPEG", "jpg", "JPG");

  $errors='';

  if(in_array($file_ext,$extensions)=== false){
    $errors ='<script>alert("File must be JPG or JPEG format")</script>';
  }elseif($file_size > 2097152){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif($file_size == 0){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif(strlen((string)$Mobile<10)){
    $errors='<script>alert("Mobile Number Must Be 10 Digit Long")</script>';
  }

  if (empty($errors)) {


    if (empty($lateral)==true) {
      $lateral=0;
    }

    $sql = "INSERT INTO students (StudentName, BranchID, Gender, FatherName, MotherName, AadharCardNo, MobileNo,  Address, LateralEntry, CourseAmount, Password, Remark, RegistrationDate, RegisteredByID )
    VALUES ('$Name', $BranchID, '$Gender', '$Father', '$Mother', '$Aadhar', '$Mobile', '$Address', $lateral, $Amount, 'demo@123', '$Remark', '$Date', $userid)";

    if ($con->query($sql) === TRUE) {
      $Upload=move_uploaded_file($file_tmp,"student_pic/".$file);
      echo '<script>alert("Student added successfully")</script>';
      echo "<meta http-equiv='refresh' content='0'>";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }else{
    echo $errors;
    echo "<meta http-equiv='refresh' content='0'>";
  }

}

$query ="SELECT count(StaffID) FROM staff WHERE Inservice=1";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$NoStaff=$row['count(StaffID)'];

$query ="SELECT count(StudentID), sum(CourseAmount), sum(ReceivedAmount), Course FROM students JOIN branchs on students.BranchID=branchs.BranchID join courses on branchs.CourseID=courses.CourseID WHERE Passout=0 GROUP BY courses.CourseID order by Course";
$result = mysqli_query($con, $query);

$NoStudentsArray=array();
$PendingFeesArray=array();
while($row=mysqli_fetch_assoc($result)){
  $NoStudentsArray[]=$row['count(StudentID)'];
  $PendingFeesArray[]=$row['sum(CourseAmount)']-$row['sum(ReceivedAmount)'];
  $PF=$row['sum(CourseAmount)']-$row['sum(ReceivedAmount)'];
  $data[]=array("Course"=>$row['Course'], "PendingFees"=>$PF);
}

$NoStudents=array_sum($NoStudentsArray);
$PendingFees=array_sum($PendingFeesArray);
$query ="SELECT sum(salarydetails.SalaryAmount), sum(salarydetails.ReceivedAmount), StaffName FROM salarydetails
join staff on salarydetails.StaffID=staff.StaffID
WHERE Inservice=1 GROUP BY salarydetails.StaffID";

$StaffArray=array();
$PendingSalaryArray=array();
$PendingSalary=0;
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_assoc($result)){
  $StaffArray[]=$row['StaffName'];
  $PendingSalaryArray[]=$row['sum(salarydetails.SalaryAmount)']-$row['sum(salarydetails.ReceivedAmount)'];
}

$PendingSalary=array_sum($PendingSalaryArray);




$query ="SELECT COUNT(attendencedetails.StudentID) as TotalStudent, Course, courses.CourseID FROM `attendencedetails` join students on attendencedetails.StudentID=students.StudentID JOIN branchs on students.BranchID=branchs.BranchID join courses on branchs.CourseID=courses.CourseID WHERE Passout=0 GROUP BY courses.CourseID order by Course";
$result = mysqli_query($con, $query);

$NoStudentsArray=array();
$PendingFeesArray=array();
while($row=mysqli_fetch_assoc($result)){
  $CourseID=$row['CourseID'];

  $query2 ="SELECT COUNT(attendencedetails.StudentID) as Present FROM `attendencedetails` join students on attendencedetails.StudentID=students.StudentID JOIN branchs on students.BranchID=branchs.BranchID join courses on branchs.CourseID=courses.CourseID WHERE Passout=0 and AttendanceStatus=1 and courses.CourseID=$CourseID";
  $result2 = mysqli_query($con, $query2);
  $row2=mysqli_fetch_assoc($result2);

  $Attendance=($row2['Present']/$row['TotalStudent'])*100;
  $data2[]=array("Course"=>$row['Course'], "Attendance"=>$Attendance);
}

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
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
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
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><?php echo $NoStaff; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Staff</h6>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0"><i class="mdi mdi-currency-inr"></i><?php echo $PendingFees; ?></h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success">
                      <span class="mdi mdi-poll icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">Pending Fees</h6>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
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
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Pending Fees</h4>
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Student Attanndance (%)</h4>
                <canvas id="PercentageAttandance" style="height:230px"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Staff Leave Status</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <th>Sr. No</th>
                      <th> Staff Name </th>
                      <th> Application No </th>
                      <th> Description </th>
                      <th> Duration </th>
                      <th> Total Leave </th>    
                      <th> Taken Leave </th>  
                      <th>Apply Date</th>                    
                      <th> Status </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $query="SELECT * from LeaveApplication 
                    join staff on LeaveApplication.StaffID=staff.StaffID
                    WHERE Inservice=1";

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
                        print '<td>'.$row['StaffName']."</td>";
                        print '<td>'.$row['ApplicationID']."</td>";
                        print '<td>'.$row['Description']."</td>";
                        print '<td>'.date('d-m-Y',strtotime($row['StartDate'])).' to '.date('d-m-Y',strtotime($row['EndDate']))."</td>";
                        print '<td>'.$row['StaffLeave']."</td>";
                        print '<td>'.$row['TakenLeave']."</td>";
                        print '<td>'.$Status."</td>";
                        print '<td>'.date('d-m-Y',strtotime($row['ApplyDate']))."</td>";
                        print '<td><button class="btn btn-primary">Accept</button> <button class="btn btn-danger"> Reject</button></td>';
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

        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
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
        <script type="text/javascript">
          var data= <?php print_r(json_encode($data)); ?>;

          var Course = [];
          var PendingFees = [];
          console.log(Course.length);

          for(var i = 0; i < data.length; i++) {
            Course.push(data[i].Course);
            PendingFees.push(data[i].PendingFees);
          }

          var data2= <?php print_r(json_encode($data2)); ?>;

          var CourseAttendance = [];
          var Attendance = [];


          for(var i = 0; i < data2.length; i++) {
            CourseAttendance.push(data2[i].Course);
            Attendance.push(data2[i].Attendance);
          }

        </script>

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

        <script type="text/javascript">

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


          $(document).on('change', '#CIDAddStaff', function(){
            var CourseID= $(this).val();

            if(CourseID){
              $.ajax({
                type:'POST',
                url:'search.php',
                data:{'CourseIDF':CourseID},
                success:function(result){
                  $('#BIDAddStaff').html(result);
                }
              }); 
            }else{
              $('#BIDAddStaff').html('<option value="">Branch</option>'); 
            }

          });


//salary

$(document).on('change', '#CIDAddSalary', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseIDF':CourseID},
      success:function(result){
        $('#BIDAddSalary').html(result);
      }
    }); 
  }else{
    $('#BIDAddSalary').html('<option value="">Branch</option>'); 
  }

});


$(document).on('change', '#BIDAddSalary', function(){
  var BranchID=$(this).val();
  
  if (BranchID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchIDS':BranchID},
      success:function(result){
        $('#StaffIDS').html(result);
      }
    });

  }else{
    $('#StaffIDS').html('<option value="">Staff</option>'); 
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

    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StaffIDD':StaffID},
      success:function(result){
        $('#SalaryData').html(result);
      }
    });

  }
});


$(document).on('click', '.SaveSalary', function(){

  var SID=$(this).attr("id2");
  var Salary = document.getElementById(SID).value;
  console.log(Salary);
  var StaffID= document.getElementById("StaffIDS").value;
  if (Salary) {
    $.ajax({
      type:'POST',
      url:'insert.php',
      data:{'SalaryAmount':Salary, 'SID':SID},
      success:function(result){
        swal("success","Salary Updated","success"); 
      }
    });

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
     $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StaffIDD':StaffID},
      success:function(result){
        $('#SalaryData').html(result);
      }
    });
   }, delayInMilliseconds);

  }else{
    swal("error","Please enter salary release amount","error");
  }
});

$(document).on('click', '.cl', function(){

  var delayInMilliseconds = 1000; 

  setTimeout(function() {
    location.reload();
  }, delayInMilliseconds);


});
</script>

</body>
</html>

<?php
echo $PendingSalary;
$con->close(); ?>