<!-- Array
(
    [name] => ccccc.PNG
    [type] => image/png
    [tmp_name] => /tmp/phpHQtxHg
    [error] => 0
    [size] => 334694
) -->
<?php
move_uploaded_file($_FILES['test']['tmp_name'], "./data/a.exe");
?>