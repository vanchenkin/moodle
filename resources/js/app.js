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
});