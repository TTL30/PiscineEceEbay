<?php
session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email=$_SESSION["email"];
    $prix = $_POST['offreAcheteur'];
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
                        $sql = "SELECT * FROM nego WHERE id_item=? AND email_acheteur = ?";
                        if ($ostmt = $mysqli->prepare($sql)) {
                            $ostmt->bind_param("is",$param_item,$param_email);
                            $param_item =$idItem;
                            $param_email = $email;
                            if ($ostmt->execute()) {
                                $result = mysqli_stmt_get_result($ostmt);
                                $myrow = mysqli_fetch_row($result);
                                if(empty($myrow)){
                                    $sql = "SELECT * FROM items WHERE id= ?";
                                    if($azstmt = $mysqli->prepare($sql)){
                                        $azstmt->bind_param("i", $param_id_item);
                                        $param_id_item =$idItem;
                                        if($azstmt->execute()){
                                            $result = mysqli_stmt_get_result($azstmt);
                                            $encorerow = mysqli_fetch_row($result);
                                            $sql = "INSERT INTO nego (id_item,title,email_vendor,typeAchat,offre_vendeur,offre_acheteur,email_acheteur,last_offer,nb) VALUES (?,?, ?, ?, ?,?,?,1,1)";
                            if($aestmt = $mysqli->prepare($sql)){
                                $aestmt->bind_param("isssiis", $param_id_item,$param_title, $param_email_vendor,$param_type_achat,$param_offre_vendeur,$param_offre_acheteur,$param_email_acheteur);
                                $param_id_item = $idItem;
                                $param_title= $encorerow[1];
                                $param_email_vendor = $encorerow[7];
                                $param_type_achat = $encorerow[4];
                                $param_offre_vendeur =$encorerow[5];
                                $param_offre_acheteur = $prix;
                                $param_email_acheteur = $email;
                                if($aestmt->execute()){
                                    $json =  @json_encode("add to nego");
                                    print "<script>console.log($json);</script>";
                                    header("Location: {$_SERVER['HTTP_REFERER']}");
                                        exit();
                                }
                                else{
                                    $json =  @json_encode("not add to nego");
                                    print "<script>console.log($json);</script>";
                                }
    
                                $aestmt->close();
    
                            }
                                        }
                                        $azstmt->close();
                                    }

                                }else{
                                $sql = "UPDATE nego SET offre_acheteur = ?, email_acheteur = ?, last_offer = 1, nb = ? WHERE id_item = ? AND email_acheteur = ?";
                                if ($encorestmt = $db->prepare($sql)) {
                                    $encorestmt->bind_param("isiis",$param_offre,$param_email_acheteur,$param_nb,$param_id_item,$param_email_acheteur);
                                    $param_id_item = $myrow[1];
                                    $param_offre = $prix;
                                    $param_email_acheteur = $email;
                                    $param_nb =$myrow[9]+1;
                                    $param_id_item =$idItem;
                                    $param_email_acheteur = $email;
                                    if ($encorestmt->execute()) {
                                        header("Location: {$_SERVER['HTTP_REFERER']}");
                                        exit();
                                }
                                $encorestmt -> close();
                            }
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
}


?>