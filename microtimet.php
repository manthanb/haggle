<?php
  
  $now = microtime(true); 
$x=0;
while ($x<10000000)
  {
  $x++;
  }
echo microtime(true) - $now;


?>