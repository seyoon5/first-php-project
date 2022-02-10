<?php
include "db.php";
?>
<!DOCTYPE php>
<html lang="ko">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/register.css">
    <title>회원가입</title>
</head>

<body>
    <!-- 네이게이션바 시작 -->
    <div class="topnav">

        <!-- Centered link -->
        <div class="topnav-centered">
            <a href="bookmain.php" class="active">BookClub</a>
        </div>

        <!-- Left-aligned links (default) -->
        <a href="boardFree.php">자유게시판</a>
        <a href="boardReport.php">독서게시판</a>
        <a href="boardGallery.php">베스트 셀러</a>

        <!-- Right-aligned links -->
        <?php if ($isLogin) { ?>
            <div class="topnav-right">
                <a href="#"><?= $_SESSION['nick'] ?></a>
                <a href="process_logOut.php">로그아웃</a>
            </div>
        <?php
        } else { ?>
            <div class="topnav-right">
                <a href="login.php">로그인</a>
                <a href="register.php">회원가입</a>
            </div>
        <?php } ?>

    </div>
    <!-- 네이게이션바 끝 -->

    <!-- 회원가입 시작 -->
    <div class="container">
        <form action="process_register.php" method="post">
            <h1 style="text-align:center">회원가입</h1>
            <p><input type="text" name="id" placeholder="아이디 입력" required></p>
            <p><input type="text" name="nick" placeholder="닉네임 입력" required></p>
            <p><input type="password" name="pw" placeholder="비밀번호 입력" required></p>
            <p><input type="password" name="pwc" placeholder="비밀번호 확인" required></p>
            <p><input type="submit" value="가입하기"></p>
        </form>
    </div>
</body>

</html>