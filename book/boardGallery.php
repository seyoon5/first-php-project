<?php
include "db.php";
?>
<!DOCTYPE php>
<html lang="kr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/gallery.css">

    <title>베스트 셀러</title>

    <!-- 헤더부분 css -->
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
    <!-- 크롤링 부분 -->
    <h1>월간 베스트 셀러</h1>
    <?php
    include "simple_html_dom.php";
    $html = file_get_html("http://www.kyobobook.co.kr/bestSellerNew/bestseller.laf?range=1&kind=2&orderClick=DAB&mallGb=KOR&linkClass=A");

    foreach ($html->find('div .cover') as $element) {
        $imgs[] = $element->find('img', 0)->src;
    }

    foreach ($html->find('div .detail') as $title) {
        $titles[] = $title->find('a', 0);
    }
    ?>
    <div class="wrap">
        <?php
        $rank = 1;
        foreach ($titles as $key => $boardTitle) {
        ?>
            <div class="gallery">
                <img src="<?= $imgs[$key + 1]  ?>" alt="사진없음">
                <div class="desc"><?= $rank ?>위 <?= $boardTitle ?></div>
            </div>
        <?php $rank++;
        }
        ?>
    </div>
</body>

</html>