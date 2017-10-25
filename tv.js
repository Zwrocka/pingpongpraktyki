var conn = new WebSocket('ws://10.67.199.58:8080/points');
//$('button.first').click function(){
//$('input.gds').
//}

function updateScoreOnUI (backendJSON) {
    $('.scoreupdate').text(backendJSON.data.pointsone);
    $('.scoreupdate2').text(backendJSON.data.pointstwo);
    $('.teamone').text(backendJSON.data.team_one);
    $('.teamtwo').text(backendJSON.data.team_two);
}
conn.onmessage = function(e) { 
    console.log(e.data); 
    var myObj = JSON.parse(e.data);
    
    if (myObj.action == 'startGame') {
        updateScoreOnUI(myObj)
    } else if(myObj.action == 'scoreUpdate'){
        $('.scoreupdate').text(myObj.data.pointsone);
        $('.scoreupdate2').text(myObj.data.pointstwo);
    } else if(myObj.action == 'initialScore'){
        updateScoreOnUI(myObj)
    } else if (myObj.action == 'sendHistory') {
  //     $('.score').text(myObj.data.pointsone);
    //   $('.scoree').text(myObj.data.pointstwo);
      // $('.members').text(myObj.data.team_one);
    //   $('.memberss').text(myObj.data.team_two);
      //  debugger;
    }

};

    
conn.onopen = function(e) {
    var history = conn.send(JSON.stringify({
        action: 'getHistory',
    }));
    
   // debugger;
};

conn.onclose = function(e) { 
//    conn.send('disconnect');
};    

conn.onerror=function(e){
	console.error(e)
};
//var p="sss";
//var b= e.data.history.teamone;

//var html = "<tr> <td> " + e.data.team_one + " vs " +  e.data.team_two //+ "</td> <td>" ;
//$('table').append(html)
//alert(a+b);


  //$('table').text("<tr> <td> " + e.data.history.teamone + " vs " +  e.data.history.teamtwo + "</td><td>"+e.data.history.members +":"+e.data.history.memberss+"</td></tr>";);
    //    console.log(myObj.data.history);