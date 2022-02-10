
<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'dhtprnt', 'opentutorials');
$sql = "
INSERT INTO author
(name, profile)
VALUE('{$_POST['name']}', '{$_POST['profile']}') 
";

$result = mysqli_query($conn, $sql);
if ($result == false) {
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
} else {
    header('Location: author.php');
}
echo $sql;

?>