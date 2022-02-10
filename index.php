<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'dhtprnt', 'opentutorials');

$sql = "SELECT*FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while ($row = mysqli_fetch_array($result)) {
    //<li><a href=\"index.php?id=13\">MySQL</a></li>
    $list = $list . "<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
}



$article = array(
    'title' => 'Welcome',
    'description' => 'Hello, web'
);
$update_link  = '';
$delete_link  = '';
$author = '';
if (isset($_GET['id'])) {
    $sql = "SELECT*FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$_GET['id']}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = $row['title'];
    $article['description'] = $row['description'];
    $article['name'] = $row['name'];

    $update_link = '<a href="update.php?id=' . $_GET['id'] . '">update</a>';
    $delete_link = '
    <form action="process_delete.php" method="POST">
    <input type="hidden" name="id" value="' . $_GET['id'] . '">
    <input type="submit" value="delete">
    ';
    $author = "<p>by {$article['name']}</p>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>WEB</title>
</head>

<body>
    <h1><a href="index.php">WEB</a></h1>
    <a href="author.php">author</a>
    <ol>
        <?= $list ?>
    </ol>
    <a href="create.php">create</a>
    <?= $update_link ?>
    <?= $delete_link ?>
    <h2><?= $article['title'] ?></h2>
    <?= $article['description'] ?>
    <?= $author ?>
</body>

</html>