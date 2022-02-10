<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="kr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/read.css">
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

    <!-- 메인페이지 소개글 시작 -->
    <div class="container">
        <img src="img/readImg.jpg" alt="" style="width:100%;">
        <div class="content">
            <h1>독서</h1>
            <p>독서는 사회적 소통 행위와 지식 창출 행위, 이 두 가지 양상으로 나누어진다.
                사회적 소통 행위로서의 독서는 독자가 글쓴이와 대화를 하는 것인 반면, 지식 창출 행위로서의 독서는 지식을 얻고, 이를 바탕으로 새로운 지식을 만드는 것이다.
                이만수(2001)는 비슷하게 독자의 내면세계에 변화를 가져와야만 바람직한 독서라고 주장했다.
                영상 매체가 존재하지 않았던 과거에는 문자와 필기구 등을 이용하여 책 형태로 기록을 남기는 것에 의존할 수밖에 없었으며,
                자연스럽게 지식을 얻기 위해 강조되었다. 때문에 과거 문인들에게는 필수적인 행위였다.</p>
            <p>현대에 이르러서는 텔레비전이나 컴퓨터 등의 각종 영상 매체의 보급으로 인해 독서 이외에 지식을 얻을 수 있는 수단이 늘어나면서 아이들이 점점 책과 멀리 떨어져 지낸다는 우려가 적지 않다.
                이에 대한 대비책으로 학교에서 정기적으로 책을 읽은 뒤 독서감상문을 쓰게 하도록 하거나, 책을 쉽게 접할 수 있는 환경을 조성하고자 각종 서적을 전자 데이터화한 '전자 서적'이 널리 보급되고 있다.</p>
            <p>최근에는 독서를 교육이나 치료에 이용하는 경향이 늘고 있다. 이 중 독서 교육은 독서를 통해 필요한 지식이나 능력,태도를 익히는 것으로 독서를 통한 생활지도와 같으며,
                독서지도는 독서 태도,기술,능력 등 독서하는 것 자체에 대해 익히는 것이다. 그러나 국내에서는 이 둘을 흔히 혼용하여 쓴다. 그리고 독서상담이란 것도 있는데,
                독서상담은 단순히 독서에 필요한 정보제공에서부터 독서를 통한 심리치유까지 포함한다.</p>
            <p>유달리 독서하는데 문제가 있는 사람을 독서문제독자라 하는데 황백현은 독서문제독자를 문자 자체를 잘 읽지 못하는 읽기곤란독자와 독해는 가능하나 독서 활동에 문제가 있는 독서이상독자로 나누었다.
                이를 다시 분류하면 읽기곤란독자는 전체적인 지능저하로 인한 읽기지진독자와 지능은 문제없는데 독해력만 떨어지는 읽기부진독자로 나뉘고,
                독서이상독자는 독서에 흥미와 관심이 유달리 없으면 독서무관심독자로, 흥미와 관심은 정상이나 방법과 태도에 문제가 있으면 독서태도이상독자로 나뉜다.</p>
        </div>
    </div>
</body>

</html>