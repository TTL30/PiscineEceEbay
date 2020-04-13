<?php
session_start();
$_SESSION = array();
session_destroy();
 header("location: ../../FrontEnd/Auth/login.php");
exit;
?>