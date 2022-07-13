<?php      
    $host = "217.21.95.52";  
    $user = "u241098585_medshop";  
    $password = '1@STARlaboratories';  
    $db_1 = "u241098585_medshop";

   $con = mysqli_connect($host, $user, $password, $db_1);  
   if(mysqli_connect_errno()) {  
      die("Failed to connect with MySQL: ". mysqli_connect_error());  
   }
?> 