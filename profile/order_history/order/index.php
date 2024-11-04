<?php require('global/php/db.php'); ?>
<?php require('global/persist/account_persist.php'); ?>


<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../../../global/styles.css">
    <link rel="stylesheet" href="../../../global/header/styles.css">
    <link rel="stylesheet" href="../../../global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>
<?php
$total = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = '';
    $placed_order_id = '';
    $placed_cart_items = [];

    if (isset($_GET['id'])) {
        $placed_order_id = $_GET['id'];
    }

    $user_id = $_SESSION['user_id'];

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



    // print_r($placed_cart_items);
} else {
    header('Location: /profile');
}

function addToTotal($subtotal)
{
    global $total;
    $total = $total + $subtotal;
}
$total = number_format($total, 2);

// $placed_orders_id = $res_str[0]['id'];



// $sql = 'SELECT ci.id AS cart_item_id, ci.quantity, l.id AS listing_id, l.name, l.price, l.img_url FROM (placed_cart_items AS pci JOIN listings AS l ON l.id = pci.listing_id) WHERE pci.placed_order_id = ' . $placed_orders_id . ' ORDER BY pci.created_at ASC';
// $sql = 'SELECT ci.id AS cart_item_id, ci.quantity, l.id AS listing_id, l.name, l.price, l.img_url FROM (placed_cart_items AS pci JOIN listings AS l ON l.id = pci.listing_id) WHERE pci.placed_order_id = ' . $placed_orders_id . ' ORDER BY pci.created_at ASC';

// $res = mysqli_query($conn, $sql);
// $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

// print_r($placed_orders);

mysqli_close($conn);


?>

<body class="order-page">
    <?php include('../../../global/header/index.php'); ?>
    <div class="order-content Content">
        <div class="Card--grid Card--grid-header order-item">
            <div>
                No.
            </div>

            <div>
                Image
            </div>

            <div>
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
        <?php foreach ($placed_cart_items as $index => $placed_cart_item): ?>
            <div class="Card--grid order-item">
                <div>
                    <?php echo $index + 1 ?>
                </div>
                <div class="cart-item-image">
                    <img src="<?php echo $placed_cart_item['img_url'] ?>" alt="">
                </div>

                <div class="cart-item-name">
                    <?php echo $placed_cart_item['name'] ?>
                </div>

                <div>
                    <?php echo $placed_cart_item['price'] ?>
                </div>

                <div>
                    <?php echo $placed_cart_item['quantity'] ?>
                </div>
                <div>
                    $<?php echo $placed_cart_item['subtotal'] ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="Card--grid order-item">
            <div class="order-item-total">
                Total:
            </div>

            <div>
                $<?php echo $total ?>
            </div>
        </div>

    </div>
    <?php include('../../../global/footer/index.php'); ?>
</body>

</html>