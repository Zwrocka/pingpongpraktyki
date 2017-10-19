	// Then some JavaScript in the browser:
    var conn = new WebSocket('ws://10.67.199.59:8080/points');
	// conn.onmessage = function(e) { console.log(e.data); };
    conn.onopen = function(e) { 
        console.log('connect'); 
    };
	$('.plus').click(function() {
		console.log("Inkrementuje");
		conn.send("increment");
	});
	$('.minus').click(function() {
		console.log("Dekrementuje");
		conn.send("decrement");
	});
