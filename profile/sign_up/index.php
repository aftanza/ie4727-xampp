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

// TODO: fix this to use for loop
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
    <div class="sign-up-content">
        <div class="container">
            <h1>Sign Up</h1>
            <form class="Card" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <!-- TODO: Fix this to use for loop -->
                <label>Name:</label>

                <?php if ($error_name): ?>
                    <?php echo "<p class='error'>" . $error_name . "</p>" ?>
                <?php endif; ?>

                <?php if ($name): ?>
                    <?php echo "<input type='text' name='name' id='name' value=" . $name . ">" ?>
                <?php else: ?>
                    <input type="text" name="name" id="name" placeholder="Input name here">
                <?php endif; ?>

                <label>E-mail:</label>
                <?php if ($error_email): ?>
                    <?php echo "<p class='error'>" . $error_email . "</p>" ?>
                <?php endif; ?>

                <?php if ($email): ?>
                    <?php echo "<input type='email' name='email' id='email' value=" . $email . ">" ?>
                <?php else: ?>
                    <input type="email" name="email" id="email" placeholder="Input email here">
                <?php endif; ?>

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

                <label>Confirm Password:</label>
                <?php if ($error_confirm_password): ?>
                    <?php echo "<p class='error'>" . $error_confirm_password . "</p>" ?>
                <?php endif; ?>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Input password again here">

                <button onclick="handleSubmit()" name="submit" value="submit">Submit</button>
            </form>
        </div>

    </div>
    <?php include('../../global/footer/index.php'); ?>
</body>

</html>