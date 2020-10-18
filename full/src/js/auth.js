$(document).ready(function() {

    $("#toggle-signup").click(function(e) {
        e.preventDefault();
        $(".login").fadeOut(450, function() {
            $(".signup").fadeIn();
        });
    });

    $("#toggle-login").click(function(e) {
        e.preventDefault();
        $(".signup").fadeOut(450, function() {
            $(".login").fadeIn();
        });
    });



});