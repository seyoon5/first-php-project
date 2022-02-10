<?php
include "db.php";

if ($_FILES['img']['name']) {
    $imageFullName = strtolower($_FILES['img']['name']);
    $imageNameSlice = explode(".", $imageFullName);
    $imageName = $imageNameSlice[0];
    $imageType = $imageNameSlice[1];
    $image_ext = array('jpg', 'jpeg', 'gif', 'png');
    if (array_search($imageType, $image_ext) === false) {
        error_log('jpg, jpeg, gif, png 확장자만 가능합니다.');
    }
    $dates = date("his", time());
    $newImage = $dates . rand(1, 9) . "." . $imageType;
    $dir = "img/";
    move_uploaded_file($_FILES['img']['tmp_name'], $dir . $newImage);
    $query = "insert into member.img(img) values('$newImage')";
    mysqli_query($connect, $query);
}
?>
<script>
    location.href = "boardGallery.php";
</script>