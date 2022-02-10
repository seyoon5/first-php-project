
<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'dhtprnt', 'opentutorials');
$sql = "
UPDATE topic
SET title = '{$_POST['title']}',
description = '{$_POST['description']}'
WHERE id= '{$_POST['id']}'
";
$result = mysqli_query($conn, $sql);
if ($result == false) {
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
} else {
    echo '저장에 성공해습니다. <a href="index.php">돌아가기</a>';
}
echo $sql;

?>