<?php 

$query="SELECT * from items
join category on items.CategoryID=category.CategoryID
WHERE ItemName like '$FindItem'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	?>
	<table class="table table-hover table-bordered border-primary table-responsive">
		<thead>
			<th>Item Name</th>
			<th>Sale Rate</th>
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
				print '<td>'.$row['Category']."</td>";
				print "<tr>";  
			}
			?>
		</tbody>
	</table>
	<?php 
}

?>