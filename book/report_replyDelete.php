<?php
include "db.php";

$idx = $_POST['idx'];
$idx = mysqli_real_escape_string($connect, $idx);

$query = "select*from replyReport where idx='$idx'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

$query = "delete from replyReport where idx='$idx'";
mysqli_query($connect, $query);
// 재정렬
$query = "SET @CNT=0;";
mysqli_query($connect, $query);

$query = "UPDATE replyReport SET replyReport.idx = @CNT:=@CNT+1;";
mysqli_query($connect, $query);

$query = "ALTER TABLE replyReport AUTO_INCREMENT=1;";
mysqli_query($connect, $query);

$idx = $data['con_num'];

?>
<script>
    location.href = 'boardReportView.php?idx=<?= $idx ?>';
</script>a