<?php
// Start the session
include('config.php');
date_default_timezone_set("Asia/Calcutta");
session_start();
$date=date("j F y, h:i:s A");
$username=$_SESSION['username'];
$status='offline .'.$date;
$sql="UPDATE users SET status='$status' WHERE username='$username'";
mysqli_query($conn,$sql);
// Remove session variables
$_SESSION = array();

// Remove session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Prevent session fixation attacks
session_regenerate_id(true);

// Redirect to login page
header("Location:./");
exit;
?>

