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
                        $sql = "SELECT offre_actuelle, email_acheteur_actuel,offre_auto,email_acheteur_offre_auto FROM enchere WHERE id_item = ?";
                        if ($unstat = $mysqli->prepare($sql)) {
                            $unstat->bind_param("i",$param_id_item);
                            $param_id_item = $idItem;
                            if ($unstat->execute()) {
                                $result = mysqli_stmt_get_result($unstat);
                                $row = mysqli_fetch_row($result);
                                if($email === $row[1]){
                                    $json =  @json_encode("already better");
                                     print "<script>console.log($json);</script>";
                                     header("Location: {$_SERVER['HTTP_REFERER']}??");                
                                     exit();  
                                }
                                else if($offre<$row[2]){
                                    $sql = "UPDATE enchere SET offre_actuelle = ? WHERE id_item = ?";
                                    if ($encorestmt = $mysqli->prepare($sql)) {
                                        $encorestmt->bind_param("ii", $param_offre_actuelle,$param_id_item);
                                        $param_offre_actuelle = $offre+1;
                                        $param_id_item = $idItem;
                                        if ($encorestmt->execute()) {
                                            $json =  @json_encode("INF");
                                     print "<script>console.log($json);</script>";
                                            header('Location: ' . $_SERVER['HTTP_REFERER']);            exit();
                                        }
                                        $encorestmt->close();
                                
                                    }

                                }
                                
                                else if(($offre>$row[2])){
                                    $json =  @json_encode("betterthan auto");
                                     print "<script>console.log($json);</script>";
                                    $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                                    if ($lestmt = $mysqli->prepare($sql)) {
                                        $lestmt->bind_param("is",$param_solde,$param_email);
                                        $param_email = $email;
                                        $param_solde = $diff;
                                        if ($lestmt->execute()) {
                                            $json =  @json_encode("betterthan auto 1");
                                            print "<script>console.log($json);</script>";
                                            $sql = "SELECT solde FROM acheteur WHERE email = ?";
                                    if ($noustat = $mysqli->prepare($sql)) {
                                        $noustat->bind_param("s",$param_email);
                                        $param_email = $row[1];
                                        if ($noustat->execute()) {
                                            $json =  @json_encode("betterthan auto 2");
                                            print "<script>console.log($json);</script>";
                                            $result = mysqli_stmt_get_result($noustat);
                                            $lesolde = mysqli_fetch_row($result);
                                            $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                                            if ($encorestat = $mysqli->prepare($sql)) {
                                                $encorestat->bind_param("is",$param_solde,$param_email);
                                                if(strcmp($row[1],$row[3])===0){
                                                    $json =  @json_encode("betterthan auto 3");
                                                    print "<script>console.log($json);</script>";
                                                    $param_solde = $lesolde[0] + $row[2];
                                                }else{
                                                    $param_solde = $lesolde[0] + $row[0];

                                                }
                                                $param_email = $row[1];
                                                if ($encorestat->execute()) {
                                                    $json =  @json_encode("betterthan auto 4");
                                                    print "<script>console.log($json);</script>";
                                                    $sql = "UPDATE enchere SET offre_actuelle = ?, email_acheteur_actuel = ? WHERE id_item = ?";
                                                    if ($ouistmt = $mysqli->prepare($sql)) {
                                                        $ouistmt->bind_param("isi", $param_offre_actuelle,$param_email,$param_id_item);
                                                        $param_offre_actuelle = $offre;
                                                        $param_email = $email;
                                                        $param_id_item = $idItem;
                                                        if ($ouistmt->execute()) {
                                                            $json =  @json_encode("OUI");
                                     print "<script>console.log($json);</script>";
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
        $mystmt->close();

    }
    $mysqli->close();
}


?>