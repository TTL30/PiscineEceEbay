<?php
session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email=$_SESSION["email"];
    $prix = $_POST['prix'];
    $idItem =$_POST['id_item'];
    $sql = "SELECT solde FROM acheteur WHERE email = ?";
    if ($mystmt = $mysqli->prepare($sql)) {
        $mystmt->bind_param("s",$param_email);
        $param_email = $email;
        if ($mystmt->execute()) {
            $result = mysqli_stmt_get_result($mystmt);
            $row = mysqli_fetch_row($result);
            $diff=$row[0] - $prix;
            if($diff<0){
                $json =  @json_encode("negatif");
                print "<script>console.log($json);</script>";
                header("Location: {$_SERVER['HTTP_REFERER']}?");
                exit();
            }else{
                $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                if ($lestmt = $mysqli->prepare($sql)) {
                    $lestmt->bind_param("is",$param_solde,$param_email);
                    $param_email = $email;
                    $param_solde = $diff;
                    if ($lestmt->execute()) {
                        $sql = "SELECT * FROM immediat WHERE id_item=?";
                        if ($ostmt = $mysqli->prepare($sql)) {
                            $ostmt->bind_param("i",$param_item);
                            $param_item =$idItem;
                            if ($ostmt->execute()) {
                                $result = mysqli_stmt_get_result($ostmt);
                                $myrow = mysqli_fetch_row($result);
                                $sql = "INSERT INTO vente (id_item,title, email_vendor,typeAchat,prix_final,email_acheteur_final) VALUES (?,?, ?, ?, ?, ?)";
                                if ($encorestmt = $db->prepare($sql)) {
                                    $encorestmt->bind_param("isssis",$param_id_item,$param_title,$param_email_vendor,$param_typeAchat,$param_prix,$param_email_acheteur);
                                    $param_id_item = $myrow[1];
                                    $param_title = $myrow[2];
                                    $param_email_vendor = $myrow[3];
                                    $param_typeAchat = $myrow[4];
                                    $param_prix = $myrow[5];
                                    $param_email_acheteur = $email;
                                    if ($encorestmt->execute()) {
                                        $sql = "DELETE FROM items WHERE title = ? AND email_vendor = ?";
                                if($ailestmt = $db->prepare($sql)){
                                    $ailestmt->bind_param("ss", $param_title,$param_email_vendor);
                                    $param_title = $myrow[2];
                                    $param_email_vendor = $myrow[3];
                                    if($ailestmt->execute()){
                                        $sql = "DELETE FROM immediat WHERE id_item = ?";
                                        if($mstmt = $db->prepare($sql)){
                                            $mstmt->bind_param("i", $param_id_item);
                                            $param_id_item = $myrow[1];
                            if($mstmt->execute()){
                                $sql = "DELETE FROM nego WHERE id_item = ?";
                                        if($dz = $db->prepare($sql)){
                                            $dz->bind_param("i", $param_id_item);
                                            $param_id_item = $myrow[1];
                            if($dz->execute()){
                            }
                            $dz->close();
                        }
                    header("Location: ../../../FrontEnd/Panier/mesAchats.php");
                    exit();
                }
                            
                            $mstmt->close();
                        }
                    header("Location: ../../../FrontEnd/Panier/mesAchats.php");
                    exit();
                }
                $ailestmt->close();
            }

                                    }
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

   
    $db->close();
}


?>