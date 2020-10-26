$(document).ready(function() {

    /**
     * 
     * Toggle forms
     */

    $("#show-signin, #show-signup").click(function(e) {
        e.preventDefault();
        if (this.id == "show-signin") toggle(".signup", ".signin");
        if (this.id == "show-signup") toggle(".signin", ".signup");
    });

    function toggle(from, to, time = 450) {
        $(from).fadeOut(time, function() {
            $(to).fadeIn();
        });
    }

    /**
     * 
     * Login ajax
     */

    $("#signup-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "src/php/signup.php",
            data: $(this).serialize(),
            success: function(response) {
                let data = JSON.parse(response);

                if (data.success == 1) {
                    swal({
                        title: "You have a new account",
                        text: "Wait for a moment...",
                        icon: "success",
                        timer: 3000,
                        buttons: false,
                        closeOnClickOutside: false
                      }).then(function() {
                          toggle(".signup", ".signin");
                      });
                }
            }
        });
     });
});