<?php
    date_default_timezone_set("Etc/GMT-8");
    include "../lib/database.php";
    @$t = $_POST['temp'];
    @$h = $_POST['humi'];
    echo @$t .'*C ' . @$h . 'H';
    $sql = new sql();
    $sql -> config("root","","mqtt","dht11");
    $sql -> put_data(['','ON',@$t,@$h,date('Y-m-d-H-i-s')]);
    $sql -> add("(?,?,?,?,?)");
?>