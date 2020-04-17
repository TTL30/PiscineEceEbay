<?php
/* session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email=$_SESSION["email"];
    $prix = $_POST['offreVendeur'];
    $idItem =$_POST['id_item'];
    $sql = "SELECT * FROM nego WHERE id_item = ?";
    if ($mystmt = $mysqli->prepare($sql)) {
        $mystmt->bind_param("i",$param_item);
        $param_item = $idItem;
        if ($mystmt->execute()) {
            $result = mysqli_stmt_get_result($mystmt);
            $row = mysqli_fetch_row($result);
            
            $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                if ($lestmt = $mysqli->prepare($sql)) {
                    $lestmt->bind_param("is",$param_solde,$param_email);
                    $param_email = $email;
                    $param_solde = $diff;
                    if ($lestmt->execute()) {
                        $sql = "SELECT * FROM nego WHERE id_item=?";
                        if ($ostmt = $mysqli->prepare($sql)) {
                            $ostmt->bind_param("i",$param_item);
                            $param_item =$idItem;
                            if ($ostmt->execute()) {
                                $result = mysqli_stmt_get_result($ostmt);
                                $myrow = mysqli_fetch_row($result);
                                $sql = "UPDATE nego SET offre_acheteur = ?, email_acheteur = ?, last_offer = 1, nb = ? WHERE id_item = ?";
                                if ($encorestmt = $db->prepare($sql)) {
                                    $encorestmt->bind_param("isii",$param_offre,$param_email_acheteur,$param_nb,$param_id_item);
                                    $param_id_item = $myrow[1];
                                    $param_offre = $prix;
                                    $param_email_acheteur = $email;
                                    $param_nb =$myrow[9]+1;
                                    $param_id_item =$idItem;
                                    if ($encorestmt->execute()) {
                                        header("Location: {$_SERVER['HTTP_REFERER']}");
                                        exit();
                                }
                                $encorestmt -> close();
                            }

                        }
                        $ostmt->close();
                    }
                }
                $lestmt->close();
            }
        }
        $mystmt->close();
    }
    }

   
    $db->close();
} */


?>