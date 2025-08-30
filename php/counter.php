<?php
$file = '../misc/counter.txt';
$counter = (int) file_get_contents($file);
$counter++;
file_put_contents($file, $counter);
echo "Current counter value: " . $counter;
?>
