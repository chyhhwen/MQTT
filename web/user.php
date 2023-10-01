<?php
require_once("./lib/database.php");
$sql = new sql();
$sql -> config("root","","mqtt","control");
$sql -> put_data(['id','dht11','flame','led','time']);
$data = $sql -> control_sel();
foreach($data as $key => $val)
{
    echo '
    <html>
    <head>
        <link rel="stylesheet" href="./public/user.css">
        <link rel="stylesheet" href="./public/button.css">
        <script type="text/javascript" src="./public/user.js"></script>
        <meta charset="UTF-8">
        <title>mqtt demo</title>
    </head>
    <body>
    <table>
    <tr>
    <td>
        <span>溫度感測器</span>
    </td>
    <td>
    <label>';
    if($data[$key]['dht11'] == "true")
    {
        echo '<input type ="checkbox" checked id = "dht11" onclick="check()">';
    }
    else
    {
        echo '<input type ="checkbox" id = "dht11">';
    }
    echo'
    <span><i></i></span>
    </label>
    </td>
    </tr>
    <tr>
    <td>
        <span>火焰感測器</span>
    </td>
    <td>
    <label>';
    if($data[$key]['flame'] == "true")
    {
        echo '<input type ="checkbox" checked id = "flame" onclick="check()">';
    }
    else
    {
        echo '<input type ="checkbox" id = "flame">';
    }
    echo'
    <span><i></i></span>
    </label>
    </td>
    </tr>
    <tr>
    <td>
        <span>雙色小燈泡</span>
    </td>
    <td>
    <label>';
    if($data[$key]['led'] == "true")
    {
        echo '<input type ="checkbox" checked id = "led" onclick="check()">';
    }
    else
    {
        echo '<input type ="checkbox" id = "led">';
    }
    echo'
    <span><i></i></span>
    </label>
    </td>
    </tr>
    </table>
    </body>
    </html>';
   }
?>