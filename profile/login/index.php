<?php require('global/php/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../../global/styles.css">
    <link rel="stylesheet" href="../../global/header/styles.css">
    <link rel="stylesheet" href="../../global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>

<?php
session_start();

$error_username = '';
$error_password = '';


// $name = '';
$username = '';

if (isset($_POST['submit'])) {

    if (empty($_POST['username'])) {
        $error_username = 'Username is required';
    } else {
        $username = htmlspecialchars($_POST['username']);
    }

    if (empty($_POST['password'])) {
        $error_password = 'Password is required';
    } else {
        $password = htmlspecialchars($_POST['password']);
    }

    if (!(empty($_POST['username']) || empty($_POST['password']))) {
        $conn = db_connect();

        // Check Username
        $sql = 'SELECT id, username FROM users WHERE username = ' . encapsulateWithSingleQuotes($username);
        $res = mysqli_query($conn, $sql);
        $username_exist_list = mysqli_fetch_all($res, MYSQLI_ASSOC);

        $sql = 'SELECT id, username FROM users WHERE username = ' . encapsulateWithSingleQuotes($username) . ' AND password = ' . encapsulateWithSingleQuotes($password) . ";";
        $res = mysqli_query($conn, $sql);
        $correct_credentials_list = mysqli_fetch_all($res, MYSQLI_ASSOC);


        if (!$username_exist_list) {
            $error_password = '';
            $error_username = 'User does not exist';
        } elseif (!$correct_credentials_list) {
            $error_password = 'Incorrect password';
            $error_username = '';
        } else {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $correct_credentials_list[0]['id'];
            mysqli_close($conn);
            header('Location: ../index.php');
            exit();
        }
    }
}

function encapsulateWithSingleQuotes($str)
{
    return "'" . $str . "'";
}
?>

<body class="login-page">
    <?php include('../../global/header/index.php'); ?>
    <div class="login-content">
        <div class="container">
            <h1>Login</h1>
            <form class="Card login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <?php if ($error_username): ?>
                        <p class='error'><?php echo $error_username; ?></p>
                    <?php endif; ?>
                    <input type="text" class='Input Input--variant' name="username" id="username" placeholder="Enter your username" <?php echo $username ? "value=\"$username\"" : ""; ?>>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <?php if ($error_password): ?>
                        <p class='error'><?php echo $error_password; ?></p>
                    <?php endif; ?>
                    <input type="password" class='Input Input--variant' name="password" id="password" placeholder="Enter your password">
                </div>

                <div class="login-button-container">
                    <button class="Button Button--secondary" name="submit" value="submit">Login</button>
                </div>

            </form>
        </div>
    </div>
    <?php include('../../global/footer/index.php'); ?>
</body>

</html>