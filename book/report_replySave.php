<?php
include "db.php";

$content = $_POST['content'];
$idx = $_POST['idx'];
$ridx = $_POST['ridx'];

$idx = mysqli_real_escape_string($connect, $idx);
$content = mysqli_real_escape_string($connect, $content);
$ridx = mysqli_real_escape_string($connect, $ridx);
$isId = mysqli_real_escape_string($connect, $isId);

$query = "select*from replyReport where idx='$ridx'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

$rcontent = $data['content'];

if (isset($rcontent)) {
    $query = "update replyReport set con_num='$idx', name='$isName', content='$content', created=NOW() where idx='$ridx'";
    mysqli_query($connect, $query);
} else if (empty($content)) {
    echo
    "<script>alert('내용을 작성해 주세요.');
                history.back();
                </script>";
} else {
    $query = "insert into replyReport(con_num, name, content, created, id) values('$idx', '$isName', '$content', NOW(), '$isId')";
    mysqli_query($connect, $query);
}
$idx = $_POST['idx'];
?>

<script>
    location.href = "boardReportView.php?idx=<?= $idx ?>";
</script>