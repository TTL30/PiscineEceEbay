<?php

session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $email=$_SESSION["email"];
    $offre = $_POST['offre'];
    $idItem =$_POST['id_item'];
    $sql = "UPDATE enchere SET offre_actuelle = ?, email_acheteur_actuel = ? WHERE id_item = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("isi", $param_offre_actuelle,$param_email,$param_id_item);
        $param_offre_actuelle = $offre;
        $param_email = $email;
        $param_id_item = $idItem;
        if ($stmt->execute()) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);            exit();
        }



        $stmt->close();

    }

    $mysqli->close();
}
?>