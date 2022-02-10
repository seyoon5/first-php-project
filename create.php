<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'dhtprnt', 'opentutorials');

$sql = "SELECT*FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while ($row = mysqli_fetch_array($result)) {
    //<li><a href=\"index.php?id=13\">MySQL</a></li>
    $list = $list . "<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
}

$sql = "SELECT*FROM author";
$result = mysqli_query($conn, $sql);
$select_form = '<select name="author_id">';
while ($row = mysqli_fetch_array($result)) {
    $select_form .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}
$select_form .= '</select>';

if (isset($_GET['id'])) {
    $sql = "SELECT*FROM topic WHERE id={$_GET['id']}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = $row['title'];
    $article['description'] = $row['description'];
}

print_r($article);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>WEB</title>
</head>

<body>
    <h1><a href="index.php">WEB</a></h1>
    <ol>
        <?= $list ?>
    </ol>
    <form action="process_create.php" method="POST">
        <p><input type="text" name="title" placeholder="title"></p>
        <p><textarea name="description" placeholder="description"></textarea></p>
        <?= $select_form ?>
        <p><input type="submit"></p>
    </form>
</body>

</html>