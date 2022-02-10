<?php
include "db.php";
// 글쓰기
$content = $_POST['content'];
$name = $_POST['name'];
$password = $_POST['password'];
$cidx = $_GET['idx'];
// 수정
$edit_ridx = $_POST['edit_ridx'];
$edit_rcontent = $_POST['edit_rcontent'];

$edit_ridx = mysqli_real_escape_string($connect, $edit_ridx);
$edit_rcontent = mysqli_real_escape_string($connect, $edit_rcontent);

$content = mysqli_real_escape_string($connect, $content);
$name = mysqli_real_escape_string($connect, $name);
$password = mysqli_real_escape_string($connect, $password);
$cidx = mysqli_real_escape_string($connect, $cidx);

if ($edit_ridx) {
    $query = "update replyFree set content='$edit_rcontent', created=NOW() where idx='$edit_ridx'";
    mysqli_query($connect, $query);
} else {
    if (empty($content) || empty($name) || empty($password)) {
        echo
        "<script>alert('작성하지 않은 내용이 있습니다.');
                        history.back();
                        </script>";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "insert into replyFree(con_num, name, content, created, password) values('$cidx', '$name', '$content', NOW(), '$password')";
        mysqli_query($connect, $query);
        echo $rcontent;
    }
}


$cidx = $_GET['idx'];


?>

<script>
    location.href = "boardFreeView.php?idx=<?= $cidx ?>";
</script>