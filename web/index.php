<?php
    date_default_timezone_set("Etc/GMT-8");
    require_once("./lib/database.php");
    $sql = new sql();
    $sql -> config("root","","mqtt","control");
    $sql -> put_data(['id','dht11','flame','led','time']);
    $data = $sql -> control_sel();
    $dht = "";
    $flame = "";
    $led = "";
    foreach($data as $key => $val)
    {
        $dht = $data[$key]['dht11'];
        $flame = $data[$key]['flame'];
        $led = $data[$key]['led'];
    }
    if($dht == "true")
    {
        $dht = "ON";
    }
    else
    {
        $dht = "OFF";
    }
    if($flame == "true")
    {
        $flame = "ON";
    }
    else
    {
        $flame = "OFF";
    }
    if($led == "true")
    {
        $led = "ON";
    }
    else
    {
        $led = "OFF";
    }
    echo ' <html>
    <head>
        <link rel="stylesheet" href="./public/index.css">
        <meta charset="UTF-8">
        <title>物聯網測試</title>
    </head>
    <body>
    <nav>
        <span style="padding-left:40vw;">物聯網測試</span>
    </nav>
    <div class="state">
        <table>
        <tr>
            <td>LED</td>
        </tr>
        <tr>
        <td>狀態</td>
        <td>'. $led .'</td>
    </tr>
    </table>
    <table>
    <tr>
        <td>DHT11</td>
    </tr>
    <tr>';
    $sql -> config("root","","mqtt","dht11");
    $sql -> put_data(['id','state','temperature','humidity','time']);
    $data = $sql -> dht_sel();
    foreach($data as $key => $val)
    {
        echo'
        <td>狀態</td>
        <td>'. $dht .'</td>
        </tr>
        <tr>
        <td>溫度</td>
        <td>'. $data[$key]['temperature'] .'</td>
        </tr>
        <tr>
        <td>濕度</td>
        <td>'. $data[$key]['humidity'] .'</td>
        </tr>';
    }
    $sql -> config("root","","mqtt","flame");
    $sql -> put_data(['id','state','heat','time']);
    $data = $sql -> flame_sel();
    foreach($data as $key => $val)
    {
        echo'
        </table>
        <table>
            <tr>
                <td>火焰</td>
            </tr>
            <tr>
                <td>狀態</td>
                <td>'. $flame .'</td>
            </tr>
            <tr>
                <td>熱度</td>
                <td>'. $data[$key]['heat'] .'</td>
            </tr>
        </table>
        </div>
        </body>
        <footer>
            <table>
                <tr>
                    <td>時間</td>
                    <td>'. date('Y-m-d-H-i-s') .'</td>
                </tr>
            </table>
        </footer>
        </html>';
    }
?>