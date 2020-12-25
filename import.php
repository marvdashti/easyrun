<?php
require 'config.php';
require 'easyrun.php';
$easyRun = new easyrun();
$table = $_POST['table'];
$cols = explode(",",$_POST['cols']);
$excel = $_FILES['excel'];
$result = $easyRun->import($table,$cols,$excel);
if($result == true) echo "Import is successfully!";
else echo "Error in import! Please check the file!";