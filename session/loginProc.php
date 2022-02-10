
<?php
include "lib.php";

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$uid = mysqli_real_escape_string($connect, $uid);
$pwd = mysqli_real_escape_string($connect, $pwd);

echo $pwd;
$query = "select*from members where uid='$uid' and pwd='$pwd'";
$result = mysqli_query($connect, $result);
$data - mysqli_fetch_array($result);

print_r($data);
?>