
<?php
include "db.php";
//회원가입 절차
if (isset($_POST['id']) && isset($_POST['pw']) && isset($_POST['pwc']) && isset($_POST['nick'])) {

    //보안
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $pw = mysqli_real_escape_string($connect, $_POST['pw']);
    $pwc = mysqli_real_escape_string($connect, $_POST['pwc']);
    $nick = mysqli_real_escape_string($connect, $_POST['nick']);

    //비밀번호 일치여부 확인
    if ($pw != $pwc) {
        echo
        "<script>alert('비밀번호가 일치하지 않습니다.');
        location.replace('register.php');
        </script>";
    }
    //비밀번호 암호화
    else {
        $pw = password_hash($pw, PASSWORD_DEFAULT);
        $sql_same = "SELECT*FROM member.user where id = '$id'";
        $order = mysqli_query($connect, $sql_same);
        //아이디 중복검사
        if (mysqli_num_rows($order) > 0) {
            echo
            "<script>alert('동일한 아이디가 존재합니다.');
            location.replace('register.php');
            </script>";
        }
        //서버에 저장
        else {
            $sql_save = "insert into member.user(id, password, created, nick) values('$id', '$pw', NOW(), '$nick')";
            $result = mysqli_query($connect, $sql_save);
            if ($result) {
                echo
                "<script>alert('가입을 축하합니다.');
                location.replace('login.php');
                </script>";
            } else {
                echo
                "<script>alert('가입에 실패했습니다.');
            location.replace('register.php');
            </script>";
            }
        }
    }
} else {
    echo
    "<script>alert('가입에 실패했습니다(error).');
location.replace('register.php');
</script>";
}
?>