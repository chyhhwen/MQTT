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
    if($data[$key]['dht11'] == "ON")
    {
        echo '<input type ="checkbox" checked>';
    }
    else
    {
        echo '<input type ="checkbox">';
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
    if($data[$key]['flame'] == "ON")
    {
        echo '<input type ="checkbox" checked>';
    }
    else
    {
        echo '<input type ="checkbox">';
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
    if($data[$key]['led'] == "ON")
    {
        echo '<input type ="checkbox" checked>';
    }
    else
    {
        echo '<input type ="checkbox">';
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