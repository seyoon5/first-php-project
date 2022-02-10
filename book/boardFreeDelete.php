<?php
include "db.php";

$idx = $_POST['idx'];
$password = $_POST['password'];
$idx = mysqli_real_escape_string($connect, $idx);
$password = mysqli_real_escape_string($connect, $password);

$query = "select*from boardFree where idx='$idx'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);
$hash = $data['password'];

if (!password_verify($password, $hash)) {
    echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        history.back();
        </script>";
} else {
    $query = "delete from boardFree where idx='$idx'";
    mysqli_query($connect, $query);

    // 재정렬
    $query = "SET @CNT=0;";
    mysqli_query($connect, $query);

    $query = "UPDATE boardFree SET boardFree.idx = @CNT:=@CNT+1;";
    mysqli_query($connect, $query);

    $query = "ALTER TABLE boardFree AUTO_INCREMENT=1;";
    mysqli_query($connect, $query);

    //게시글 안에 있는 댓글 삭제
    $query = "delete from replyFree where con_num='$idx'";
    mysqli_query($connect, $query);

    $query = "UPDATE replyFree SET con_num = '$idx' where con_num = '$idx'+1";
    mysqli_query($connect, $query);

    $query = "SET @CNT=0;";
    mysqli_query($connect, $query);

    $query = "UPDATE replyFree SET replyFree.con_num = @CNT:=@CNT+1;";
    mysqli_query($connect, $query);

    $query = "ALTER TABLE replyFree AUTO_INCREMENT='$idx'+1;";
    mysqli_query($connect, $query);

    // 재정렬
    $query = "SET @CNT=0;";
    mysqli_query($connect, $query);

    $query = "UPDATE replyFree SET replyFree.idx = @CNT:=@CNT+1;";
    mysqli_query($connect, $query);

    $query = "ALTER TABLE replyFree AUTO_INCREMENT=1;";
    mysqli_query($connect, $query);
}

?>
<script>
    location.href = 'boardFree.php';
</script>