<?php
include "db.php";

//보안작업
$subject = $_POST['subject'];
$memo = $_POST['memo'];
$idx = $_POST['idx'];

$subject = mysqli_real_escape_string($connect, $subject);
$memo = mysqli_real_escape_string($connect, $memo);
$idx = mysqli_real_escape_string($connect, $idx);

// 빈칸검사
if (empty($subject) || empty($memo)) {
    echo "<script>
alert('비어있는 항목이 존재합니다.');
history.back();
    </script>";
}
//수정 등록
else if ($idx) {
    $query = "select*from boardReport where idx='$idx'";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

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

    $query = "update boardReport set subject='$subject', name='$isName', memo='$memo', img='$newImage' where idx='$idx'";
    mysqli_query($connect, $query);

    // 재정렬
    $query = "SET @CNT=0;";
    mysqli_query($connect, $query);

    $query = "UPDATE boardReport SET boardReport.idx = @CNT:=@CNT+1;";
    mysqli_query($connect, $query);

    $query = "ALTER TABLE boardReport AUTO_INCREMENT=1;";
    mysqli_query($connect, $query);
}
// 글쓰기 등록
else {
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
    $query = "insert into member.boardReport(subject, name, memo, created, img, id) 
    values('$subject', '$isName', '$memo', NOW(), '$newImage', '$isId')";
    mysqli_query($connect, $query);
    print_r($isName);
    print_r($memo);
    print_r($newImage);
    print_r($isId);
    print_r($query);
}
?>
<script>
    location.href = "myMemo.php";
</script>