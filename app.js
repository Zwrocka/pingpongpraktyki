	// Then some JavaScript in the browser:
    var conn = new WebSocket('ws://10.67.199.58:8080/points');
    var initialScore = 0;
    var initialScoree = 0;
// conn.onmessage = function(e) { console.log(e.data); };
    conn.onopen = function(e) { 
        console.log('connect'); 
    };
	$('.plus').click(function() {
        initialScore++; 
        $('.scoreupdatex').text(initialScore);
		console.log("Inkrementuje");
		conn.send(JSON.stringify({
            action: 'incrementFirst',
        }));
	});
	$('.minus').click(function() {
        initialScore--; 
        $('.scoreupdatex').text(initialScore);
		console.log("Dekrementuje");
		conn.send(JSON.stringify({
            action: 'decrementFirst',
        }));
	});
    //Druga strona
    $('.pluss').click(function() {
        initialScoree++; 
        $('.scoreupdatey').text(initialScoree);
		console.log("Inkrementujee");
		conn.send(JSON.stringify({
            action: 'incrementSecond',
        }));
	});
	$('.minuss').click(function() {
        initialScoree--; 
        $('.scoreupdatey').text(initialScoree);
		console.log("Dekrementujee");
		conn.send(JSON.stringify({
            action: 'decrementSecond',
            }));
	});
    $('.gamebutton').click(function(){
        conn.send(JSON.stringify({
            action: 'startGame',
            data:{
                team_one: $('.teamone').val(),   
                team_two: $('.teamtwo').val()
            }
            }));
        });
    $('.gamebuttonend').click(function(){
        conn.send(JSON.stringify({
            action: 'stopGame',
        }));
        });
    
   