<?php
include "21Lib.php";

$a = $_GET['name'];
$b = $_GET['memo'];

$query = "insert into memo(name, memo, created) values('$a', '$b', NOW())";

mysqli_query($connect, $query);
?>
<script>
    location.href = '21memo.php';
</script>