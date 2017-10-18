var conn = new WebSocket('ws://localhost:8080/points');
conn.onmessage = function(e) { console.log(e.data); };
conn.onopen = function(e) { conn.send('connect'); };
$('scoreuptade')function(){
conn.onmessage();
}