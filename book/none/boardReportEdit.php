<!DOCTYPE php>
<html lang="kr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/board.css">

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
        <a href="boardReport.php">감상/토론</a>
        <a href="boardGallery.php">추천도서</a>

        <!-- Right-aligned links -->
        <div class="topnav-right">
            <a href="login.php">로그인</a>
            <a href="register.php">회원가입</a>
        </div>

    </div>
    <!-- 네이게이션바 끝 -->

    <!-- 감상/토론 게시판 -->
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>감상 / 토론</strong></p>
        </div>
        <div class="board_write_wrap">
            <div class="board_write">
                <div class="title">
                    <dl>
                        <dt>제목</dt>
                        <dd><input type="text" placeholder="제목 입력" value="작성한 글 제목입니다."></dd>
                    </dl>
                </div>
                <div class="info">
                    <dl>
                        <dt>작성자</dt>
                        <dd><input type="text" placeholder="작성자 입력" value="김이름"></dd>
                    </dl>
                    <dl>
                        <dt>비밀번호</dt>
                        <dd><input type="password" placeholder="비밀번호 입력" value="1234"></dd>
                    </dl>
                </div>
                <div class="cont">
                    <textarea placeholder="내용 입력">
작성한 게시글 내용입니다.
작성한 게시글 내용입니다.
작성한 게시글 내용입니다.
                    </textarea>
                </div>
            </div>
            <div class="bt_wrap">
                <a href="boardReportView.php" class="on">등록</a>
                <a href="boardReport.php">취소</a>
            </div>
        </div>
    </div>
    <!-- 댓글 -->
    <div class="reply_view">
        <h3>댓글목록</h3>
        <?php
        $query = "select*from replyFree where con_num='$idx' order by idx desc";
        $result = mysqli_query($connect, $query);

        while ($reply = mysqli_fetch_array($result)) { ?>
            <div class="dap_lo">
                <div><b><?php echo $reply['name'] ?></b></div>
                <div class="dap_to comt_edit"><?php echo nl2br($reply['content']) ?></div>
                <div class="rep_me dap_to"><?php echo $reply['created'] ?></div>
                <div class="dat_edit_bt" href="#">수정</div>
                <div class="dat_delete_bt" href="#">삭제</div>
            </div>
        <?php } ?>

        <!-- 댓글수정 -->
        <div class="dat_edit">
            <form action="rep_modify_ok.php" method="POST">
                <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"><input type="hidden" name=idx value="<?php $idx ?>">
                <p>비밀번호<input type="password" name="pw"><input type="submit" value="확인"></p>
            </form>
        </div>

        <!-- 댓글입력 -->
        <div class="dap_ins">
            <form action="reply_ok.php?idx=<?php echo $idx; ?>" method="post">
                <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
                <input type="password" name="dat_pw" id="dat_pw" class="dat_udat_pwser" size="15" placeholder="비밀번호">
                <div style="margin-top: 10px;">
                    <textarea name="content" class="reply_content" id="re_content"></textarea>
                    <button id="rep_bt" class="re_bt">댓글</button>
                </div>
            </form>
        </div>
    </div>

    </div>
</body>

</html>
</body>

</html>