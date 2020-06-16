$(document).ready(function() {
    $('#api-key-btn').click(function() {
        //let the user confirm that they want to generat an API key
        var confirm_key = confirm("You are about to generate a new API key");
        if (!confirm_key) {
            return;
        }
        $.ajax({
            url: "apikey.php",
            type: "post",
            success: function(data) {
                if (data['success'] == 1) {
                    //everything went fine
                    //set the key in the textarea
                    $('#api_key').val(data['message']);
                } else {
                    alert("Something went wrong. Please try again");
                }
            }
        });
    });
});