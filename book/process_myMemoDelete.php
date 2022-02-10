<?php
include "db.php";

$idx = $_GET['idx'];
$idx = mysqli_real_escape_string($connect, $idx);

$query = "delete from boardReport where idx='$idx'";
mysqli_query($connect, $query);

// 재정렬
$query = "SET @CNT=0;";
mysqli_query($connect, $query);

$query = "UPDATE boardReport SET boardReport.idx = @CNT:=@CNT+1;";
mysqli_query($connect, $query);

$query = "ALTER TABLE boardReport AUTO_INCREMENT=1;";
mysqli_query($connect, $query);

//게시글 안에 댓글 삭제
$query = "delete from replyReport where con_num='$idx'";
mysqli_query($connect, $query);

// 재정렬
$query = "SET @CNT=0;";
mysqli_query($connect, $query);

$query = "UPDATE replyReport SET replyReport.idx = @CNT:=@CNT+1;";
mysqli_query($connect, $query);

$query = "ALTER TABLE replyReport AUTO_INCREMENT=1;";
mysqli_query($connect, $query);

?>
<script>
    location.href = "myMemo.php";
</script>