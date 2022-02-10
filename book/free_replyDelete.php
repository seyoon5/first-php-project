<?php
include "db.php";

$ridx = $_POST['ridx'];
$pwd = $_POST['password'];
$ridx = mysqli_real_escape_string($connect, $ridx);
$pwd = mysqli_real_escape_string($connect, $pwd);

$query = "select*from replyFree where idx='$ridx'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

$password = $data['password'];

if (!password_verify($pwd, $password)) {
    echo "<script>
    alert('비밀번호가 일치하지 않습니다.');
    history.back();
    </script>";
} else {
    $query = "delete from replyFree where idx='$ridx'";
    mysqli_query($connect, $query);
    // 재정렬
    $query = "SET @CNT=0;";
    mysqli_query($connect, $query);

    $query = "UPDATE replyFree SET replyFree.idx = @CNT:=@CNT+1;";
    mysqli_query($connect, $query);

    $query = "ALTER TABLE replyFree AUTO_INCREMENT=1;";
    mysqli_query($connect, $query);

    $cidx = $data['con_num'];
}
?>
<script>
    location.href = 'boardFreeView.php?idx=<?= $cidx ?>';
</script>a