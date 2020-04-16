<?php

require_once "../Config/config.php";
 

if(isset($_POST['Submit'])){

    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    $sql = "SELECT id  FROM users WHERE email = ?";
    if($stmt = $mysqli->prepare($sql)){

        $stmt->bind_param("s", $param_email);
        
        $param_email = $email;
        
        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows == 1){
                $email_err = "This username is already taken.";
                header("Location: ../../FrontEnd/Auth/inscription.php?register=email");
            }

        } else{
            echo "Erreur Systeme";
        }
        $stmt->close();
    }

    if(empty($email_err)){
        $sql = "INSERT INTO users (email, password,name,last_name,type) VALUES (?, ?, ?, ?, ?)";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("ssssi", $param_email, $param_password,$param_name,$param_last_name,$param_type);
            
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_name = $name;
            $param_last_name = $last_name;
            $param_type = $type;
            
            if($stmt->execute()){
                if($type == 2){
                    $msql = "INSERT INTO vendeur (email,photoProfil,photoCouverture) VALUES (?,'','')";
                    if($mstmt = $mysqli->prepare($msql)){
                        $mstmt->bind_param("s", $param_email);
                        $param_email = $email;
                        if($mstmt->execute()){
                            header("location: ../../FrontEnd/Auth/login.php");
                        }
                        else{
                            echo "Erros syst";
                        }
                        $mstmt->close();

                    }
                    else{
                        echo 'Erros Syste';
                    }
                }

                else if($type == 3){
                    $msql = "INSERT INTO acheteur (email, panier,addresse,ville,code_postal,carte,name_carte,num_carte,expi_carte,cvv,solde,activated) VALUES (?,'', '', '', '0', '', '', '', '2020-04-01', '0', '0', '0')";
                    if($mstmt = $mysqli->prepare($msql)){
                        $mstmt->bind_param("s", $param_email);
                        $param_email = $email;
                        if($mstmt->execute()){
                            header("location: ../../FrontEnd/Auth/login.php");
                            exit();
                        }
                        else{
                            echo "Erros syst";
                        }
                        $mstmt->close();

                    }
                    else{
                        echo 'Erros Syste';
                    }
                }

            } else{
                echo "Erreur Systeme";
            }

            $stmt->close();
        }
    }
    
    $mysqli->close();
}

    
?>
