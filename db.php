<?php

$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'job_posting';

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Cannot Connect to Database" . mysqli_connect_error());
}
