<!DOCTYPE php>
<html lang="ko">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/login.css">
    <title>로그인</title>
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
        <div class="topnav-right">
            <a href="login.php">로그인</a>
            <a href="register.php">회원가입</a>
        </div>

    </div>
    <!-- 네이게이션바 끝 -->
    <?php
    if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
        $idSaveCheck = 'checked';
    }
    ?>
    <!-- 로그인 시작 -->
    <div class="container">
        <form action="process_login.php" method="post">
            <h1 style="text-align:center">Login</h1>
            <?php if (isset($id)) { ?>
                <p><input type="text" name="id" placeholder="아이디" value="<?= $id ?>" required></p>
            <?php } else { ?>
                <p><input type="text" name="id" placeholder="아이디" required></p>
            <?php } ?>
            <p><input type="password" name="pw" placeholder="비밀번호" required></p>
            <?php if (!empty($idSaveCheck)) { ?>
                <div class="checkbox"><input type="checkbox" name="idSaveCheck" <?= $idSaveCheck ?>>아이디 저장</div>
            <?php } else { ?>
                
                <div class="checkbox"><input type="checkbox" name="idSaveCheck">아이디 저장</div>
            <?php } ?>

            <input type="submit" value="Login">
        </form>
    </div>
    <!-- 로그인 끝 -->
</body>

</html>