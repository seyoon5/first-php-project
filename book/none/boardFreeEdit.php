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
        <a href="boardReport.php">감상/토론</a>
        <a href="boardGallery.php">추천도서</a>

        <!-- Right-aligned links -->
        <div class="topnav-right">
            <a href="login.php">로그인</a>
            <a href="register.php">회원가입</a>
        </div>

    </div>

    <!-- 자유게시판 -->
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>자유게시판</strong></p>
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
                <a href="boardFreeView.php" class="on">등록</a>
                <a href="boardFree.php">취소</a>
            </div>
        </div>
    </div>
</body>

</html>