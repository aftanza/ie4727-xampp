<?php require('global/persist/account_persist.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/global/styles.css">
    <link rel="stylesheet" href="/global/header/styles.css">
    <link rel="stylesheet" href="/global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>

<?php

function checkIsLoggedIn()
{

    $isLoggedIn = false;

    if (isset($_SESSION['username'])) {
        $isLoggedIn = true;
    }
    return $isLoggedIn;
}


?>

<body class="profile-page">
    <?php include('global/header/index.php'); ?>
    <?php $isLoggedIn = checkIsLoggedIn(); ?>
    <div class="profile-content">
        <div class="button-card Card">
            <?php if ($isLoggedIn === false): ?>
                <div class="Button" onclick="handleButton('signup')">Sign-up</div>
                <div class="Button" onclick="handleButton('login')">Login</div>
            <?php else: ?>
                <div class="Button" onclick="handleButton('order_history')">Order History</div>
                <div class="Button" onclick="handleButton('logout')">Logout</div>
            <?php endif; ?>
        </div>
    </div>
    <?php include('global/footer/index.php'); ?>
</body>

<script>
    function handleButton(type) {
        if (type == 'signup') {
            window.location.href = window.location.origin + "/profile/sign_up/";
        } else if (type == 'login') {
            window.location.href = window.location.origin + "/profile/login/";
        } else if (type == 'logout') {
            window.location.href = window.location.origin + "/profile/components/handle_log_out.php";
        } else if (type == 'order_history') {
            window.location.href = window.location.origin + "/profile/order_history/";
        }
    }
</script>

</html>