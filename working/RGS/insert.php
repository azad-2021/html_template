<?php
include ('connection.php');

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$m=date('m',strtotime($timestamp));
$y=date('y',strtotime($timestamp));

if ($m<=3) {
  $FY=($y-1).'-'.$y;

}else{
  $FY=$y.'-'.($y+1);
}

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

$TotalAmount=!empty($_POST['TotalAmount'])?$_POST['TotalAmount']:'';
if (!empty($TotalAmount))
{
  $ReceivedAmount=!empty($_POST['ReceivedAmount'])?$_POST['ReceivedAmount']:'';
  $StudentID=!empty($_POST['StudentID'])?$_POST['StudentID']:'';
  $Year=!empty($_POST['Year'])?$_POST['Year']:'';
  $Remark=!empty($_POST['Remark'])?$_POST['Remark']:'';
  $BranchID=!empty($_POST['BranchID'])?$_POST['BranchID']:'';


  $sql = "INSERT INTO feesdetails (StudentID, Year, TotalAmount, ReceivedAmount, Remark, UpdatedByID, UpdatedDate)
  VALUES ($StudentID, $Year, $TotalAmount, $ReceivedAmount, '$Remark', $userid, '$Date')";

  if ($con->query($sql) === TRUE) {
    $last_id = $con->insert_id;
    $FY=$FY.$last_id;
    $sql="UPDATE feesdetails SET ReceiptNo='$FY' WHERE ID=$last_id";
    if ($con->query($sql) === TRUE) {
    }else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }

    $Data="SELECT sum(ReceivedAmount) from feesdetails WHERE StudentID=$StudentID";
    $result=mysqli_query($con,$Data);
    if (mysqli_num_rows($result)>0)
    {  
      $row=mysqli_fetch_assoc($result);
      $TotalReceivedAmount=$row['sum(ReceivedAmount)'];

      $sql="UPDATE students SET ReceivedAmount=$TotalReceivedAmount WHERE StudentID=$StudentID";
      if ($con->query($sql) === TRUE) {
      }else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }

    }


  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


  echo $FeesMonth;
}


$SalaryAmount=!empty($_POST['SalaryAmount'])?$_POST['SalaryAmount']:'';
if (!empty($SalaryAmount))
{

  $SID=!empty($_POST['SID'])?$_POST['SID']:'';

  $sql = "UPDATE salarydetails SET ReceivedAmount=$SalaryAmount, UpdatedByID=$userid, UpdatedDate='$Date' WHERE ID=$SID";
  if ($con->query($sql) === TRUE) {



  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


  //echo $FeesMonth;
}



$con->close();
?>