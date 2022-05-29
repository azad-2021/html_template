<?php
include ('connection.php');
$subjectlist=!empty($_POST['subjectlist'])?$_POST['subjectlist']:'';
if (!empty($subjectlist))
{


	$Data="SELECT * from subjects join class on subjects.ClassID=class.ClassID order by subjects.ClassID";
	$result=mysqli_query($con,$Data);
	if (mysqli_num_rows($result)>0)
	{   
		$Sr=1;
		while ($row=mysqli_fetch_assoc($result))
		{
			print "<tr>";
			print '<td>'.$Sr."</td>";
			print '<td>'.$row['SubjectName']."</td>";
			print '<td>'.$row['Class']."</td>";
			print '<td><buttoon type="button" class="btn btn-danger subdelete">Delete</button></td>';
			print "<tr>";             
			?>

			<?php 
			$Sr++;
		}
	}
}


$ClassID=!empty($_POST['ClassID'])?$_POST['ClassID']:'';
if (!empty($ClassID))
{
    $StudentData="SELECT StudentID, StudentName from students WHERE ClassID=$ClassID order by StudentName";
    $result = mysqli_query($con,$StudentData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Student</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['StudentID']."'>".$arr['StudentName']."</option><br>";
        }
    }
    
}

$ClassIDAmount=!empty($_POST['ClassIDAmount'])?$_POST['ClassIDAmount']:'';
if (!empty($ClassIDAmount))
{
    $query="SELECT Fees from class WHERE ClassID=$ClassIDAmount";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
    	$arr=mysqli_fetch_assoc($result);
        echo $arr['Fees'];
    }
    
}


$StaffID=!empty($_POST['StaffID'])?$_POST['StaffID']:'';
if (!empty($StaffID))
{
    $query="SELECT SalaryAmount from staff WHERE StaffID=$StaffID";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
    	$arr=mysqli_fetch_assoc($result);
        echo $arr['SalaryAmount'];
    }
    
}
?>