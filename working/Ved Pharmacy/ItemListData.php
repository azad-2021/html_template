<?php 

$query="SELECT * FROM `purchase` 
JOIN items on purchase.ItemID=items.ItemID
JOIN sellers ON purchase.SellerID=sellers.SellerID
join category on items.CategoryID=category.CategoryID";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{

	$Sr=1;
	while ($row=mysqli_fetch_assoc($result))
	{
		print "<tr>";
		print '<td>'.$row['ItemName']."</td>";
		print '<td>'.$row['Category']."</td>";
		print '<td>'.$row['Qty']-$row['SaledQty'].'</td>';
		print '<td>'.$row['ExpiryDate']."</td>";
		print '<td>'.$row['SellerName']."</td>";
		print '<td>'.$row['PaidAmount']."</td>";
		print '<td>'.$row['Discount']."</td>";
		print '<td>'.$row['SellingRate']."</td>";
		print '<td>'.$row['PurchaseDate']."</td>";
		print "</tr>";  
	}


}

?>