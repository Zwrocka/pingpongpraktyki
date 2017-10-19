var conn = new WebSocket('ws://localhost:8080/points');
var initailScore =  $('.scoreupdate') 0;
conn.onmessage = function(e) { 
    console.log(e.data); 
    if(e.data=='score_update_inc'){
       initialScore++; 
        alert("dodano");
    };
    else if(e.data=='score_update_dec'){
        initialScore--;
        alert("odjęto");
    };
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