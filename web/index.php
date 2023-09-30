<?php
    require_once("./lib/database.php");
    $sql = new sql();
    $sql -> config("root","","mqtt","led");
    $sql -> put_data(['id','state','time']);
    $data = $sql -> led_sel();
    echo ' <html>
    <head>
        <link rel="stylesheet" href="./public/index.css">
        <meta charset="UTF-8">
        <title>mqtt demo</title>
    </head>
    <body>
    <nav>
        <span style="padding-left:40vw;">MQTT測試</span>
    </nav>
    <div class="state">
        <table>
        <tr>
            <td>LED</td>
        </tr>
        <tr>';
    foreach($data as $key => $val)
    {
        echo'
        <td>狀態</td>
        <td>'. $data[$key]['state'] .'</td>';
    }
    echo'
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
        <td>'. $data[$key]['state'] .'</td>
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
                <td>'. $data[$key]['state'] .'</td>
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
                    <td>'. $data[$key]['time'] .'</td>
                </tr>
            </table>
        </footer>
        </html>';
    }
?>