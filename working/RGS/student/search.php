
<?php  
include('connection.php');   


$CourseID=!empty($_POST['CourseID'])?$_POST['CourseID']:'';
if (!empty($CourseID))
{
    $query="SELECT * from branchs WHERE CourseID=$CourseID order by BranchName";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BranchID']."'>".$arr['BranchName']."</option><br>";
        }
    }
    
}


$CourseIDF=!empty($_POST['CourseIDF'])?$_POST['CourseIDF']:'';
if (!empty($CourseIDF))
{
    $query="SELECT * from branchs WHERE CourseID=$CourseIDF order by BranchName";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BranchID']."'>".$arr['BranchName']."</option><br>";
        }
    }
    
}



if(isset($_POST["StudentName"]))
{   
  $Search='%'.$_POST["StudentName"].'%';
  $query = "SELECT * FROM students WHERE StudentName like '$Search'";  
  $result = $con->query($query);
}
?>

<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width:150px;">Name</th>
        <th style="min-width:150px;">Father Name</th>
        <th style="min-width:150px;">Mother Name</th>
        <th style="min-width:150px;">Address</th>           
        <th style="min-width:150px;">Aadhar</th>
        <th style="min-width:150px;">Mobile</th>                    
      </tr>                     
    </thead>                 
    <tbody>
      <?php

      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){
       print "<tr>";
       print '<td>'.$row['StudentName']."</td>";
       print '<td>'.$row['FatherName']."</td>";
       print '<td>'.$row['MotherName']."</td>";
       print "<td>".$row['Address']."</td>";
       print "<td>".$row['AadharCardNo']."</td>";             
       print "<td>".$row['MobileNo']."</td>";
       print "</tr>";
     }

     $con->close();
   }
   ?>
 </tbody>
</table>  
</div>