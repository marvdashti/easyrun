<?php
require 'config.php';
require 'easyrun.php';
$easyRun = new easyrun();
$table = $_POST['table'];
$easyRun->getColumns($table);