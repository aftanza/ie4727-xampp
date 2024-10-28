<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$total = 0;
$isLoggedIn = false;

$admin_username = $_SESSION['admin_username'];
$admin_user_id = $_SESSION['admin_user_id'];

$conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');

$orders = [];

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

if (isset($_POST['submit'])) {
    $placed_order_id = $_POST['input'];
    $orders = getOrder($conn, $placed_order_id);
    print_r($orders);
}

mysqli_close($conn);

?>

<?php
function getOrder($conn, $placed_order_id)
{
    if ($placed_order_id) {
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

        return $placed_cart_items;
    }
}

function addToTotal($subtotal)
{
    global $total;
    $total = $total + $subtotal;
}

$total = number_format($total, 2);
?>

<body>
    This is a test page
    <form action="." method="POST">
        <label for="input">hellos</label>
        <input type="text" id="input" name="input">
        <button name="submit" value="submit">Submit</button>
    </form>

    <div class="order-content Content">
        <div class="Card--grid order-item">
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
        <?php foreach ($orders as $index => $order): ?>
            <div class="Card--grid order-item">
                <div>
                    <?php echo $index + 1 ?>
                </div>
                <div class="cart-item-image">   
                    <p><?php echo $order['img_url'] ?></p>
                </div>

                <div class="cart-item-name">
                    <?php echo $order['name'] ?>
                </div>

                <div>
                    <?php echo $order['price'] ?>
                </div>

                <div>
                    <?php echo $order['quantity'] ?>
                </div>
                <div>
                    <?php echo $order['subtotal'] ?>
                </div>
            </div>
        <?php endforeach; ?>

</body>

<script>
    // const handleSubmit = (component, event) => {
    //     event.preventDefault();

    //     let url = new URL(window.location.href);

    //     let placed_order_id = document.getElementById("input").value
    //     url.searchParams.set('placed_order_id', placed_order_id);

    //     window.location.href = url
    // }
</script>

</html>