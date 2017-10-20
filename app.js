	// Then some JavaScript in the browser:
    var conn = new WebSocket('ws://localhost:8080/points');
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
		conn.send("incrementFirst");
	});
	$('.minus').click(function() {
        initialScore--; 
        $('.scoreupdatex').text(initialScore);
		console.log("Dekrementuje");
		conn.send("decrementFirst");
	});
    //Druga strona
    $('.pluss').click(function() {
        initialScoree++; 
        $('.scoreupdatey').text(initialScoree);
		console.log("Inkrementujee");
		conn.send("incrementSecond");
	});
	$('.minuss').click(function() {
        initialScoree--; 
        $('.scoreupdatey').text(initialScoree);
		console.log("Dekrementujee");
		conn.send("decrementSecond");
	});
