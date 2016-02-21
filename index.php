<?php 
	include 'core/init.php';
	include 'amazon.php';
	include 'flipkart.php';
	
include 'includes/overall/header.php'; ?>
<h1>Home</h1>

<center><form method="get">
			<input type="text" name="sstring" class="inputBox" placeholder="Enter the product name" value=""></input>
			&nbsp;&nbsp;&nbsp;
			<input type="submit" value="Search" name="sbutton" class="submitButton"></input>
		</form></center>
		
		<div id="results_amazon">
			
			<?php
				
				if(isset($_GET['sbutton']) && $_GET['sstring']!="" && $_GET['sstring']!=null)
				{	
					$sstring = $_GET['sstring'];
					
					$am = new Amazon($sstring);

					$i = 0;
					
					while($am->asn[$i]!=null)
					{
						if($am->image[$i] == null)
							$am->image[$i] = 'nia.jpg';

						if(strlen($am->title[$i])>75)
							$am->title[$i] = substr($am->title[$i], 0, 74)."...";
						
						?>
						<a href="<?php echo $am->url[$i];?>" target="_blank">
						<div id="items">
						<center><img src="<?php echo $am->image[$i]; ?>"></center>
						<br /><center><strong><?php echo $am->title[$i]; ?></strong></center>
						<center><?php echo $am->fprice[$i]; ?></center>
						<span style="">
						<button class="button-secondary pure-button" -->Buy</button>
						<a href="<?php echo "watchlist.php?url=".$am->url[$i]."&image=".$am->simage[$i]."&title=".$am->title[$i]."&price=".$am->price[$i]."&fprice=".$am->fprice[$i]."&asn=".$am->asn[$i]?>"><button class="button-success pure-button">Add to Watchlist</button></a>
						</span>
						</div></a>
						<?php
						     $i = $i + 1;
						    }
							if($i==0)
					        {
								?><br /><br /><center><h4>OOPS! No items found!</h4></center><?php
							}
							}
							?>
		</div>

		<div id="results_flipkart">
			
			<?php
				
				if(isset($_GET['sbutton']) && $_GET['sstring']!="" && $_GET['sstring']!=null)
				{	
					$sstring = $_GET['sstring'];
					
					$fk = new Flipkart($sstring);

					$i = 0;
					
					while($fk->id[$i]!=null)
					{
						if($fk->image[$i] == null)
							$fk->image[$i] = 'nia.jpg';

						if(strlen($am->title[$i])>75)
							$fk->title[$i] = substr($fk->title[$i], 0, 74)."...";
						
						?>
						<a href="<?php echo $fk->productUrl[$i];?>" target="_blank">
						<div id="items">
						<center><img src="<?php echo $fk->image[$i]; ?>"></center>
						<br /><center><strong><?php echo $fk->title[$i]; ?></strong></center>
						<center><?php echo $am->sellingPprice[$i]; ?></center>
						<span style="">
						<button class="button-secondary pure-button" -->Buy</button>
						<a href="<?php echo "watchlist.php?url=".$fk->productUrl[$i]."&image=".$fk->image[$i]."&title=".$fk->title[$i]."&maximumRetailPrice=".$fk->maximumRetailPricerice[$i]."&sellingPprice=".$fk->sellingPprice[$i]."&id=".$fk->id[$i]?>"><button class="button-success pure-button">Add to Watchlist</button></a>
						</span>
						</div></a>
						<?php
						     $i = $i + 1;
						    }
							if($i==0)
					        {
								?><br /><br /><center><h4>OOPS! No items found!</h4></center><?php
							}
							}
							?>
		</div>
		
		<br />
		
		
		
		<?php 
			include 'includes/overall/footer.php'; 
			?>