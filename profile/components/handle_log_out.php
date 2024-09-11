<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['log_out'] = 'true';

// Redirect back to the homepage or login page
header('Location: /profile/index.php');
exit();
