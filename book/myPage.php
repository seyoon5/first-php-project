<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="kr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/myPage.css">
    <title>Welcome BookClub</title>
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

    <!-- 회원정보 수정 -->
    <div class="mainCon">
        <div class="updateTitle">회원정보</div>
        <form action="process_myPage.php" method="post">
            <input type="hidden" name="id" value="<?= $isId ?>">
            <table class="updateTable">
                <tr class="spaceUnder">
                    <td>아이디</td>
                    <td><?= $isId ?></td>
                </tr>
                <tr class="spaceUnder">
                    <td>현재 비밀번호</td>
                    <td><input type="password" name="pw"></td>
                </tr>
                <tr class="spaceUnder">
                    <td>비밀번호 변경</td>
                    <td><input type="password" name="npw"></td>
                </tr>
                <tr class="spaceUnder">
                    <td>비밀번호 변경 확인</td>
                    <td><input type="password" name="npwc"></td>
                </tr>
                <tr class="spaceUnder">
                    <td>닉네임</td>
                    <td><input type="text" name="nick" value=<?= $isName ?>></td>
                </tr>
            </table>
            <div class="updateBtn">
                <input type="submit" value="수정">
                <input type="button" value="취소" onclick="history.back()">
                <input id="memo" type="button" value="내가 남긴 글" onclick="location.href='myMemo.php';">
            </div>
        </form>
    </div>


</body>

</html>