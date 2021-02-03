require('./bootstrap');

$(document).ready(function() {
    $(".confirm").click(function(event) {
        if(!confirm('Вы уверены?') )
            event.preventDefault();
    });

    $('.task-text').hover(
		function(e){
			e.target.style = "";
		},
		function(e){
			e.target.style = "white-space: nowrap;";
		}
	);
    if($("#remain").length){
		var r = $("#remain").attr("remain");
		var x = setInterval(function() {
			r-=0.1;
			var hours = Math.floor((r % (60 * 60 * 24)) / (60 * 60));
			var minutes = Math.floor((r % (60 * 60)) / (60));
			var seconds = Math.floor((r % (60)));
			minutes = minutes < 10 ? "0" + minutes : minutes;
        	seconds = seconds < 10 ? "0" + seconds : seconds;
        	hours = hours < 10 ? "0" + hours : hours;
	    	$("#remain").html(hours + "ч " + minutes + "м " + seconds + "с ");
	    	if (r < 0) {
				clearInterval(x);
				$("#test-form").sumbit();
			}
		}, 100);
    }
});