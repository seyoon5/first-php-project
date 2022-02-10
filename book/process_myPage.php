
<?php
include "db.php";

$id = mysqli_real_escape_string($connect, $_POST['id']);
$npw = mysqli_real_escape_string($connect, $_POST['npw']);
$npwc = mysqli_real_escape_string($connect, $_POST['npwc']);
$nick = mysqli_real_escape_string($connect, $_POST['nick']);

$pw = mysqli_real_escape_string($connect, $_POST['pw']);

$query = "select * from user where id='$id'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);
$hash = $data['password'];

if (!password_verify($pw, $hash)) {
    echo "<script>
    alert('현재 비밀번호를 확인해주세요.');
    history.back();
    </script>";
    return;
} else if ($npw !== $npwc) {
    echo "<script>
    alert('변경할 비밀번호가 일치하지 않습니다.');
    history.back();
    </script>";
    return;
}

$query = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

if (!empty($npw)) {
    $npw = password_hash($npw, PASSWORD_DEFAULT);
    $query = "UPDATE user set password='$npw', nick='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);
    $query = "UPDATE boardFree set name='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);
    $query = "UPDATE boardReport set name='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);
    $query = "UPDATE replyReport set name='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);

    $query = "select*from user where nick='$nick'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 1) {
        echo "<script>
    alert('동일한 닉네임이 존재합니다.');
    history.back();
    </script>";
        return;
    }

    session_start();
    session_unset();
    session_destroy();

    echo "<script>
    alert('회원정보가 변경되었습니다. 다시 로그인 해주세요.');
    location.href='login.php';
    </script>";
    return;
} else {
    $query = "UPDATE user set nick='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);
    $query = "UPDATE boardFree set name='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);
    $query = "UPDATE boardReport set name='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);
    $query = "UPDATE replyReport set name='$nick' WHERE id='$id'";
    mysqli_query($connect, $query);

    $query = "select*from user where nick='$nick'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 1) {
        echo "<script>
    alert('동일한 닉네임이 존재합니다.');
    history.back();
    </script>";
        return;
    }

    session_start();
    session_unset();
    session_destroy();

    echo "<script>
    alert('회원정보가 변경되었습니다. 다시 로그인 해주세요.');
    location.href='login.php';
    </script>";
    return;
}

?>
