<?php
include "db.php";
?>
<!DOCTYPE php>
<html lang="kr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/board.css">
    <link rel="stylesheet" href="css/top.css">
    <title>자유게시판</title>

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
    </div>
    <!-- 네이게이션바 끝 -->

    <!-- 게시판 시작 -->
    <?php include "db.php"; ?>
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>자유게시판</strong></p>
        </div>
        <div class="board_list_wrap">
            <div class="board_list">
                <div class="top">
                    <div class="num">번호</div>
                    <div class="title">제목</div>
                    <div class="writer">작성자</div>
                    <div class="date">작성일</div>
                </div>
                <?php
                $catagory = $_GET['catgo'];
                $search_con = $_GET['search'];

                $query = "select * from boardFree where $catagory like '%$search_con%' order by idx desc";
                $result = mysqli_query($connect, $query);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div>
                        <div class="num"><?= $data['idx'] ?></div>
                        <div class="title"><a href="boardFreeView.php?idx=<?= $data['idx'] ?>"><?= $data['subject'] ?></a></div>
                        <div class="writer"><?= $data['name'] ?></div>
                        <div class="date"><?= substr($data['created'], 0, 10) ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="search">
            <form action="search_resultFree.php" method="get">
                <select name="catgo" class="select">
                    <option value="subject">제목</option>
                    <option value="name">작성자</option>
                    <option value="memo">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /> <button>검색</button>
                <div class="bt_wrap">
                    <a href="boardFreeWrite.php" class="on">글쓰기</a>
                </div>
            </form>
        </div>
        <div class="board_page">
            <a href="#" class="bt frist">◁◁</a>
            <a href="#" class="bt prev">◁</a>
            <a href="#" class="num on">1</a>
            <a href="#" class="num">2</a>
            <a href="#" class="num">3</a>
            <a href="#" class="num">4</a>
            <a href="#" class="num">5</a>
            <a href="#" class="bt next">▷</a>
            <a href="#" class="bt last">▷▷</a>
        </div>

    </div>
    </div>
</body>

</html>