<?php
$url = "http://www.kyobobook.co.kr/bestSellerNew/bestseller.laf?orderClick=d79";
include "simple_html_dom.php";

$data = file_get_html($url);

foreach ($data->find("div.title strong") as $a) {
    echo $a;
    echo "<br>";
}

?>
<!-- $imgs = $img->find("img", 0)->src; -->
<!-- $title = $ui->plaintext; -->