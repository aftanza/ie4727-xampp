<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../global/styles.css">
    <link rel="stylesheet" href="../global/header/styles.css">
    <link rel="stylesheet" href="../global/footer/styles.css">
</head>

<?php
session_start();

$user_id = '';
$cart_id = '';
$total = 0;

$data = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cart_id = '';

    $conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    $sql = 'SELECT id FROM carts WHERE user_id = ' . $user_id;
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $cart_id = $res_str[0]['id'];

    $sql = 'SELECT ci.quantity, l.id, l.name, l.price, l.img_url FROM (cart_items AS ci JOIN listings AS l ON l.id = ci.listing_id) WHERE ci.cart_id = ' . $cart_id . ' ORDER BY ci.created_at ASC';

    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // Add subtotal
    $data = array_map(function ($i) {
        $total = $i['quantity'] * $i['price'];
        $i['subtotal'] = number_format($total, 2);
        addToTotal($total);
        return $i;
    }, $res_str);

    print_r($data);

    mysqli_close($conn);
} else {
    header('Location: /profile');
}

function addToTotal($subtotal)
{
    global $total;
    $total = $total + $subtotal;
}

$total = number_format($total, 2);

?>


<body class="cart-page">
    <?php include('../global/header/index.php'); ?>
    <div class="cart-content">
        <div class="Card--cart cart-item">
            <div>
                No.
            </div>

            <div class="cart-item-image">
                Image
            </div>

            <div class="cart-item-name">
                Name
            </div>

            <div>
                Price
            </div>

            <div>
                Quantity
            </div>

            <div>
                Subtotal
            </div>
        </div>
        <?php foreach ($data as $index => $cart_listing): ?>
            <!-- <?php echo $cart_listing[''] ?> -->
            <div class="Card--cart cart-item">
                <div>
                    <?php echo $index + 1 ?>
                </div>
                <div class="cart-item-image">
                    <p><?php echo $cart_listing['img_url'] ?></p>
                </div>

                <div class="cart-item-name">
                    <?php echo $cart_listing['name'] ?>
                </div>

                <div>
                    <?php echo $cart_listing['price'] ?>
                </div>

                <div>
                    <?php echo $cart_listing['quantity'] ?>
                </div>
                <div class="cart-item-subtotal">
                    <?php echo $cart_listing['subtotal'] ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="Card--cart cart-item">
            <div class="cart-item-total">
                Total:
            </div>

            <div>
                <?php echo $total ?>
            </div>
        </div>
    </div>
    <?php include('../global/footer/index.php'); ?>
</body>

</html>