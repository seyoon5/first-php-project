<?php
$url = "https://news.daum.net/";
include "simple_html_dom.php";

$data = file_get_html($url);
?>

<table border=1>

    <?php

    foreach ($data->find(".l_issue") as $ui) {
        $title = $ui->plaintext;
        $imgs = $ui->find("img", 0)->src;
    ?>
        <tr>
            <td><? echo $title ?>
            <td><img src="<? $imgs ?>">
            <?php }

            ?>
</table>