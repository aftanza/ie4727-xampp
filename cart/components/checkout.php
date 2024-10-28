<?php require('global/php/db.php'); ?>

<?php
// echo "hello";
// echo "<br/>";
if (isset($_POST["cart_id"]) && isset($_POST["user_id"])) {
    $cart_id = $_POST["cart_id"];
    $user_id = $_POST["user_id"];

    $conn = db_connect();

    // Insert a new placed order

    $sql = 'INSERT INTO placed_orders (user_id, order_status) VALUES ' . '(' . $user_id . ',' . "'order_placed'" . ')';
    $res = mysqli_query($conn, $sql);
    $placed_order_id = mysqli_insert_id($conn);

    // Get the things from cart_items

    $sql = 'SELECT listing_id, quantity FROM cart_items';
    $res = mysqli_query($conn, $sql);

    $cart_items = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $last_cart_item = end($cart_items);

    // iterate thru cart_items and put them into placed_cart_items

    $sql = 'INSERT INTO placed_cart_items (listing_id, placed_order_id, quantity) VALUES ';
    foreach ($cart_items as $cart_item) {
        $sql .= '(' . $cart_item['listing_id'] . ',' . $placed_order_id . ',' . $cart_item['quantity'] . ')';
        if ($cart_item != $last_cart_item) {
            $sql .= ",";
        }
    }
    $res = mysqli_query($conn, $sql);

    // Delete all relevant cart_items leveraging on delete cascade and make new cart  

    $sql = 'DELETE FROM carts WHERE user_id = ' . $user_id;
    $res = mysqli_query($conn, $sql);

    $sql = 'INSERT INTO carts (user_id) values (' . $user_id . ')';
    $res = mysqli_query($conn, $sql);

    mysqli_close($conn);
} else {
    echo "Error on checkout: Invalid parameters";
}
header('location: ../successful');
