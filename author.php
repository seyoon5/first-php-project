<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'dhtprnt', 'opentutorials');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>WEB</title>
</head>

<body>
    <h1><a href="index.php">WEB</a></h1>
    <a href="index.php">topic</a>
    <table border="1">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>profile</td>
            <td></td>
            <?php
            $sql = "SELECT*FROM author";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {

            ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['profile'] ?></td>
            <td><a href="author.php?id=<?= $row['id'] ?>">update</a></td>
        </tr>
    <?php
            }
    ?>
    </tr>
    </table>
    <?php
    $label_submit = 'Create author';
    $form_action = 'process_create_author.php';
    $form_id = '';
    $info = array(
        'name' => '',
        'profile' => ''
    );

    if (isset($_GET['id'])) {
        $sql = "SELECT*FROM author WHERE id = {$_GET['id']}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $label_submit = 'Update author';
        $form_action = 'process_update_author.php';
        $form_id = '<input type="hidden" name="id" value="' . $_GET['id'] . '">';
        $info['name'] = $row['name'];
        $info['profile'] = $row['profile'];
    }
    ?>
    <form action="<?= $form_action ?>" method="post">
        <? $form_id ?>
        <p><input type="text" name="name" placeholder="name" value="<?= $info['name'] ?>"></p>
        <p><textarea name="profile" placeholder="profile"><?= $info['profile'] ?></textarea></p>
        <p><input type="submit" value="<?= $label_submit ?>"></p>
    </form>
</body>

</html>