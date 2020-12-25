<?php
require 'config.php';
require 'imtp.php';
$imtp = new imtp();
?>
<!DOCTYPE html>
<html>
<head>
    <title>EASYRUN - Easy import csv to database</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <div class="im-title">
        <h1>EASYRUN</h1>
        <h3>Easy import csv to database</h3>
    </div>
    <div class="im-body">
        <?php if($imtp->alert != '') { ?>
        <div class="alert alert-danger">
            <?php
            echo $imtp->alert;
            die();
            ?>
        </div>
        <?php } ?>
        <div class="im-form-row">
            <div class="im-form-label">
                Database Table:
            </div>
            <div class="im-form-inp">
                <?php $imtp->getTables(); ?>
            </div>
        </div>
        <div class="im-form-row">
            <div class="im-form-label">
                Select Columns:
            </div>
            <div class="im-form-inp" id="column-content">
                Please select a table!
            </div>
        </div>
        <div class="im-form-row">
            <div class="im-form-label">
                Excel File:
            </div>
            <div class="im-form-inp">
                <input type="file" name="db-excel">
            </div>
        </div>
        <div class="im-form-row">
            <div class="im-form-label"></div>
            <div class="im-form-inp">
                <input type="checkbox" name="db-sure"> I'm sure to import.
            </div>
        </div>
        <div class="im-form-row">
            <div class="im-form-label"></div>
            <div class="im-form-inp">
                <button type="button" class="im-import-btn" onclick="importData();">Import</button>
            </div>
        </div>
        <div id="response" class="alert alert-danger" style="display: none"></div>
    </div>
    <div class="copy-right">
        <p>Developed by <a href="https://mrtolouei.com/" target="_blank">Alireza Tolouei.</a> </p>
        <p>Get this application on <a href="" target="_blank">Github.</a></p>
    </div>
</div>
<script src="body.js"></script>
</body>
</html>
