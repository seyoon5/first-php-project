<!doctype html>
<html>
<head>
    <meta charset="euc-kr">
    <title>얼빵이의 노트</title>
</head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
 
<?php
#쿠키에서 로그인정보 불러오기#
if (isset($_COOKIE['userId'])){
    $userId = $_COOKIE['userId'];
    $idSaveCheck = "checked";
}
?>
<div>
    <form name="LoginForm" method="post" action="">
        <input type="text" name="userId" placeholder="ID" value="<?=$userId?>">
        <input type="password" name="userPw" placeholder="Password">
        <div><input type="checkbox" name="idSaveCheck" <?=$idSaveCheck?>><font color="gray">ID 저장하기</font></div>
        <input type="button" value="로그인" onclick="LoginCheck();">
    </form>
</div>

<!--로그인 폼 유효성 체크 부분-->
<script>
    function LoginCheck(){
        var F = document.LoginForm;
        if (F.userId.value==""){
            alert("ID를 입력해주세요");
            F.userId.focus();
            return false;
        }
        if (F.userPw.value==""){
            alert("PassWord를 입력해주세요");
            F.userPw.focus();
            return false;
        }
        F.action="LoginCheck.php";
        F.submit();
    }
</script>
</body>
</html>