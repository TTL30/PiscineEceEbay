<?php

session_start();

require_once "../Config/config.php";


if (isset($_POST['Submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = "";

    if(strcmp($email,"admin@admin.fr")===0){
        header("Location: ../../FrontEnd/HomePage/admin.php");
        exit();
    }else{

   
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $param_email);
        $param_email = $email;

        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $email, $hashed_password);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        $mysql = "SELECT * FROM users where email = ?";
                        if ($mystmt = $mysqli->prepare($mysql)) {
                            $mystmt->bind_param("s", $parame_email);
                            $parame_email = $email;
                            if ($mystmt->execute()) {
                                $result = mysqli_stmt_get_result($mystmt);
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["email"] = $email;
                                $_SESSION["type"] = $row["type"];
                                if (mysqli_num_rows($result) == 1) {
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $_SESSION["type"] = $row["type"];
                                    if($row["type"] == 2)
                                    {
                                        header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
                                        exit();
                                    }
                                    else if($row["type"] == 3)
                                    {
                                        
                                        header("Location: ../../FrontEnd/HomePage/HomeAcheteur.php");
                                        exit();
                                    }
                                }
                            }
                        }
                        $mystmt->close();
                    } else {
                        header("Location: ../../FrontEnd/Auth/login.php?login=email/pass");
                    }
                }
            } else {
                header("Location: ../../FrontEnd/Auth/login.php?login=email/pass");
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

}
    // Close connection
    $mysqli->close();
}
