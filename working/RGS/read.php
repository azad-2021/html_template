<?php
include ('connection.php');
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


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

$BranchIDS=!empty($_POST['BranchIDS'])?$_POST['BranchIDS']:'';
if (!empty($BranchIDS))
{
    $StaffData="SELECT StaffID, StaffName from staff WHERE BranchID=$BranchIDS order by StaffName";
    $result = mysqli_query($con,$StaffData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Staff</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['StaffID']."'>".$arr['StaffName']."</option><br>";
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


$StaffIDD=!empty($_POST['StaffIDD'])?$_POST['StaffIDD']:'';
if (!empty($StaffIDD))
{
    $query="SELECT * from salarydetails WHERE StaffID=$StaffIDD and (SalaryAmount-ReceivedAmount)>1";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
       while($row = mysqli_fetch_array($result)){
           print "<tr>";
           print '<td>'.$row['SalaryAmount']."</td>";
           print '<td>'.date('M-Y',strtotime($row['SalaryOfMonth']))."</td>";
           print '<td>'.$row['SalaryAmount']-$row['ReceivedAmount']."</td>";
           print '<td><input style="color:white" type="number" class="form-control" id="'.$row['ID'].'" min="0"></td>';             
           print '<td><button type="button" id2="'.$row['ID'].'" class="btn btn-primary SaveSalary">Release</button></td>';
           print "</tr>";
       }
   }

}

$BranchIDSt=!empty($_POST['BranchIDSt'])?$_POST['BranchIDSt']:'';
if (!empty($BranchIDSt))
{
    $query ="SELECT * FROM students
    join branchs on students.BranchID=branchs.BranchID
    join courses on branchs.CourseID=courses.CourseID
    WHERE Passout=0 and students.BranchID=$BranchIDSt order by StudentName";

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result)>0){
        $Sr=0;
        while($row=mysqli_fetch_assoc($result)){
            if ($row['LateralEntry']==1) {
              $Lateral='Yes';
          }else{
              $Lateral='No';
          }
          $Sr++;
          ?>
          <tr>
            <td><?php echo $Sr ?></td>
            <td><?php echo $row['StudentName']; ?></td>
            <td><?php echo $row['FatherName'];?></td>
            <td><?php echo $row['MotherName']?></td>
            <td><?php echo $row['Gender']?></td>
            <td><?php echo $row['AadharCardNo']?></td>
            <td><?php echo $row['MobileNo']?></td>
            <td><?php echo $row['Address']?></td>
            <td><?php echo $Lateral?></td>
            <td><?php echo $row['CourseAmount']?></td>
            <td><?php echo $row['ReceivedAmount']?></td>
            <td><?php echo $row['CourseAmount']-$row['ReceivedAmount']?></td>
            <td><?php echo $row['RegistrationDate']?></td>
            <td><?php echo $row['Remark']?></td>
            <td><button class="btn btn-primary FeesDetails" id="<?php echo $row['StudentID']?>" data-bs-toggle="modal" data-bs-target="#FeesDetails">View Fees Details </button> <button class="btn btn-primary Attendance">View Attendance</button></td>
        </tr>
    <?php }
}
}


$StudentIDFees=!empty($_POST['StudentIDFees'])?$_POST['StudentIDFees']:'';
if (!empty($StudentIDFees))
{
    $query="SELECT * from feesdetails WHERE StudentID=$StudentIDFees";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
       while($row = mysqli_fetch_array($result)){
           print "<tr>";
           print '<td>'.$row['ReceivedAmount']."</td>";
           print '<td>'.$row['Year']."</td>";
           print '<td>'.date('d-m-Y',strtotime($row['UpdatedDate']))."</td>";
           print '<td>'.$row['Remark']."</td>";
           print '<td>'.$row['ReceiptNo']."</td>";
           print "</tr>";
       }
   }

}


$BranchIDSta=!empty($_POST['BranchIDSta'])?$_POST['BranchIDSta']:'';
if (!empty($BranchIDSta))
{
    $query ="SELECT * FROM staff
    join branchs on staff.BranchID=branchs.BranchID
    join courses on branchs.CourseID=courses.CourseID
    WHERE staff.BranchID=$BranchIDSta order by StaffName";

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result)>0){
        $Sr=0;
        while($row=mysqli_fetch_assoc($result)){
          $StaffID=$row['StaffID'];
          $Sr++;

          $query ="SELECT sum(SalaryAmount), sum(ReceivedAmount) FROM salarydetails WHERE StaffID=$StaffID";
          $result2 = mysqli_query($con, $query);
          $row2=mysqli_fetch_assoc($result2);

          ?>
          <tr>
            <td><?php echo $Sr ?></td>
            <td><?php echo $row['StaffName']; ?></td>
            <td><?php echo $row['Gender']?></td>
            <td><?php echo $row['AadharCardNo']?></td>
            <td><?php echo $row['MobileNo']?></td>
            <td><?php echo $row['Address']?></td>
            <td><?php echo $row['Email']?></td>
            <td><?php echo $row['EducationDetails']?></td>
            <td><?php echo $row['SalaryAmount']?></td>
            <td><?php echo $row2['sum(SalaryAmount)']-$row2['sum(ReceivedAmount)']?></td>
            <td><?php echo $row['StaffLeave']?></td>
            <td><?php echo $row['TakenLeave']?></td>
            <td><?php echo $row['EntryDate']?></td>
            <td><button class="btn btn-primary SalaryDetailsS" id="<?php echo $row['StaffID']?>" data-bs-toggle="modal" data-bs-target="#SalaryDetail">View Salary Details </button></td>
        </tr>
    <?php }
}
}


$StaffIDSalary=!empty($_POST['StaffIDSalary'])?$_POST['StaffIDSalary']:'';
if (!empty($StaffIDSalary))
{
    $query="SELECT * from salarydetails WHERE StaffID=$StaffIDSalary";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
       while($row = mysqli_fetch_array($result)){
            if (!empty($row['UpdatedDate'])) {
                $UpdateDate=date('d-m-Y',strtotime($row['UpdatedDate']));
            }else{
                $UpdateDate='';
            }
           print "<tr>";
           print '<td>'.$row['ReceivedAmount']."</td>";
           print '<td>'.date('M-Y',strtotime($row['SalaryOfMonth']))."</td>";
           print '<td>'.$UpdateDate."</td>";
           print "</tr>";
       }
   }

}

?>