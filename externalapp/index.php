<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">

    <!--JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="placeorder.js"></script>
    <title>Order Page</title>
</head>

<body>

    <div class="container mt-5">
        <h3>It is time to communicate with the exposed API, all we need is the API key to be passed in the header</h3>
        <hr>
        <h4>1. Feature 1 - Placing an order</h4>
        <hr>
        <form name="order_form" id="order_form">
            <fieldset>
                <legend>Place Order</legend>
                <input type="text" name="name_of_food" id="name_of_food" required placeholder="Name of Food"><br>
                <input type="number" name="number_of_units" id="number_of_units" required placeholder="Number of Units"><br>
                <input type="number" name="unit_price" id="unit_price" required placeholder="Unit Price"><br>
                <input type="hidden" name="status" id="status" required placeholder="Order Status" value="order placed"><br><br>

                <button type="submit" class="btn btn-primary" id="btn-place-order">Place Order</button>
            </fieldset>
        </form>

        <hr>
        <h4>2. Feature 2 - Checking order status</h4>
        <hr>

        <form name="order_status_from" id="order_status_form">
            <fieldset>
                <legend>Check Order Status</legend>
                <input type="number" name="order_id" id="order_id" required placeholder="Order ID"><br><br>

                <button class="btn btn-warning" type="submit" id="btn-check-status">Check Order Status</button>
            </fieldset>
        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>