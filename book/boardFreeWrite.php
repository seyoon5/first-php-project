<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="ko">

<!-- 수정할 index의 저장값 불러오기 -->
<?php include "db.php";
$idx = $_GET['idx'];
$idx = mysqli_real_escape_string($connect, $idx);

$query = "select*from boardFree where idx='$idx'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);
?>

<!-- 수정 전 저장된 값을 아래 작성목록 중 value(body안에 게시판)에 넣어주기 -->

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
    <!-- 네이게이션바 끝 -->

    <!-- 게시글 작성 -->
    <form action="process_boardFree.php" method="post" enctype="multipart/form-data">
        <!-- 수정후 저장할 index 전송 -->
        <input type="hidden" name="idx" value="<?= $idx ?>">
        <div class="board_wrap">
            <div class="board_title">
                <p><strong>자유게시판</strong></p>
            </div>
            <div class="board_write_wrap">
                <div class="board_write">
                    <div class="title">
                        <dl>
                            <dt>제목</dt>
                            <dd>
                                <input type="text" name="subject" placeholder="제목 입력" value="<?= $data['subject'] ?>">
                                <input type="file" name="img" id="upload_file">
                                <div class="imgFile"><img src="" onerror="this.src='img/white.jpg'" id="img_section" style="width: 50px; height: 50px;"></div>
                            </dd>
                        </dl>
                    </div>
                    <div class="info">
                        <dl>
                            <dt>작성자</dt>
                            <dd><input type="text" name="name" placeholder="작성자 입력" value="<?= $data['name'] ?>"></dd>
                        </dl>
                        <dl>
                            <dt>비밀번호</dt>
                            <dd><input type="password" name="password" placeholder="비밀번호 입력"></dd>
                        </dl>
                    </div>
                    <div class="cont">
                        <textarea placeholder="내용 입력" name="memo"><?= $data['memo'] ?></textarea>
                    </div>
                </div>
                <div class="bt_wrap">
                    <input type="submit" value="등록">
                    <a href="boardFree.php">취소</a>
                </div>
            </div>
        </div>
    </form>
</body>
<script>
    const reader = new FileReader();

    reader.onload = (readerEvent) => {
        document.querySelector("#img_section").setAttribute("src", readerEvent.target.result);
    };
    document.querySelector("#upload_file").addEventListener("change", (changeEvent) => {
        const imgFile = changeEvent.target.files[0];
        reader.readAsDataURL(imgFile);
    })
</script>

</html>