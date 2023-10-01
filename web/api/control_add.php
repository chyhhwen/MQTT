<?php
date_default_timezone_set("Etc/GMT-8");
date_default_timezone_set('Asia/Taipei');
header('Content-type:application/json;charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once("../lib/database.php");
$sql = new sql();
if (
    empty($_POST['dht11']) ||
    empty($_POST['flame']) ||
    empty($_POST['led'])
) {
    $json = [
        'ok' => false,
        'message' => 'Please input all fields'
    ];
    $response = json_encode($json);
    echo $response;
    die();
}
else
{
    $sql -> config("root","","mqtt","control");
    $sql -> put_data(['',$_POST['dht11'],$_POST['flame'],$_POST['led'],date('Y-m-d-H-i-s')]);
    $sql -> add("(?,?,?,?,?)");
}
