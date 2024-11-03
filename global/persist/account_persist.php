<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo 'persist implemented';
echo '<br>';
echo 'username: ' . $_SESSION['username'];
echo '<br>';
echo 'id: ' . $_SESSION['user_id'];
// echo '<br>';
// echo $_COOKIE['username'];
// echo '<br>';
// echo $_SESSION['log_out'];
// echo '<br>';

// Check logout first
if (isset($_SESSION['log_out']) && $_SESSION['log_out'] == 'true') {
    // session_unset();
    unset($_SESSION['log_out']);
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    setcookie("username", "", time() - 3600, '/');
    setcookie("user_id", "", time() - 3600, '/');
    // session_regenerate_id(true);

    // Need to add this header return because for some reason this escapes the if else and bleeds into the else, which reinstates the session and therefore the cookie
    // TODO: Learn why
    header('Location: .');
    exit();
} else {
    // Check username cookie
    if (isset($_COOKIE['user_id'])) {
        // set the session user to that
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        // else, if there is session username but no cookie, or when user just logged in
        if (isset($_SESSION['user_id'])) {
            // set cookie of user
            setcookie('username', $_SESSION['username'], time() + 300, '/');
            setcookie('user_id', $_SESSION['user_id'], time() + 300, '/');
        }
    }
}
