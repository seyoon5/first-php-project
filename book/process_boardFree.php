<?php
include "db.php";

$subject = $_POST['subject'];
$name = $_POST['name'];
$password = $_POST['password'];
$memo = $_POST['memo'];
$idx = $_POST['idx'];

$subject = mysqli_real_escape_string($connect, $subject);
$name = mysqli_real_escape_string($connect, $name);
$password = mysqli_real_escape_string($connect, $password);
$memo = mysqli_real_escape_string($connect, $memo);
$idx = mysqli_real_escape_string($connect, $idx);

// 빈 항목 체크
if (empty($subject) || empty($name) || empty($password)) {
    echo "<script>
    alert('비어있는 항목이 있습니다.');
    history.back();
    </script>";
    exit;
} else if ($idx) { //수정
    $query = "select*from boardFree where idx='$idx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);
    $hash = $data['password'];
    if (!password_verify($password, $hash)) {
        echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        history.back();
        </script>";
    } else {
        $imageFullName = strtolower($_FILES['img']['name']);
        $imageNameSlice = explode(".", $imageFullName);
        $imageName = $imageNameSlice[0];
        $imageType = $imageNameSlice[1];
        $image_ext = array('jpg', 'jpeg', 'gif', 'png');
        if (array_search($imageType, $image_ext) === false) {
            error_log('jpg, jpeg, gif, png 확장자만 가능합니다.');
        }
        $dates = date("his", time());
        if ($imageType !== null) {
            $newImage = $dates . rand(1, 9) . "." . $imageType;
            $dir = "img/";
            move_uploaded_file($_FILES['img']['tmp_name'], $dir . $newImage);
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "update boardFree set subject='$subject', name='$name', memo='$memo', password='$password', img='$newImage' where idx='$idx' ";
        mysqli_query($connect, $query);

        // 재정렬
        $query = "SET @CNT=0;";
        mysqli_query($connect, $query);

        $query = "UPDATE boardFree SET boardFree.idx = @CNT:=@CNT+1;";
        mysqli_query($connect, $query);

        $query = "ALTER TABLE boardFree AUTO_INCREMENT=1;";
        mysqli_query($connect, $query);
        //댓글 재정렬
        $query = "SET @CNT=0;";
        mysqli_query($connect, $query);

        $query = "UPDATE replyFree SET replyFree.idx = @CNT:=@CNT+1;";
        mysqli_query($connect, $query);

        $query = "ALTER TABLE replyFree AUTO_INCREMENT=1;";
        mysqli_query($connect, $query);
    }
} else { // 글쓰기
    // 이미지
    $imageFullName = strtolower($_FILES['img']['name']);
    $imageNameSlice = explode(".", $imageFullName);
    $imageName = $imageNameSlice[0];
    $imageType = $imageNameSlice[1];
    $image_ext = array('jpg', 'jpeg', 'gif', 'png');
    if (array_search($imageType, $image_ext) === false) {
        error_log('jpg, jpeg, gif, png 확장자만 가능합니다.');
    }
    $dates = date("his", time());
    if ($imageType !== null) {
        $newImage = $dates . rand(1, 9) . "." . $imageType;
        $dir = "img/";
        move_uploaded_file($_FILES['img']['tmp_name'], $dir . $newImage);
    }
    // 저장
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "insert into member.boardFree(subject, name, memo, created, password, img) 
    values('$subject', '$name', '$memo', NOW(), '$password', '$newImage')";
    mysqli_query($connect, $query);
}
?>
<script>
    location.href = "boardFree.php";
</script>