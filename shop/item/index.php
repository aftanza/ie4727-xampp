<?php require('global/php/db.php'); ?>
<?php require_once 'global/php/convert_to_stars.php'; ?>

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
// echo 'isLoggedIn: ' . $isLoggedIn;
// echo '<br>';
// echo 'username: ' . $username;
// echo '<br>';

?>

<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$conn = db_connect();

$product_id = '';
$product_name = '';
$product_desc = '';
$product_price = '';
$product_rating = '';
$product_image_url = '';

if (isset($_GET['id'])) {

    $sql = 'SELECT id, name, description, price, rating, img_url FROM listings WHERE id = ' . $_GET['id'];
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // echo 'sql result: ' . print_r($res_str);
    // echo '<br>';

    if ($res_str) {
        // echo print_r($res_str);
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
        <div class="item-content Content">
            <div class="item-image-container">
                <div class="item-image">
                    <img src="<?php echo $product_image_url ?>" alt="Image">
                </div>
            </div>

            <div class="item-text-container">
                <h1 class="item-text-name"><?php echo $product_name ?></h1>
                <p class="item-text-description">Etiam eros dolor, rhoncus porttitor iaculis et, laoreet ut ex. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam malesuada risus eget consequat tempor. Aenean gravida quam vitae mauris lacinia, id porta massa ultrices. Cras mollis ex vel diam pharetra, quis facilisis velit mollis. Pellentesque ut tellus finibus, laoreet nibh in, ultrices ligula. Suspendisse a leo tellus. Proin eleifend, lectus quis ultrices semper, magna nisl iaculis eros, quis tempus quam metus quis ligula. Fusce malesuada metus ut erat luctus, eget efficitur purus dignissim. Nullam mi nisi, tincidunt sed nibh in, feugiat tempus mi. Nunc pharetra sagittis est, et convallis lectus ullamcorper vitae. Sed venenatis felis tellus, vitae accumsan est fringilla a. Donec sit amet leo sem. Phasellus luctus urna justo, eget ultrices nisi rutrum eget. Donec iaculis tempus purus vitae fermentum. Sed sodales leo non metus scelerisque, non pretium erat consectetur.
                </p>
                <!-- <h3 class="item-text-description">Description: <?php echo $product_desc ?></h3> -->
                <p class="item-text-price">Price: <span class="color-green">$<?php echo $product_price ?></span></p>
                <p class="item-text-rating">Rating: <?php echo convertToStars($product_rating) ?></p>
                <div class="button-input-container">
                    <input id="input-product-details-cart" class="input-product-details-cart Input" type="number" min="1" oninput="checkMinOneItem(this)" value="1">
                    <button class="Button Button--secondary" onclick="handleAddToCart(<?php echo $isLoggedIn ?>, <?php echo $product_id ?>)">Add to Cart</button>
                </div>
            </div>
        </div>

    </div>
    <?php include('../../global/footer/index.php'); ?>
</body>

<script>
    function checkMinOneItem(node) {
        if (node.value < 1) {
            node.value = 1;
        }
    }
</script>

<script>
    function handleAddToCart(isLoggedIn, productId) {
        if (isLoggedIn) {
            try {
                const quantity = document.getElementById("input-product-details-cart").value;
                window.location.href = window.location.origin + "/shop/item/components/add_to_cart.php?listing_id=" + productId + "&quantity=" + quantity;
            } catch {
                console.log("Quantity not found");
            }
        } else {
            window.location.href = window.location.origin + "/profile/";
        }
    }
</script>

<?php echo
"<script> document.title = " .  '"' . $product_name . '"' . "</script>"
?>


</html>