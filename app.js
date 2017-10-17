	// Then some JavaScript in the browser:
    var conn = new WebSocket('ws://localhost:8080/points');
	conn.onmessage = function(e) { console.log(e.data); };
    conn.onopen = function(e) { conn.send('connect'); };
	$('.plus').click(function()
	{
		console.log("Inkrementuje");
		conn.send("increment");
	});
	$('.minus').click(function()
	{
		console.log("Dekrementuje");
		conn.send("decrement");
	});
