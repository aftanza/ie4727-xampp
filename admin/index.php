<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../global/styles.css">
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

    if (!($error_username && $error_password)) {
        $conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');

        if (!$conn) {
            echo 'Connection error: ' . mysqli_connect_error();
        }

        $sql = 'SELECT id, username FROM supervisors WHERE username = ' . encapsulateWithSingleQuotes($username) . ' AND password = ' . encapsulateWithSingleQuotes($password) . ";";
        $res = mysqli_query($conn, $sql);
        $res_string = mysqli_fetch_all($res, MYSQLI_ASSOC);
        mysqli_close($conn);
        // print_r($res_string);
        // echo '<br>';
        // echo $res_string[0]['id'];

        if (!$res_string) {
            $error_password = 'Password may be wrong';
            $error_username = 'Username may be wrong';
        } else {
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_user_id'] = $res_string[0]['id'];
            header('Location: ./home');
            exit();
        }
    }
}
function encapsulateWithSingleQuotes($str)
{
    return "'" . $str . "'";
}
?>

<body class="admin">
    <div class="admin-login-content">
        <div class="container">
            <h1>Login</h1>
            <form class="Card" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                <label>Username:</label>
                <?php if ($error_username): ?>
                    <?php echo "<p class='error'>" . $error_username . "</p>" ?>
                <?php endif; ?>
                <?php if ($username): ?>
                    <?php echo "<input type='username' name='username' id='username' value=" . $username . ">" ?>
                <?php else: ?>
                    <input type="username" name="username" id="username" placeholder="Input username here">
                <?php endif; ?>

                <label>Password:</label>
                <?php if ($error_password): ?>
                    <?php echo "<p class='error'>" . $error_password . "</p>" ?>
                <?php endif; ?>
                <input type="password" name="password" id="password" placeholder="Input password here">

                <button onclick="handleSubmit()" name="submit" value="submit">Submit</button>
            </form>
        </div>

    </div>

</body>

</html>