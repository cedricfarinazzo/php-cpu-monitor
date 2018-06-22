<?php

require 'HardwareMonitoring.php';
$monitor = new \Monitoring\HardwareMonitoring(true);
$json = $monitor->ToJson();
echo $json;

?>
