<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Item</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../../global/styles.css">
    <link rel="stylesheet" href="../../global/header/styles.css">
    <link rel="stylesheet" href="../../global/footer/styles.css">
</head>

<?php
session_start();
$isLoggedIn = 'false';
$username = '';
if (isset($_SESSION['username'])) {
    $isLoggedIn = 'true';
    $username = $_SESSION['username'];
}
echo 'isLoggedIn: ' . $isLoggedIn;
echo '<br>';
echo 'username: ' . $username;
echo '<br>';

?>

<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');

$product_id = '';
$product_name = '';
$product_desc = '';
$product_price = '';
$product_rating = '';
$product_image_url = '';

if (isset($_GET['id'])) {
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    $sql = 'SELECT id, name, description, price, rating, img_url FROM listings WHERE id = ' . $_GET['id'];
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // echo 'sql result: ' . print_r($res_str);
    // echo '<br>';

    if ($res_str) {
        echo print_r($res_str);
        $product_id = $res_str[0]['id'];
        $product_name = $res_str[0]['name'];
        $product_desc = $res_str[0]['description'];
        $product_price = $res_str[0]['price'];
        $product_rating = $res_str[0]['rating'];
        $product_image_url = $res_str[0]['img_url'];
    } else {
        echo 'ERROR 404 ITEM NOT FOUND';
    }

    mysqli_close($conn);
} else {
    header('Location: /shop');
}


?>

<body class="item-page">
    <?php include('../../global/header/index.php'); ?>
    <div class="item-content-container">
        <div class="item-content">
            <div class="item-image-container">

                <div class="item-image">
                    Image placeholder
                </div>
            </div>
            <div class="item-text-container">
                <h1><?php echo $product_name ?></h1>
                <h3>Description: <?php echo $product_desc ?></h3>
                <p>PriceL <?php echo $product_price ?></p>
                <p>Rating: <?php echo $product_rating ?></p>
                <div class="button-container">
                    <button class="Button" onclick="handleAddToCart(<?php echo $isLoggedIn ?>, <?php echo $product_id ?>)">Add to Cart</button>
                </div>
            </div>

        </div>
    </div>
    <?php include('../../global/footer/index.php'); ?>
</body>
<script>
    function handleAddToCart(isLoggedIn, productId, quantity = 1) {
        // add a check for 0 quantity or smthnn
        if (isLoggedIn) {
            window.location.href = window.location.origin + "/shop/item/components/add_to_cart.php?listing_id=" + productId + "&quantity=" + quantity;
        } else {
            window.location.href = window.location.origin + "/profile/";
        }
        // console.log(id);
    }
</script>

<?php echo
"<script> document.title = " .  '"' . $product_name . '"' . "</script>"
?>


</html>