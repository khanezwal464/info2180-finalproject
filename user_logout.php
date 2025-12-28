<?php
session_start();

//Terminating session
session_unset();
session_destroy();

//Redirecting to login page
header("Location: user_login.php");
exit;

?>