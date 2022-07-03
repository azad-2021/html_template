<?php 
include"connection.php";
session_start();
$EmailStaff=!empty($_POST['EmailStaff'])?$_POST['EmailStaff']:'';
$PasswordStaff=!empty($_POST['PasswordStaff'])?$_POST['PasswordStaff']:'';
if ((!empty($EmailStaff)) and (!empty($PasswordStaff))){

	$Data="SELECT * from staff WHERE Email='$EmailStaff' and Password='$PasswordStaff'";
	$result=mysqli_query($con,$Data);
	if (mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		$_SESSION['user']=$row['StaffName'];
		$_SESSION['userid']=$row['StaffID'];
		$_SESSION['usertype']='Staff';
		echo 1;
	}


}

 ?>