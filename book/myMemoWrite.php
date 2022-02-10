<!DOCTYPE php>
<html lang="kr">
<?php include "db.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/board.css">

    <title>내가 남긴 글</title>

    <!-- 헤더부분 css -->
</head>

<body>
    <!-- 네이게이션바 시작 -->
    <div class="topnav">

        <!-- Centered link -->
        <div class="topnav-centered">
            <a href="bookmain.php" class="active">BookClub</a>
        </div>
mysql
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

    <!-- 독서게시판 게시판 시작 -->
    <?php
    $idx = $_GET['idx'];
    $query = "select*from boardReport where idx='$idx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);
    ?>
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>내가 남긴 글</strong></p>
        </div>
        <div class="board_write_wrap">
            <form action="process_myMemo.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idx" value="<?= $idx ?>">
                <div class="board_write">
                    <div class="title">
                        <dl>
                            <dt>제목</dt>
                            <dd>
                                <input type="text" name="subject" placeholder="제목 입력" value="<?= $data['subject'] ?>"> <input type="file" name="img">
                            </dd>
                        </dl>
                    </div>
                    <div class="info">
                        <dl>
                            <dt>작성자</dt>
                            <dd><?= $isName ?></dd>
                        </dl>
                    </div>
                    <div class="cont">
                        <textarea placeholder="내용 입력" name="memo"><?= $data['memo'] ?></textarea>
                    </div>
                </div>
                <div class="bt_wrap">
                    <input type="submit" value="등록">
                    <a href="myMemo.php">취소</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>