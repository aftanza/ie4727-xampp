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

    // print_r($data);

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
        <div class="Card--grid Card--grid-header cart-item">
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
                    <img src="<?php echo $cart_listing['img_url'] ?>" alt="">
                </div>

                <div class="cart-item-name">
                    <?php echo $cart_listing['name'] ?>
                </div>

                <div>
                    $<?php echo $cart_listing['price'] ?>
                </div>

                <div>
                    <?php $input_id = "cart-item-quantity-input-" . $index ?>
                    <?php $cart_item_id = $cart_listing['cart_item_id'] ?>
                    <input id="<?php echo $input_id ?>" class="cart-item-quantity-input Input--variant Input--disable-decorator" type="number" value="<?php echo $cart_listing['quantity'] ?>" onkeydown="if (event.key === 'Enter') updateQuantity(this, '<?php echo $cart_item_id ?>')" min="0" oninput="checkForNegative(this)">
                </div>
                <div class="cart-item-subtotal">
                    $<?php echo $cart_listing['subtotal'] ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="Card--grid cart-item">
            <div class="cart-item-total">
                Total:
            </div>

            <div>
                $<?php echo $total ?>
            </div>
        </div>
        <div class="Card--grid cart-item">
            <div class="cart-item-checkout">
                <button class="Button Button--secondary" onclick="handleShowModal()">Checkout</button>
            </div>
        </div>
    </div>
    <?php include('../global/footer/index.php'); ?>


    <div id="checkout-modal" class="Modal">
        <div class="Modal--container">
            <div class="Modal--close">
                <span class="cross" onclick="handleCloseModal()">&times;</span>
            </div>

            <div class="Modal--header">
                <h2>Enter Payment Details</h2>
            </div>

            <form action="" class="Modal--content">
                <div class="input-label" style="grid-column: 1 / span 2;">
                    <label for="card-number">Card Number</label>
                    <input id="card-number" class="Input Input--variant Modal--input" placeholder="1234 5678 9012 3456">
                </div>

                <div class="input-label">
                    <label for="expiry-date">Expiry Date (MM/YY)</label>
                    <input id="expiry-date" type="month" class="Input Input--variant Modal--input" placeholder="MM/YY">
                </div>

                <div class="input-label">
                    <label for="cvv">CVV</label>
                    <input id="cvv" placeholder="123" class="Input Input--variant Modal--input">
                </div>

                <div class="input-label" style="grid-column: 1 / span 2;">
                    <label for="cardholder-name">Cardholder Name</label>
                    <input id="cardholder-name" placeholder="John Doe" class="Input Input--variant Modal--input">
                </div>


            </form>

            <div class="Modal--footer">
                <button class="Button Button--secondary" onclick="handleConfirmCheckout('<?php echo $cart_id ?>', '<?php echo $user_id ?>')">Confirm</button>
                <!-- <button class="Button Button--secondary" onclick="handleCloseModal()">Cancel</button> -->
            </div>
            <!-- <p>Are you sure you want to proceed with the checkout?</p> -->

        </div>
    </div>
</body>

<script>
    function handleShowModal() {
        const modal = document.getElementById('checkout-modal');
        modal.classList.add('active');
    }

    function handleCloseModal() {
        const modal = document.getElementById('checkout-modal');
        modal.classList.remove('active');
    }

    function handleConfirmCheckout(cartId, userId, isCartEmpty) {
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