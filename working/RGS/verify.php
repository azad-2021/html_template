<?php 
session_start();
include('connection.php');
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Email=!empty($_POST['Email'])?$_POST['Email']:'';
$Password=!empty($_POST['Password'])?$_POST['Password']:'';
if ((!empty($Email)) and (!empty($Password)))
{

	$Data="SELECT * from user WHERE Email='$Email' and Password='$Password'";
	$result=mysqli_query($con,$Data);
	if (mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		$_SESSION['user']=$row['UserName'];
		$_SESSION['userid']=$row['UserID'];
		$_SESSION['usertype']=$row['UserType'];
		echo 1;
	}


}




?>