<?php
session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email=$_SESSION["email"];
    $prix = $_POST['offreVendeur'];
    $idItem =$_POST['id_item'];
    $acheteur =$_POST['email_acheteur'];

    $sql = "SELECT * FROM nego WHERE id_item = ? AND email_acheteur = ?";
    if ($mystmt = $mysqli->prepare($sql)) {
        $mystmt->bind_param("is",$param_item,$param_email_acheteur);
        $param_item = $idItem;
        $param_email_acheteur = $acheteur;
        if ($mystmt->execute()) {
            $result = mysqli_stmt_get_result($mystmt);
            $row = mysqli_fetch_row($result);

            $sql = "SELECT solde FROM acheteur WHERE email = ?";
            if ($mt = $mysqli->prepare($sql)) {
                $mt->bind_param("s",$param_email_acheteur);
                $param_email_acheteur = $row[7];
                if ($mt->execute()) {
                    $result = mysqli_stmt_get_result($mt);
                    $lerow = mysqli_fetch_row($result);

                    $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                    if ($lestmt = $mysqli->prepare($sql)) {
                        $lestmt->bind_param("is",$param_solde,$param_email);
                        $param_email = $row[7];
                        $param_solde = $lerow[0]+$row[6];

                        if ($lestmt->execute()) {
                            $sql = "UPDATE nego SET offre_vendeur = ?, last_offer = 0 WHERE id_item = ? AND email_acheteur = ?";
                            if ($encorestmt = $db->prepare($sql)) {
                                        $encorestmt->bind_param("iis",$param_offre,$param_id_item,$param_email_acheteur);
                                        $param_offre = $prix;
                                        $param_id_item =$idItem;
                                        $param_email_acheteur = $row[7];
                                        if ($encorestmt->execute()) {
                                           header("Location: {$_SERVER['HTTP_REFERER']}");
                                           exit();
                                    }
                                    $encorestmt -> close();
                                }
                    }
                    $lestmt->close();
                }

                }

            $mt->close();
            }
            else{
                echo $row[7];
            }
           
        }
        $mystmt->close();
    }else{
        echo"aille1";
    }
    
    $db->close();
} 


?>