var conn = new WebSocket('ws://localhost:8080/points');
//$('button.first').click function(){
//$('input.gds').
//}
conn.onmessage = function(e) { 
    console.log(e.data); 
    var myObj = JSON.parse(e.data);
    $('.scoreupdate').text(myObj.pointsone);
    
    $('.scoreupdate2').text(myObj.pointstwo);
    console.log("parsuje");
};

    
conn.onopen = function(e) {
//    conn.send('connect'); 
};

conn.onclose = function(e) { 
//    conn.send('disconnect');
};    

conn.onerror=function(e){
	console.error(e)
};