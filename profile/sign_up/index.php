<?php require('global/php/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../../global/styles.css">
    <link rel="stylesheet" href="../../global/header/styles.css">
    <link rel="stylesheet" href="../../global/footer/styles.css">
    <?php include('global/font/font.php'); ?>
</head>

<?php
$error_name = '';
$error_email = '';
$error_username = '';
$error_password = '';
$error_confirm_password = '';

$name = '';
$username = '';
$email = '';
$password = '';
$confirm_password = '';

$regex_name = [
    'name' => [
        'description' => 'Only alphabets, hyphens, and periods in name',
        'regex' => '/^[a-zA-Z\s]+$/',
    ]
];

$regex_email = [
    'username' => [
        'description' => 'Only \w in username',
        'regex' => '/^[\w\-\.]+(?=@)/',
    ],
    'email' => [
        'description' => 'Invalid email domain',
        'regex' =>  '/(?<=@)([\w]+\.){1,3}[\w]{2,3}$/',
    ],
];

$regex_username = [
    'username' => [
        'description' => 'Only \w in username',
        'regex' => '/^[\w\s]+$/',
    ]
];

$regex_password = [
    'capital' => [
        'description' => 'Min 1 capital letter',
        'regex' => '/(?=.*[A-Z])/',
    ],
    'number' => [
        'description' => 'Min 1 number',
        'regex' => '/(?=.*\d)/',
    ],
    'length' => [
        'description' => 'Min 8 char in length',
        'regex' => '/^.{8,}$/',
    ],
    'valid_chars' => [
        'description' => 'Contains invalid char',
        'regex' => '/^[A-Za-z\d\W_]+$/',
    ]
    // 
];

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $error_name = 'Name is required';
    } else {
        $name = htmlspecialchars($_POST['name']);
        foreach ($regex_name as $regex) {
            if (!preg_match($regex['regex'], $name)) {
                $error_name = $error_name . $regex['description'] . ", ";
            }
        }
    }

    if (empty($_POST['email'])) {
        $error_email = 'Name is required';
    } else {
        $email = htmlspecialchars($_POST['email']);
        foreach ($regex_email as $regex) {
            if (!preg_match($regex['regex'], $email)) {
                $error_email = $error_email . $regex['description'] . ", ";
            }
        }
    }

    if (empty($_POST['username'])) {
        $error_username = 'Username is required';
    } else {
        $username = htmlspecialchars($_POST['username']);
        foreach ($regex_username as $regex) {
            if (!preg_match($regex['regex'], $username)) {
                $error_username = $error_username . $regex['description'] . ", ";
            }
        }
        if (!$error_username) {
            $conn = db_connect();

            $sql = 'SELECT username FROM users WHERE username = ' . encapsulateWithSingleQuotes($username) . ";";
            $res = mysqli_query($conn, $sql);
            $res_string = mysqli_fetch_all($res, MYSQLI_ASSOC);

            // print_r($res_string);

            if ($res_string) {
                $error_username = $error_username . "Username is taken" . ", ";
            }

            mysqli_free_result($res);
            mysqli_close($conn);
        }
    }
    if (empty($_POST['password'])) {
        $error_password = 'Password is required';
    } else {
        $password = htmlspecialchars($_POST['password']);
        foreach ($regex_password as $regex) {
            if (!preg_match($regex['regex'], $password)) {
                $error_password = $error_password . $regex['description'] . ", ";
            }
        }
    }

    if (empty($_POST['confirm-password'])) {
        $error_confirm_password = 'Password Confirmation is required';
    } else {
        $confirm_password = htmlspecialchars($_POST['confirm-password']);
        if ($password && ($confirm_password != $password)) {
            $error_confirm_password = 'Password does not match';
        }
    }

    if (!($error_email || $error_name || $error_confirm_password || $error_password || $error_username)) {
        $conn = db_connect();

        $sql = 'INSERT INTO users (name, username, email, password) VALUES ' . "(" . encapsulateWithSingleQuotes($name) . "," . encapsulateWithSingleQuotes($username) . "," . encapsulateWithSingleQuotes($email) . "," . encapsulateWithSingleQuotes($password) . ")";

        $res = mysqli_query($conn, $sql);
        if (!$res) {
            echo "Signup Query Error: " . mysqli_error($conn);
        };
        mysqli_close($conn);
        header('Location: ../index.php');
        exit();
    }
}

function encapsulateWithSingleQuotes($str)
{
    return "'" . $str . "'";
}
?>

<body class="sign-up-page">
    <?php include('../../global/header/index.php'); ?>
    <main class="sign-up-content">
        <div class="container">
            <h1>Sign Up</h1>
            <form class="Card sign-up-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <?php if ($error_name): ?>
                        <p class='error'><?php echo $error_name; ?></p>
                    <?php endif; ?>
                    <input type="text" class="Input Input--variant" name="name" id="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>">
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <?php if ($error_email): ?>
                        <p class='error'><?php echo $error_email; ?></p>
                    <?php endif; ?>
                    <input type="email" class="Input Input--variant" name="email" id="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <?php if ($error_username): ?>
                        <p class='error'><?php echo $error_username; ?></p>
                    <?php endif; ?>
                    <input type="text" class="Input Input--variant" name="username" id="username" placeholder="Choose a username" value="<?php echo htmlspecialchars($username); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <?php if ($error_password): ?>
                        <p class='error'><?php echo $error_password; ?></p>
                    <?php endif; ?>
                    <input type="password" class="Input Input--variant" name="password" id="password" placeholder="Create a password">
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <?php if ($error_confirm_password): ?>
                        <p class='error'><?php echo $error_confirm_password; ?></p>
                    <?php endif; ?>
                    <input type="password" class="Input Input--variant" name="confirm-password" id="confirm-password" placeholder="Confirm your password">
                </div>

                <div class="sign-up-button-container">
                    <button class="Button Button--secondary submit-btn" name="submit" value="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </main>
    <?php include('../../global/footer/index.php'); ?>
</body>

</html>