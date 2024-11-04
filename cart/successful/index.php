<?php require('global/php/db.php'); ?>

<?php
$total = 0;
$placed_order_id = '';

// Hack to get sum because i forgot to implement total in DB lol
if (isset($_GET["placed_order_id"])) {
    $placed_order_id = $_GET["placed_order_id"];

    $conn = db_connect();

    $sql = 'SELECT pci.quantity, l.name, l.price, l.img_url, po.order_status 
    FROM placed_cart_items AS pci 
    JOIN listings AS l ON l.id = pci.listing_id 
    JOIN placed_orders AS po ON po.id = pci.placed_order_id
    WHERE po.id = ' . $placed_order_id;

    // echo $sql;
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $placed_cart_items = array_map(function ($i) {
        $total = $i['quantity'] * $i['price'];
        $i['subtotal'] = number_format($total, 2);
        addToTotal($total);
        return $i;
    }, $res_str);
} else {
    header('location: /');
    exit();
}
?>

<?php function addToTotal($subtotal)
{
    global $total;
    $total = $total + $subtotal;
}
$total = number_format($total, 2); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successfull Transaction</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/global/styles.css">
    <link rel="stylesheet" href="/global/header/styles.css">
    <link rel="stylesheet" href="/global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>

<body class="successful-transaction">
    <?php include('global/header/index.php'); ?>
    <div class="successful-transaction-content">
        <div class="icon-container">
            <img class="icon" src="/img/icons/checkmark-circle.svg" alt="">
        </div>

        <div class="text-container">
            <h1 class="green">Transaction Successful!</h1>
            <h3 class="subtext">Thank you for your purchase. Your order has been processed successfully.</h3>
        </div>

        <div class="card-container">
            <div class="Card Card--no-outline success-card ">
                <div class="Card--shop-header">
                    <h2 class="green">Order Summary</h2>
                </div>
                <div class="Card--shop-content">
                    <div class="row-container">
                        <p class="subtext">Order Number</p>
                        <p class="white"><?php echo $placed_order_id ?></p>
                    </div>
                    <hr class="solid">
                    <div class="row-container">
                        <p class="subtext">Total Amount</p>
                        <p class="white">$<?php echo $total ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-container">
            <button class="Button Button--secondary" onclick="handleViewOrderDetails(<?php echo $placed_order_id ?>)">
                <h3>View Order Details</h3>
                <img src="/img/icons/arrow-right.svg" alt="">
            </button>
            <button class="Button Button--tertiary" onclick="handleContinueShopping()">
                <h3>Continue Shopping</h3>
                <img class="icon" src="/img/icons/bag.svg" alt="">
            </button>
        </div>

    </div>
    <?php include('global/footer/index.php'); ?>
</body>

<script>
    function handleContinueShopping() {
        window.location.href = '/shop';
    }

    function handleViewOrderDetails(placedOrderId) {
        window.location.href = '/profile/order_history/order/?id=' + placedOrderId;

    }
</script>

</html>