<?php
	$interval=60; //minutes
	set_time_limit(0);
	while (true)
	{
		$now=time();
		include("updateItems.php");
		sleep($interval*60-(time()-$now));
	}
?>