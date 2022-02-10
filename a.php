
<?php
include "simple_html_dom.php";
$data = file_get_html("https://daum.net");

$a = $data->find(".link_txt");

foreach ($a as $b) {
    echo $b->plaintext;
    echo "<br>";
}


?>