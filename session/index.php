<?php
include "lib.php";

$isLogin = $_SESSION['isLogin'];
if (!$isLogin) { ?>
    로그인 후 이용해주세요. <br>
    <a href="login.php">로그인</a>
<?php
}
?>