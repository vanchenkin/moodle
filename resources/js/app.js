require('./bootstrap');

$(document).ready(function() {
    $(".confirm").click(function(event) {
        if(!confirm('Вы уверены?') )
            event.preventDefault();
    });
});