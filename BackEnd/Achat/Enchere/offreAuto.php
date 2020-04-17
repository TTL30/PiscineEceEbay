<?php

session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $email=$_SESSION["email"];
    $offre = $_POST['offre'];
    $idItem =$_POST['id_item'];
    $sql = "SELECT solde FROM acheteur WHERE email = ?";
    if ($mystmt = $mysqli->prepare($sql)) {
        $mystmt->bind_param("s",$param_email);
        $param_email = $email;
        if ($mystmt->execute()) {
            $result = mysqli_stmt_get_result($mystmt);
            $row = mysqli_fetch_row($result);
            $diff=$row[0] - $offre;
            if($diff<0){
                $json =  @json_encode("negatif");
                print "<script>console.log($json);</script>";
                header("Location: {$_SERVER['HTTP_REFERER']}?");
                exit();
            }else{
                $sql = "SELECT offre_auto, email_acheteur_offre_auto FROM enchere WHERE id_item = ?";
                if ($ouimonst = $mysqli->prepare($sql)) {
                    $ouimonst->bind_param("i",$param_id_item);
                    $param_id_item = $idItem;
                    if ($ouimonst->execute()) {
                        $result = mysqli_stmt_get_result($ouimonst);
                        $lerow = mysqli_fetch_row($result);
                        if($lerow[0]>$offre){
                            $json =  @json_encode("MIEUX DEJA better");
                             print "<script>console.log($json);</script>";
                             header("Location: {$_SERVER['HTTP_REFERER']}???");                
                             exit();
                        }
                        else{
                            $sql = "SELECT offre_actuelle, email_acheteur_actuel FROM enchere WHERE id_item = ?";
                        if ($unstat = $mysqli->prepare($sql)) {
                            $unstat->bind_param("i",$param_id_item);
                            $param_id_item = $idItem;
                            if ($unstat->execute()) {
                                $result = mysqli_stmt_get_result($unstat);
                                $row = mysqli_fetch_row($result);
                                if($email === $row[1]){
                                    $json =  @json_encode("already better");
                                     print "<script>console.log($json);</script>";
                                     header("Location: {$_SERVER['HTTP_REFERER']}????");                
                                     exit();
                                }else{
                                    $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                                    if ($lestmt = $mysqli->prepare($sql)) {
                                        $lestmt->bind_param("is",$param_solde,$param_email);
                                        $param_email = $email;
                                        $param_solde = $diff;
                                        if ($lestmt->execute()) {
                                            $sql = "SELECT solde FROM acheteur WHERE email = ?";
                                    if ($noustat = $mysqli->prepare($sql)) {
                                        $noustat->bind_param("s",$param_email);
                                        $param_email = $row[1];
                                        if ($noustat->execute()) {
                                            $result = mysqli_stmt_get_result($noustat);
                                            $lesolde = mysqli_fetch_row($result);
                                            $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                                            if ($encorestat = $mysqli->prepare($sql)) {
                                                $encorestat->bind_param("is",$param_solde,$param_email);
                                                if(strcmp($row[1],$lerow[1])===0){
                                                    $param_solde = $lesolde[0] + $lerow[0];
                                                }else{
                                                    $param_solde = $lesolde[0] + $row[0];
                                                }
                                                $param_email = $row[1];
                                                if ($encorestat->execute()) {
                                                    $sql = "UPDATE enchere SET offre_actuelle = ?, email_acheteur_actuel = ?,offre_auto = ?, email_acheteur_offre_auto = ? WHERE id_item = ?";
                                                    if ($ouistmt = $mysqli->prepare($sql)) {
                                                        $ouistmt->bind_param("isisi", $param_offre_actuelle,$param_email,$param_offre_auto,$param_email_auto,$param_id_item);
                                                        $param_offre_actuelle = $row[0]+1;
                                                        $param_email = $email;
                                                        $param_offre_auto = $offre;
                                                        $param_email_auto = $email;
                                                        $param_id_item = $idItem;
                                                        if ($ouistmt->execute()) {
                                                            header('Location: ' . $_SERVER['HTTP_REFERER']);            exit();
                                                        }
                                                        $ouistmt->close();
                                                
                                                    }
                                                }

                                    }
                                    $encorestat->close();
                                        }


                                    }
                                    $noustat->close(); 
                                            
                                        }
                                    }
                                    $lestmt -> close();                                    
                                }
                            }

                        }
                        $unstat->close();

                        }
                    }



                }
                $ouimonst->close();


                        
            }
        }
        $mystmt->close();

    }
    $mysqli->close();
}


?>