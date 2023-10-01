<?php
    date_default_timezone_set("Etc/GMT-8");
    include "../lib/database.php";
    @$h = $_POST['heat'];
    echo @$h .'*C';
    $sql = new sql();
    $sql -> config("root","","mqtt","flame");
    $sql -> put_data(['','ON'@$h,date('Y-m-d-H-i-s')]);
    $sql -> add("(?,?,?,?,?)");
?>