
<?php
include "db.php";
//login 절차
$idSaveCheck = $_POST['idSaveCheck'];

if (isset($_POST['id']) && isset($_POST['pw'])) {

    //보안
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $pw = mysqli_real_escape_string($connect, $_POST['pw']);

    $sql = "select*from member.user where id = '$id'";
    $result = mysqli_query($connect, $sql);

    // 패스워드&ID 확인
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['password'];

        if (password_verify($pw, $hash)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nick'] = $row['nick'];
            $_SESSION['idx'] = $row['idx'];

            if ($idSaveCheck == 'on') {
                setcookie('id', $id, time() + (86400 * 30), '/');
            } else {
                setcookie('id', $id, time() - (86400 * 30), '/');
                unset($_COOKIE['id']);
            }

            echo "<script>alert('{$_SESSION['id']}님 환영합니다.');
            location.replace('bookmain.php');
            </script>";
        } else {
            echo "<script>alert('잘못된 정보입니다.');
            location.replace('login.php');
            </script>";
        }
    } else {
        echo "<script>alert('존재하지 않는 ID입니다.');
        location.replace('login.php');
        </script>";
    }
} else {
    echo "<script>alert('알 수 없는 오류가 발생했습니다.');
    location.replace('login.php');
    </script>";
}
?>