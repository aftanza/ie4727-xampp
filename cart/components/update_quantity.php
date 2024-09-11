<?php
if (isset($_GET['quantity']) && isset($_GET['cart_item_id'])) {
    $quantity = $_GET['quantity'];
    $cartItemId = $_GET['cart_item_id'];

    $conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    if ((int)$quantity <= 0) {
        $sql = 'DELETE FROM cart_items WHERE id = ' . $cartItemId;
        $res = mysqli_query($conn, $sql);
    } else {
        $sql = 'UPDATE cart_items SET quantity = ' . $quantity . ' WHERE id = ' . $cartItemId;
        $res = mysqli_query($conn, $sql);
    }

    mysqli_close($conn);
}
header('location: ../index.php');
