<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/delete.css">
    <link rel="stylesheet" href="css/top.css">


    <title>수정</title>
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
                <a href="myPage.php"><?= $_SESSION['nick'] ?></a>
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

    <?php
    include "db.php";

    $ridx = $_POST['ridx'];
    $cidx = $_POST['cidx'];
    $ridx = mysqli_real_escape_string($connect, $ridx);
    $cidx = mysqli_real_escape_string($connect, $cidx);

    $query = "select*from replyFree where idx='$ridx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);
    ?>

    <form action="boardFreeView.php?idx=<?php echo $cidx; ?>" method="POST">
        <div class="wrap">
            <input type="hidden" name="ridx" value="<?= $ridx ?>">
            <input type="hidden" name="cidx" value="<?= $cidx ?>">
            <h1>수정</h1>
            <div class="pwd"><input type="password" name="password" placeholder="비밀번호를 입력하세요."></div>
            <div class="chk"><input type="submit" value="확인"></input></div>
        </div>
    </form>

</body>

</html>