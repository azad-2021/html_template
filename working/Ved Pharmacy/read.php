<?php 
include "connection.php";

$userid=1;

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


$FindItem=!empty($_POST['FindItem'])?$_POST['FindItem']:'';
if (!empty($FindItem))
{
  $FindItem ='%'.$FindItem.'%';

include"FindItem.php";

}


$ItemList=!empty($_POST['ItemList'])?$_POST['ItemList']:'';
if (!empty($ItemList))
{

include"ItemListData.php";

}


$CategoryIDP=!empty($_POST['CategoryIDP'])?$_POST['CategoryIDP']:'';
if (!empty($CategoryIDP))
{
    $query="SELECT * from items WHERE CategoryID=$CategoryIDP order by ItemName";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select item</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['ItemID']."'>".$arr['ItemName']."</option><br>";
        }
    }else{
      echo "<option value=''>no item</option>";
    }
    
}

$ItemRate=!empty($_POST['ItemRate'])?$_POST['ItemRate']:'';
if (!empty($ItemRate))
{
    $query="SELECT * from items WHERE ItemID=$ItemRate";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {   
        $arr=mysqli_fetch_assoc($result);
        echo $arr['SellingRate'];
    }
}