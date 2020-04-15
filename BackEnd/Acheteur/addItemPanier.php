<?php

    function addItemPanier($item){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $panierMaj = array();
        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT panier FROM acheteur WHERE email = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_row($result);
                $monPanier = explode(',',$row[0]);
                $test = array_search($item,$monPanier);
                if($test === false)
                {
                    $monPanier[]= (
                        $item
                );
                    $panierMaj = implode(',',$monPanier);
                    $sql = "UPDATE acheteur SET panier = ? WHERE email = ? ";
                    if($mystmt = $db->prepare($sql)){
                    $mystmt->bind_param("ss", $param_paniermaj,$param_email);
                        $param_paniermaj = $panierMaj;
                        $param_email = $email;
                        if($mystmt->execute()){
                            header("Location: ../../FrontEnd/HomePage/HomeAcheteur.php???");
                            exit();
                        }
                        $mystmt->close();
                    }
                }
                else{
                    header("Location: ../../FrontEnd/HomePage/HomeAcheteur.php??");
                    exit();
                }
                           
            }
            $stmt->close();
        }
            $db->close();
    }
?>