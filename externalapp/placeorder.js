$(document).ready(function() {
    $('#btn-place-order').click(function(event) {
        event.preventDefault();

        //recieve the variable
        var name_of_food = $('#name_of_food').val();
        var number_of_units = $('#number_of_units').val();
        var unit_price = $('#unit_price').val();
        var order_status = $('#status').val();

        //remember you will communicate with the API if you have the API
        //You go to the API system and generate your API key
        //We now build a http post request and send it using ajax
        $.ajax({
            url: "http://localhost/Internet-Application-Programming/api/v1/orders/index.php", //this is the url to resource
            type: "post",
            data: { name_of_food: name_of_food, number_of_units: number_of_units, unit_price: unit_price, order_status: order_status },
            headers: {
                'Authorization': 'NSOZ0BcNh422dZfcIjAI5o7Tj62lMljkAqVEZdTTi55v/HUPydRStiE3a/WYENNW'
            },
            success: function(data) {
                alert(data.message);
            },
            error: function() {
                alert("An error occurred");
            }
        });
    });

    $('#btn-check-status').click(function(e) {
        //e.preventDefault();

        var order_id = $('#order_id').val();

        $.ajax({
            url: "http://localhost/Internet-Application-Programming/api/v1/orders/index.php",
            type: "get",
            data: { order_id: order_id },
            headers: {
                'Authorization': 'NSOZ0BcNh422dZfcIjAI5o7Tj62lMljkAqVEZdTTi55v/HUPydRStiE3a/WYENNW'
            },
            success: function(response) {
                alert(response.message);
            },
            error: function() {
                alert("An error occurred");
            }
        });
    });

});