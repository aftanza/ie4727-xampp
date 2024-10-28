<?php require('global/persist/account_persist.php'); ?>
<?php require('global/php/db.php'); ?>

<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/global/styles.css">
    <link rel="stylesheet" href="/global/header/styles.css">
    <link rel="stylesheet" href="/global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>

<?php
$user_id = '';
$cart_id = '';
$total = 0;
$isCartEmpty = true;

$data = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cart_id = '';

    $conn = db_connect();

    $sql = 'SELECT id FROM carts WHERE user_id = ' . $user_id;
    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $cart_id = $res_str[0]['id'];

    $sql = 'SELECT ci.id AS cart_item_id, ci.quantity, l.id AS listing_id, l.name, l.price, l.img_url FROM (cart_items AS ci JOIN listings AS l ON l.id = ci.listing_id) WHERE ci.cart_id = ' . $cart_id . ' ORDER BY ci.created_at ASC';

    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // Add subtotal
    $data = array_map(function ($i) {
        $total = $i['quantity'] * $i['price'];
        $i['subtotal'] = number_format($total, 2);
        addToTotal($total);
        return $i;
    }, $res_str);

    $isCartEmpty = empty($data);

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
    <div class="cart-content Content">
        <div class="Card--grid cart-item">
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
            <!-- <?php echo $cart_listing['cart_item_id'] ?> -->
            <div class="Card--grid cart-item">
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
                    <?php $input_id = "cart-item-quantity-input-" . $index ?>
                    <?php $cart_item_id = $cart_listing['cart_item_id'] ?>
                    <input id="<?php echo $input_id ?>" class="cart-item-quantity-input" type="number" value="<?php echo $cart_listing['quantity'] ?>" onkeydown="if (event.key === 'Enter') updateQuantity(this, '<?php echo $cart_item_id ?>')" min="0" oninput="checkForNegative(this)">
                </div>
                <div class="cart-item-subtotal">
                    <?php echo $cart_listing['subtotal'] ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="Card--grid cart-item">
            <div class="cart-item-total">
                Total:
            </div>

            <div>
                <?php echo $total ?>
            </div>
        </div>
        <div class="Card--grid cart-item">
            <div class="cart-item-checkout">
                <button class="Button" onclick="handleCheckout('<?php echo $cart_id ?>', '<?php echo $user_id ?>', '<?php echo $isCartEmpty ?>')">Checkout</button>
            </div>
        </div>
    </div>
    <?php include('../global/footer/index.php'); ?>
</body>

<script>
    function handleCheckout(cartId, userId, isCartEmpty) {
        if (!isCartEmpty) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'components/checkout.php';

            let cartIdInput = document.createElement('input');
            cartIdInput.type = 'hidden';
            cartIdInput.name = 'cart_id';
            cartIdInput.value = cartId;

            let userIdInput = document.createElement('input');
            userIdInput.type = 'hidden';
            userIdInput.name = 'user_id';
            userIdInput.value = userId;

            form.appendChild(cartIdInput);
            form.appendChild(userIdInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function updateQuantity(input, cartItemId) {
        let quantity = input.value;
        window.location.href = window.location.origin + "/cart/components/update_quantity.php?quantity=" + encodeURIComponent(quantity) + "&cart_item_id=" + encodeURIComponent(cartItemId);
    }

    function checkForNegative(input) {
        if (input.value < 0) {
            input.value = 0;
        }
    }
</script>


</html>