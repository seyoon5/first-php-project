<?php include "db.php";
if (!$isLogin) {
    echo "<script>alert('로그인 후 이용해 주세요.');
    history.back();
    </script>";
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
?>
<!DOCTYPE php>
<html lang="kr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/board.css">

    <title>독서게시판</title>

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

    <!-- 독서게시판 게시판 시작 -->
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>독서게시판</strong></p>
        </div>
        <div class="board_list_wrap">
            <div class="board_list">
                <div class="top">
                    <div class="num">번호</div>
                    <div class="title">제목</div>
                    <div class="writer">작성자</div>
                    <div class="date">작성일</div>
                    <div class="count">조회수</div>
                </div>
                <!-- 페이징 처리 -->
                <?php
                $query = "select*from boardReport";
                $result = mysqli_query($connect, $query);

                $total_record = mysqli_num_rows($result);

                $list = 5;
                $block_cnt = 5;
                $block_num = ceil($page / $block_cnt);
                $block_start = (($block_num - 1) * $block_cnt) + 1;
                $block_end = $block_start + $block_cnt - 1;

                $total_page = ceil($total_record / $list);
                if ($block_end > $total_page) {
                    $block_end = $total_page;
                }
                $total_block = ceil($total_page / $block_cnt);
                $page_start = ($page - 1) * $list;

                //게시물 소환
                $query = "select*from boardReport order by idx desc limit $page_start, $list";
                $result = mysqli_query($connect, $query);
                while ($data = mysqli_fetch_array($result)) { ?>
                    <div>
                        <div class="num"><?= $data['idx'] ?></div>
                        <div class="title"><a href="boardReportView.php?idx=<?= $data['idx'] ?>"><?= $data['subject'] ?></a></div>
                        <?php if ($isId == $data['id']) {
                        ?>
                            <div class="writer"><?= $isName ?></div>
                        <?php
                        } else { ?>
                            <div class="writer"><?= $data['name'] ?></div>
                        <?php } ?>
                        <div class="date"><?= substr($data['created'], 0, 10) ?></div>
                        <div class="count"><?= $data['count'] ?></div>
                    </div>
                <?php } ?>
            </div>
            <div class="search">
                <form action="search_resultReport.php" method="get">
                    <select name="catgo" class="select">
                        <option value="subject">제목</option>
                        <option value="name">작성자</option>
                        <option value="memo">내용</option>
                    </select>
                    <input type="text" name="search" size="40" required="required" /> <button>검색</button>
                    <div class="bt_wrap">
                        <a href="boardReportWrite.php" class="on">글쓰기</a>
                    </div>
                </form>
            </div>
            <div class="board_page">
                <?php
                echo "<a href='boardReport.php?page=1' class='bt frist'>◁◁</a>";
                if ($page <= 1) {
                    echo "<a href='boardReport.php?page=1' class='bt prev'>◁</a>";
                } else {
                    $pre = $page - 1;
                    echo "<a href='boardReport.php?page=$pre' class='bt prev'>◁</a>";
                }
                for ($i = $block_start; $i <= $block_end; $i++) {
                    if ($page == $i) {
                        echo "<a href='boardReport.php?page=$i' style='background-color:black; color:white;' class='num'>$i</a>";
                    } else {
                        echo "<a href='boardReport.php?page=$i' class='num'>$i</a>";
                    }
                }
                if ($page >= $total_page) {
                    echo "<a href='boardReport.php?page=$total_page' class='bt next'>▷</a>";
                } else {
                    $next = $page + 1;
                    echo "<a href='boardReport.php?page=$next' class='bt next'>▷</a>";
                }
                echo "<a href='boardReport.php?page=$total_page' class='bt last'>▷▷</a>";

                ?>
            </div>
        </div>
    </div>
</body>

</html>