<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자유게시판</title>
    <link rel="stylesheet" href="css/board.css">
    <link rel="stylesheet" href="css/top.css">

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

    <!-- 게시판 내용 -->
    <?php
    include "db.php";
    $idx = $_GET['idx'];
    $idx = mysqli_real_escape_string($connect, $idx);
    $query = "select*from boardFree where idx='$idx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

    $count = $data['count'] + 1;
    $countquery = "update boardFree set count='$count' where idx='$idx'";
    mysqli_query($connect, $countquery);
    ?>
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>자유게시판</strong></p>
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
                <a href="boardFree.php" class="on">목록</a>
                <a href="boardFreeWrite.php?idx=<?= $data['idx'] ?>">수정</a>
                <a href="boardFreeDeleteConfirm.php?idx=<?= $data['idx'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');" style="float: right;">삭제</a>
            </div>
        </div>
        <!-- 댓글 -->
        <div class="reply_view">
            <h2>댓글목록</h2>
            <?php
            $query = "select*from replyFree where con_num='$idx' order by idx desc";
            $result = mysqli_query($connect, $query);
            while ($reply = mysqli_fetch_array($result)) { ?>
                <div class="dap_lo">
                    <div id="name"><b><?php echo $reply['name'] ?></b></div>
                    <div class="dap_to comt_edit"><?php echo nl2br($reply['content']) ?></div>
                    <div class="rep_me dap_to"><?php echo $reply['created'] ?></div>
                    <form action="free_replyEdit.php?idx=<?= $reply['idx'] ?>" method="post">
                        <input type="hidden" name="ridx" value="<?= $reply['idx'] ?>">
                        <input type="hidden" name="cidx" value="<?= $idx ?>">
                        <input type="submit" value="수정">
                    </form>
                    <form action="free_replyDeleteConfirm.php?idx=<?php echo $reply['idx'] ?>">
                        <input type="hidden" name="ridx" value="<?= $reply['idx'] ?>">
                        <input type="submit" onclick="return confirm('정말 삭제하시겠습니까?');" value="삭제"></input>
                    </form>
                    <div class="line"></div>
                <?php } ?>
                </div>
                <?php
                $ridx = $_POST['ridx'];
                $cidx = $_POST['cidx'];
                $password = $_POST['password'];
                $ridx = mysqli_real_escape_string($connect, $ridx);
                $cidx = mysqli_real_escape_string($connect, $cidx);
                $password = mysqli_real_escape_string($connect, $password);

                $query = "select*from replyFree where idx='$ridx'";
                $result = mysqli_query($connect, $query);
                $rdata = mysqli_fetch_array($result);
                $hashWord = $rdata['password'];

                if (!empty($ridx)) { ?>
                    <!-- 댓글수정 -->
                    <?php if (!password_verify($password, $hashWord)) {
                        echo "<script>
                            alert('비밀번호가 일치하지 않습니다.');
                            history.go(-2);
                        </script>";
                    } else { ?>
                        <div class="dap_ins">
                            <form action="free_replySave.php?idx=<?php echo $idx; ?>" method="post">
                                <div style="margin-top: 10px;">
                                    <input type="hidden" name="edit_ridx" value="<?= $ridx ?>">
                                    <textarea name="edit_rcontent" class="reply_content" id="re_content"><?= $rdata['content'] ?></textarea>
                                    <button id="rep_bt" class="re_bt">수정</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <!-- 댓글입력 -->
                    <div class="dap_ins">
                        <form action="free_replySave.php?idx=<?php echo $idx; ?>" method="post">
                            <input type="text" name="name" id="dat_user" class="dat_user" size="15" placeholder="닉네임">
                            <input type="password" name="password" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
                            <div style="margin-top: 10px;">
                                <textarea name="content" class="reply_content" id="re_content"></textarea>
                                <button id="rep_bt" class="re_bt">등록</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
        </div>
    </div>
</body>

</html>