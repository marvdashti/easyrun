<?php
require 'config.php';
require 'imtp.php';
$imtp = new imtp();
$table = $_POST['table'];
$cols = explode(",",$_POST['cols']);
$excel = $_FILES['excel'];
$result = $imtp->import($table,$cols,$excel);
if($result == true) echo "Import is successfully!";
else echo "Error in import! Please check the file!";