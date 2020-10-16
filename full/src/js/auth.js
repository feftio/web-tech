$(document).ready(function() {

    $("#toggle-reg").click(function(e) {
        e.preventDefault();
        $(".login").fadeOut(500, function() {
            $(".reg").fadeIn();
        });
    });

    $("#toggle-login").click(function(e) {
        e.preventDefault();
        $(".reg").fadeOut(500, function() {
            $(".login").fadeIn();
        });
    });



});