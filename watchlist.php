<?php 
	include 'core/init.php';
	protect_page();
include 'includes/overall/header.php'; ?>
<h1>Watchlist</h1>

<?php
	
	$url = $_GET['url'];
    $image = $_GET['image'];
	$title = $_GET['title'];
	$price = $_GET['price'];
	$fprice = $_GET['fprice'];
	$asn = $_GET['asn'];
	
	$user_id = $_SESSION['user_id'];
	
	$ctr = 0;

    $price = $price/100;
	
	if($asn != null)
	{
	mysql_query("insert into item_info(wasn,wurl,wprice,wfprice,wimage,wtitle,shop) values('".$asn."','".$url."',".$price.",'".$fprice."','".$image."','".$title."',1)"); 
	mysql_query("insert into watchlist values(".$user_id.",'".$asn."')");
	}
	
    $query = mysql_query("select * from item_info inner join watchlist on item_info.wasn = watchlist.wasin and  watchlist.user_id=".$user_id);
	
	while($rows = mysql_fetch_array($query))
	{
		$n_asn[$ctr] = $rows['wasn'];
		$n_title[$ctr] = $rows['wtitle'];
		$n_fprice[$ctr] = $rows['wfprice'];
		$n_image[$ctr] = $rows['wimage'];
		$n_shop[$ctr] = $rows['shop'];
		$n_currprice[$ctr] = $rows['wcurrprice'];
		$n_fcurrprice[$ctr] = $rows['wfcurrprice'];
		$n_url[$ctr]  = $rows['wurl'];

		$ctr=$ctr + 1;
	}

    if($ctr>0)
	{

 	?>
	

	<table align="center">
		<!--tr>
			<th></th>
			<th>Title</th>
			<th>Current Price</th>
			<th>Initial Price</th>
			<th>Store</th>
			</tr -->
		<?php
			
			for($i=0;$i<$ctr;$i++){
				?><tr style="padding: 20px" id="witem<?php echo $i?>">
				<td class="tableImage"><img src="<?php echo $n_image[$i] ?>"/></td>
				<td width="300px">
					<b><?php echo $n_title[$i]?></b><br><br>
					<span class="remove_from_watchlist">Remove from watchlist</span>
				</td>
				<td><?php echo $n_fcurrprice[$i] ?></td>
				<td><?php echo $n_fprice[$i] ?></td>
				<td>
				    <a href="<?php echo $n_url[$i] ?>" target="_blank" style="text-decoration: none;">
						<button class="submitButton watchlistTableButton">Buy</button>
					</a><br /> 
					<img src="amazon.png" height="60" width="60"> 
				</td>
				</tr>
				<tr style="background-color: rgba(0,0,0,0.3); height: 1px;">
					<td style="padding: 0px"></td>
					<td style="padding: 0px"></td>
					<td style="padding: 0px"></td>
					<td style="padding: 0px"></td>
					<td style="padding: 0px"></td>
				</tr>
				<?php } ?>
		</table>

	<?php 

		}
		else
		{
			?><br /><br /><center><h4>You Have no items in your watchlist</h4></center><?php
		}

	?>
	
	


<?php include 'includes/overall/footer.php'; ?>
