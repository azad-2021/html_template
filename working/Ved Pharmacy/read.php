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
    $query="SELECT * from items 
    join purchase on items.ItemID=purchase.ItemID
    WHERE CategoryID=$CategoryIDP and (Qty-SaledQty)>0 order by ItemName";
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
    $query="SELECT ItemName, SellingRate, (Qty-SaledQty) as AvQty from items 
    join purchase on items.ItemID=purchase.ItemID
    WHERE ItemID=$ItemRate";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {   
        $arr=mysqli_fetch_assoc($result);
        $d = array("SellingRate"=>$arr['SellingRate'], "ItemName"=>$arr['ItemName'], "AvQty"=>$arr['AvQty']);
        $data = json_encode($d);
        echo $data;
    }
}


$ExDate=!empty($_POST['ExDate'])?$_POST['ExDate']:'';
if (!empty($ExDate))
{   $ItemIDEx=!empty($_POST['ItemIDEx'])?$_POST['ItemIDEx']:'';
    $query="SELECT * from purchase WHERE ExpiryDate='$ExDate' and ItemID=$ItemIDEx";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {   
        echo 1;
    }else{
        echo 'This item is not in purchase list with '.date('d-M-Y',strtotime($ExDate)).' expiry date';
    }
}