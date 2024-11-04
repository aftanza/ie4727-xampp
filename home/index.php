<?php require('global/persist/account_persist.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/global/styles.css">
    <link rel="stylesheet" href="/global/header/styles.css">
    <link rel="stylesheet" href="/global/footer/styles.css">

    <link rel="stylesheet" href="./component/deals-1/styles.css">
    <link rel="stylesheet" href="./component/banner-1/styles.css">
    <link rel="stylesheet" href="./component/content-1/styles.css">
    <link rel="stylesheet" href="./component/content-2/styles.css">

    <?php include('global/font/font.php'); ?>
</head>

<body class="home">
    <?php include('global/header/index.php'); ?> <!-- <h1>DEALS PLACEHOLDER</h1> -->

    <div class="Content home-content">
        <?php include('./component/content-1/index.php'); ?>
        <?php include('./component/deals-1/index.php'); ?>
        <?php include('./component/banner-1/index.php'); ?>
        <?php include('./component/content-2/index.php'); ?>

    </div>
    <?php include('global/footer/index.php'); ?>
</body>

</html>