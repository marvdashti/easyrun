<?php
require_once 'config.php';
require_once 'imtp.php';
$imtp = new imtp();
$table = $_POST['table'];
$imtp->getColumns($table);