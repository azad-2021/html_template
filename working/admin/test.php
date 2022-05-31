<?php 
include"connection.php";
$query ="SELECT count(StudentID) FROM u241098585_school_demo.students WHERE Passout=0";
  $result = mysqli_query($con, $query);
  $row=mysqli_fetch_assoc($result);
  $NoStudents=$row['count(StudentID)'];
echo $NoStudents;

 ?>