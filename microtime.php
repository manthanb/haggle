<?php
/**
 * Simple function to replicate PHP 5 behaviour
 */


$time_start = microtime();

// Sleep for a while
usleep(100);

// $time_end = microtime_float();
// $time = $time_end - $time_start;

echo "Did nothing in $time_start seconds\n";
?>