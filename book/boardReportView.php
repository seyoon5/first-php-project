<?php
include "db.php";
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
    <?php include "db.php";
    $idx = $_GET['idx'];
    $idx = mysqli_real_escape_string($connect, $idx);

    $query = "select*from boardReport where idx='$idx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

    $count = $data['count'] + 1;
    $countquery = "update boardReport set count='$count' where idx='$idx'";
    mysqli_query($connect, $countquery);
    ?>
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>독서게시판</strong></p>
        </div>
        <div class="board_view_wrap">
            <div class="board_view">
                <div class="title">
                    <?= $data['subject'] ?>
                </div>
                <div class="info">
                    <dl>
                        <dt>번호</dt>
                        <dd><?= $data['idx'] ?></dd>
                    </dl>
                    <dl>
                        <dt>작성자</dt>
                        <dd><?= $data['name'] ?></dd>
                    </dl>
                    <dl>
                        <dt>작성일</dt>
                        <dd><?= substr($data['created'], 0, 10) ?></dd>
                    </dl>
                    <dl>
                        <dt>조회수</dt>
                        <dd><?= $count ?></dd>
                    </dl>
                </div>
                <div class="cont">
                    <?php if ($data['img']) {
                        echo "<img src='img/$data[img]'></img>";
                        echo '<br>';
                    }
                    ?>
                    <?= nl2br($data['memo']) ?>
                </div>
            </div>
            <div class="bt_wrap">
                <a href="boardReport.php" class="on">목록</a>
                <?php if ($isName == $data['name']) { ?>
                    <a href="boardReportWrite.php?idx=<?= $idx ?>">수정</a>
                    <a href="process_boardReportDelete.php?idx=<?= $idx ?>" onclick="confirm('정말 삭제하시겠습니까?');" style="float: right;">삭제</a>
                <?php } ?>
            </div>
        </div>
        <!-- 댓글 -->
        <?php
        $ridx = $_POST['ridx'];
        $ridx = mysqli_real_escape_string($connect, $ridx);
        $query = "select*from replyReport where idx='$ridx'";
        $result = mysqli_query($connect, $query);
        $rdata = mysqli_fetch_array($result);

        ?>
        <div class="reply_view">
            <h2>댓글목록</h2>
            <?php
            $query = "select*from replyReport where con_num='$idx' order by idx desc";
            $result = mysqli_query($connect, $query);
            while ($reply = mysqli_fetch_array($result)) { ?>
                <div class="dap_lo">
                    <div><b><?php echo $reply['name'] ?></b></div>
                    <div class="dap_to comt_edit"><?php echo nl2br($reply['content']) ?></div>
                    <div class="rep_me dap_to"><?php echo $reply['created'] ?></div>
                    <?php if ($isName == $reply['name']) { ?>
                        <form action="boardReportView.php?idx=<?= $idx ?>" method="post">
                            <input type="hidden" name="ridx" value="<?= $reply['idx'] ?>">
                            <input type="submit" value="수정">
                        </form>
                        <form action="report_replyDelete.php?idx=<?= $reply['idx'] ?>" method="post">
                            <input type="hidden" name="idx" value="<?= $reply['idx'] ?>">
                            <input type="submit" onclick="return confirm('정말 삭제하시겠습니까?');" value="삭제"></input>
                        </form>
                    <?php } ?>
                </div>
            <?php } ?>
            <!-- 댓글입력 -->
            <div class="dap_ins">
                <form action="report_replySave.php?idx=<?php echo $idx; ?>" method="post">
                    <input type="hidden" name="idx" value="<?= $idx ?>">
                    <input type="hidden" name="ridx" value="<?= $ridx ?>">
                    <div style="margin-top: 10px;">
                        <textarea name="content" class="reply_content" id="re_content"><?php echo $rdata['content'] ?></textarea>
                        <button id="rep_bt" class="re_bt">등록</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>