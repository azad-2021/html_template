
<?php 

include"connection.php";
include"session.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Day = date('d',strtotime($timestamp));
$userid=$_SESSION['userid'];
$TakenLeave=0;
$data=array();
$data2=array();
$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

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
      $Year=1;
    }else{
      $Year=2;
    }

    $sql = "INSERT INTO students (StudentName, BranchID, Gender, FatherName, MotherName, AadharCardNo, MobileNo,  Address, LateralEntry, CourseAmount, Password, Remark, RegistrationDate, RegisteredByID )
    VALUES ('$Name', $BranchID, '$Gender', '$Father', '$Mother', '$Aadhar', '$Mobile', '$Address', $lateral, $Amount, 'demo@123', '$Remark', '$Date', $userid)";

    if ($con->query($sql) === TRUE) {
      $last_id = $con->insert_id;
      $Upload=move_uploaded_file($file_tmp,"student_pic/".$file);

      $sql = "INSERT INTO u241098585_college_demo.student_year (StudentID, Year )
      VALUES ($last_id, $Year)";

      if ($con->query($sql) === TRUE) {

        echo '<script>alert("Student added successfully")</script>';
        //sleep(5);
        echo "<meta http-equiv='refresh' content='0'>";
      }else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
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
                      <h3 class="mb-0"><i class="mdi mdi-currency-inr"></i><?php echo number_format($PendingFees,2); ?></h3>
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
                      <h3 class="mb-0"><i class="mdi mdi-currency-inr"></i><?php echo number_format($PendingSalary,2); ?></h3>
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
                  <tbody id="LeaveData">

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
        <script src="ajax.js"></script>
        <script type="text/javascript">

        </script>

      </body>
      </html>

      <?php

      $con->close(); ?>