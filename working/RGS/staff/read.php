<?php
include ('connection.php');
include ('session.php');

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$userid=$_SESSION['userid'];

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


$BranchID=!empty($_POST['BranchID'])?$_POST['BranchID']:'';
if (!empty($BranchID))
{
    $StudentData="SELECT StudentID, StudentName from students WHERE BranchID=$BranchID order by StudentName";
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

$StudentID=!empty($_POST['StudentID'])?$_POST['StudentID']:'';
if (!empty($StudentID))
{
    $StudentData="SELECT CourseAmount from students WHERE StudentID=$StudentID";
    $result = mysqli_query($con,$StudentData);
    if(mysqli_num_rows($result)>0)
    {
        $arr=mysqli_fetch_assoc($result);
        echo $arr['CourseAmount'];
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

$Studentlist=!empty($_POST['Studentlist'])?$_POST['Studentlist']:'';
if (!empty($Studentlist))
{
    $Year=$_POST['Year'];
    $BranchID=$_POST['Branch'];
    $query ="SELECT * FROM students
    join student_year on students.StudentID=student_year.StudentID
    WHERE BranchID=$BranchID and Passout=0 and Year=$Year";

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result)>0){

      while($row=mysqli_fetch_assoc($result)){

        if ($row['LateralEntry']==1) {
          $Lateral='Yes';
      }else{
          $Lateral='No';
      }
      $StudentID=$row['StudentID'];
      

      $query="SELECT * FROM u241098585_college_demo.attendencedetails WHERE StudentID=$StudentID and `Date`='$Date'";
      $result2 = mysqli_query($con, $query);
      if (mysqli_num_rows($result2)>0){
        $row2=mysqli_fetch_assoc($result2);

        if ($row2['AttendanceStatus']==1) {
            $Today='Present';
            $tr='<tr class="table-success">';
        }else{
            $Today='Absent';
            $tr='<tr class="table-danger">';
        }
      }else{
        $Today='Not Taken';
        $tr='<tr class="table-primary">';
      }
      echo $tr;
      ?>
      

          <td><?php echo $row['StudentName']; ?></td>
          <td><?php echo $row['FatherName'];?></td>
          <td><?php echo $Lateral?></td>
          <td><?php echo $Today; ?></td>
          <td>
            <select style="color: white" class="form-control" id="at" id2="<?php echo $row['StudentID']; ?>">
              <option value="">Select</option>
              <option value="1">Present</option>
              <option value="0">Absent</option>
          </select>
      </td>
  </tr>
<?php }
}
} 

?>