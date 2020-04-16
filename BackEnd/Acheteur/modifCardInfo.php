<?php

session_start();

require_once "../Config/config.php";


if (isset($_POST['submit'])) {
    $email=$_SESSION["email"];
    $carte = $_POST['carte'];
    $nameCarte = $_POST['nameCarte'];
    $numCarte = $_POST['numCarte'];
    $expiCarte = $_POST['expiCarte'];
    $cvv = $_POST['cvv'];
    $solde = $_POST['solde'];
    $sql = "UPDATE acheteur SET carte = ?, name_carte = ?, num_carte = ?, expi_carte = ?, cvv= ?, solde = ?,activated = ? WHERE email = ?";
    $json =  @json_encode(gettype($numCarte));
    print "<script>console.log($json);</script>";
    if ($stmt = $mysqli->prepare($sql)) {
        $json =  @json_encode("oui");
        print "<script>console.log($json);</script>";
        $stmt->bind_param("ssssiiis", $param_carte,$param_name_carte,$param_num_carte,$param_expi_carte,$param_cvv,$param_solde,$param_activated,$param_email);
        $param_email = $email;
        $param_carte = $carte;
        $param_name_carte = $nameCarte;
        $param_num_carte = $numCarte;
        $param_expi_carte = $expiCarte;
        $param_cvv = $cvv;
        $param_solde = $solde;
        $param_activated = 1;
        if ($stmt->execute()) {
            header("Location: ../../FrontEnd/HomePage/HomeAcheteur.php");
            exit();
        } else {
            $json =  @json_encode("aille");
            print "<script>console.log($json);</script>";
        }
        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
