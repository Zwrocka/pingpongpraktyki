var conn = new WebSocket('ws://10.67.199.58:8080/points');
var initialScore = 0;
conn.onmessage = function(e) { 
    console.log(e.data); 
    if(e.data=='score_update_inc'){
       initialScore++; 
        $('.scoreupdate').text(initialScore);
    }
    else if(e.data=='score_update_dec'){
        initialScore--;
        $('.scoreupdate').text(initialScore);
    }
    // musisz nadsluchiwac na wiadomosc z backendu i updatowac UI .text()
    // TODO dodac logike
    
}; 

conn.onopen = function(e) { 
    conn.send('connect'); 
};
conn.onclose = function(e) { 
    conn.send('disconnect');
};    
conn.onerror=function(){
	console.log("error")
};