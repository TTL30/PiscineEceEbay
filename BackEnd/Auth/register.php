<?php

require_once "../Config/config.php";
 
$email_err ='';

if(isset($_POST['Submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['confirm_password'];

    if(empty($email)){
        $email_err = "Please enter username.";

    }

    
}
