<?php require('global/php/db.php'); ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$listing_id = '';
$quantity = 0;
$cart_id = '';
$user_id = $_SESSION['user_id'];

if (isset($_GET['listing_id']) && isset($_GET['quantity'])) {
    $listing_id = $_GET['listing_id'];
    $quantity = $_GET['quantity'];

    $conn = db_connect();

    $sql = 'SELECT id FROM carts WHERE user_id = ' . $user_id;
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $cart_id = $res_str[0]['id'];

    $sql = 'INSERT INTO cart_items (cart_id, listing_id, quantity) VALUES ' . '(' . $cart_id . ',' . $listing_id . ',' . $quantity . ')' . ' ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)';
    $res = mysqli_query($conn, $sql);
    // echo $sql;
    // print_r($cart_id);
    mysqli_close($conn);
}
header('location: /shop/item/?id=' . $listing_id);
exit();
