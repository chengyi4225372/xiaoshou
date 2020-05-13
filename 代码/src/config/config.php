<?php
ob_start(); // Turns on output buffering.
session_start();

$timezone = date_default_timezone_set("Asia/Shanghai");


$con = mysqli_connect("localhost", "root", "root", "DBIProject", "8889");

if(mysqli_connect_errno()){
    echo "Failed to connecte: " . mysqli_connect_errno();
}
?>