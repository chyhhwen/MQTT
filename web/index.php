<?php
    require_once("./lib/database.php");
    $sql = new sql();
    $sql -> config("root","","mqtt","dht11");
    $sql -> put_data(['id','state','temperature','humidity','time']);
    $data = $sql -> sel();
    foreach($data as $key => $val)
    {
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
              </tr>
              <tr>
                <td>時間</td>
                <td>'. $data[$key]['time'] .'</td>
              </tr>
            </table>
        </div>
        </body>
        </html>';
    }

?>