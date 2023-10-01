add = (dht11,flame,led) =>
{
    var request = new XMLHttpRequest();
    request.open('POST', '/api/control_add.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send("dht11=" + dht11 + "&" + "flame=" + flame + "&" + "led=" + led);
}
check = () =>
{
    var dht11 = document.querySelector('#dht11').checked;
    var flame = document.querySelector('#flame').checked;
    var led = document.querySelector('#led').checked;
    add(dht11,flame,led);
    setTimeout(function(){
        console.log("wait");
    },500);
}
