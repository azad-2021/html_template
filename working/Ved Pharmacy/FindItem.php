<?php 

$query="SELECT * from items
join category on items.CategoryID=category.CategoryID
JOIN purchase ON purchase.ItemID=items.ItemID
WHERE ItemName like '$FindItem'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	?>
	<table class="table table-hover table-bordered border-primary table-responsive">
		<thead>
			<th>Item Name</th>
			<th>Sale Rate</th>
			<th>Purchase Rate</th>
			<th>In stock</th>
			<th>Expiry Date</th>
			<th>Category</th>
		</thead>
		<tbody>

			<?php 
			$Sr=1;
			while ($row=mysqli_fetch_assoc($result))
			{
				print "<tr>";
				//print '<td>'.$Sr."</td>";
				print '<td>'.$row['ItemName']."</td>";
				print '<td>'.$row['SellingRate']."</td>";
				print '<td>'.$row['PurchaseRate']."</td>";
				print '<td>'.$row['Qty']-$row['SaledQty']."</td>";
				print '<td><span class="d-none">'.$row['ExpiryDate'].'</span>'.date('d-M-Y',strtotime($row['ExpiryDate']))."</td>";
				print '<td>'.$row['Category']."</td>";
				print "<tr>";  
			}
			?>
		</tbody>
	</table>
	<?php 
}

?>