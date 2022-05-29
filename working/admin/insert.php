<?php
include ('connection.php');

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=1;


$Subject=!empty($_POST['subject'])?$_POST['subject']:'';
if (!empty($Subject))
{
  $ClassID=!empty($_POST['ClassID'])?$_POST['ClassID']:'';
  $sql = "INSERT INTO subjects (SubjectName, ClassID)
  VALUES ('$Subject', $ClassID)";

  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

}

$FeesAmount=!empty($_POST['FeesAmount'])?$_POST['FeesAmount']:'';
if (!empty($FeesAmount))
{
  $Fees=!empty($_POST['Fees'])?$_POST['Fees']:'';
  $StudentID=!empty($_POST['StudentID'])?$_POST['StudentID']:'';
  $Month=!empty($_POST['Month'])?$_POST['Month']:'';
  $Month=$Month.'-01';
  $FeesMonth=date('Y-m-d',strtotime($Month));

  $sql = "INSERT INTO feesdetails (StudentID, FeesOfMonth, TotalAmount, ReceivedAmount, UpdatedByID, UpdatedDate)
  VALUES ($StudentID, '$FeesMonth', $Fees, $FeesAmount, $userid, '$Date')";

  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


  echo $FeesMonth;
}


$SalaryAmount=!empty($_POST['SalaryAmount'])?$_POST['SalaryAmount']:'';
if (!empty($SalaryAmount))
{
  $Salary=!empty($_POST['Salary'])?$_POST['Salary']:'';
  $StaffID=!empty($_POST['StaffID'])?$_POST['StaffID']:'';
  $Month=!empty($_POST['Month'])?$_POST['Month']:'';
  $Month=$Month.'-01';
  $SalaryMonth=date('Y-m-d',strtotime($Month));

  $sql = "INSERT INTO salarydetails (StaffID, SalaryOfMonth, SalaryAmount, ReceivedAmount, UpdatedByID, UpdatedDate)
  VALUES ($StaffID, '$SalaryMonth', $SalaryAmount, $Salary, $userid, '$Date')";

  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


  //echo $FeesMonth;
}
$con->close();
?>