var conn = new 
var initailScore = 0;
WebSocket('ws://localhost:8080/points');
conn.onmessage = function(e) { 
    console.log(e.data);
   
    if(i=null){
      var i=0;
    } 
    else if(console.log(e.data)==score_update_inc){
       i++; 
    }
    else if(console.log(e.data)==score_update_dec){
        i--;
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
}
conn.onmessage = function(e){
    console.log(event)
}
