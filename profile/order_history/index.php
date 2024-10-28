<?php require('global/php/db.php'); ?>

<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/global/styles.css">
    <link rel="stylesheet" href="/global/header/styles.css">
    <link rel="stylesheet" href="/global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>
<?php
session_start();

if (isset($_SESSION['user_id'])) {

    $user_id = '';
    $placed_orders = [];

    $data = [];


    $user_id = $_SESSION['user_id'];

    $conn = db_connect();

    $sql = 'SELECT id, order_status, created_at FROM placed_orders WHERE user_id = ' . $user_id . ' ORDER BY created_at DESC';
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $placed_orders = $res_str;
} else {
    header('Location: /profile');
}
// $placed_orders_id = $res_str[0]['id'];



// $sql = 'SELECT ci.id AS cart_item_id, ci.quantity, l.id AS listing_id, l.name, l.price, l.img_url FROM (placed_cart_items AS pci JOIN listings AS l ON l.id = pci.listing_id) WHERE pci.placed_order_id = ' . $placed_orders_id . ' ORDER BY pci.created_at ASC';
// $sql = 'SELECT ci.id AS cart_item_id, ci.quantity, l.id AS listing_id, l.name, l.price, l.img_url FROM (placed_cart_items AS pci JOIN listings AS l ON l.id = pci.listing_id) WHERE pci.placed_order_id = ' . $placed_orders_id . ' ORDER BY pci.created_at ASC';

// $res = mysqli_query($conn, $sql);
// $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

print_r($placed_orders);

mysqli_close($conn);


?>

<body class="order_history-page">
    <?php include('../..//global/header/index.php'); ?>
    <div class="order_history-content Content">
        <div class="Card--grid order_history-item">
            <div>
                No.
            </div>

            <div>
                Status
            </div>

            <div>
                Date
            </div>
        </div>
        <?php foreach ($placed_orders as $index => $placed_order): ?>

            <div class="Card--grid order_history-item pointer" onclick="handleOnclick('<?php echo $placed_order['id'] ?>')">
                <div>
                    <?php echo $index + 1 ?>
                </div>

                <div>
                    <?php echo $placed_order['order_status'] ?>
                </div>

                <div>
                    <?php echo $placed_order['created_at'] ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <?php include('../../global/footer/index.php'); ?>
</body>

<script>
    function handleOnclick(id) {
        window.location.href = window.location.href + '/order?id=' + id
    }
</script>

</html>