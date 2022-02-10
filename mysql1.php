
<?php
$host = '127.0.0.1';
$user = 'root';
$pw = 'dhtprnt';
$dbName = '';
$mysqli = mysqli_connect($host, $user, $pw, $dbName);

if ($mysqli) {
    echo "suda1222";
} else {
    echo "fail";
}
?>