<?php
session_start();
error_reporting(1);
ini_set("display_errors", 1);

$connect = mysqli_connect('127.0.0.1', 'root', 'dhtprnt', 'workbench');

if (mysqli_connect_errno()) {
    echo 'DB 접속 오류';
    echo mysqli_connect_error();
    exit();
}
