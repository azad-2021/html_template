<?php 
session_start();
include('connection.php');
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$username=!empty($_POST['username'])?$_POST['username']:'';
$Password=!empty($_POST['Password'])?$_POST['Password']:'';
if ((!empty($username)) and (!empty($Password)))
{

	$Data="SELECT * from students WHERE StudentName='$username' and Password='$Password'";
	$result=mysqli_query($con,$Data);
	if (mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		$_SESSION['user']=$row['StudentName'];
		$_SESSION['userid']=$row['StudentID'];
		$_SESSION['usertype']='Student';
		echo 1;
	}


}




?>