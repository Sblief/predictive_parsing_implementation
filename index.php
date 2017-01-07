<?php
include ("processor.php");
  $process = new Processor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lexical Analyzer</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="container well text-center">
    <div class="row">
        <img src="Picture1.png">
    </div>
    <?  $out = $process->main(); ?>
    </div>
