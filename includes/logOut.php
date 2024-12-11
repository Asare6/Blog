<?php
session_start();

$_SESSION['username'] = null;
$_SESSION['logged_in'] = false;

header('location: ../index.php')
?>