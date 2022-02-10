<!DOCTYPE php>
<html lang="kr">
<?php include "db.php"; ?>

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
    <?php
    $idx = $_GET['idx'];
    $query = "select*from boardReport where idx='$idx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);
    ?>
    <div class="board_wrap">
        <div class="board_title">
            <p><strong>독서게시판</strong></p>
        </div>
        <div class="board_write_wrap">
            <form action="process_boardReport.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idx" value="<?= $idx ?>">
                <div class="board_write">
                    <div class="title">
                        <dl>
                            <dt>제목</dt>
                            <dd>
                                <input type="text" name="subject" placeholder="제목 입력" value="<?= $data['subject'] ?>">
                                <input type="file" name="img" id="upload_file">
                                <div class="imgFile"><img src="img/white.jpg" id="img_section" style="width: 50px; height: 50px;"></div>
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
                    <a href="boardReport.php">취소</a>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    const reader = new FileReader();

    document.querySelector("#upload_file").addEventListener("change", (changeEvent) => {
        //upload_file 에 이벤트리스너인 changeEvent 를 장착

        const imgFile = changeEvent.target.files[0];
        reader.readAsDataURL(imgFile);
        //업로드한 이미지의 URL을 reader에 등록
    })

    reader.onload = (readerEvent) => {
        document.querySelector("#img_section").setAttribute("src", readerEvent.target.result);
        //파일을 읽는 이벤트가 발생하면 img_section의 src 속성을 readerEvent의 결과물로 대체함
    };
</script>

</html>