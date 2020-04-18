<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../Auth/login.php");
    exit();
}
?>

<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>EceBay</title>
    <link href="profil.css" rel="stylesheet" media="all" type="text/css">
</head>

<?php
include '../../BackEnd/Acheteur/getDataAcheteur.php';
$mesData = getDataAcheteur();
$mesAddress = getAdresseAcheteur();
if ($mesAddress[2] === 0) {
    $codePost = "";
} else {
    $codePost = $mesAddress[2];
}
?>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
        <a class="navbar-brand" href="../HomePage/HomeVendeur.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container">
                <div class="logo dropleft">
                    <button class="btn btn-sm  dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="background-color:#f1404b">

                        <a href="ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z" />
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd" />
                            </svg></a>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" style="text-align:center">
                        <a class="dropdown-item" href="ProfilVendeur.php">Mon profil</a>
                        <div class="dropdown-divider"></div>
                        <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container" id="conteneur">
        <div class="row" id="Profil">
            <h1 class="Titre"> Votre profil </h1>
            <div class="col-sm-12" id="Pdp">
                <img src="TTL.jpg" width="100" height="100">
            </div>
            <div class="col" id="Info">
                <form>
                    <fieldset disabled="disabled">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNom"> Nom </label>
                                <input type="nom" class="form-control" id="inputNom" value="<?php echo $mesData[1] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPrenom">Prénom</label>
                                <input type="Prenom" class="form-control" id="inputPrenom" value="<?php echo $mesData[0] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> Adresse Email</label>
                                <input type="email" class="form-control" id="inputEmail4" value="<?php echo $_SESSION['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Addresse</label>
                            <input type="text" class="form-control" id="inputAddress" value="<?php echo $mesAddress[0] ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Ville</label>
                                <input type="text" class="form-control" id="inputCity" value="<?php echo $mesAddress[1] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Code postal</label>
                                <input type="text" class="form-control" id="inputZip" value="<?php echo $codePost ?>">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="col-sm-12" id="boutons">
                    <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalProfil">Modifier mon profil</button>
                    <button type="submit" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal" style="float:right">Mes informations de paiement</button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalProfil" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier votre profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../BackEnd/Acheteur/modifProfil.php" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 order-md-1">
                                    <h4 class="mb-3">Adresse de livraison</h4>
                                    <div class="mb-3">
                                        <label for="address">Addresse</label>
                                        <input type="text" class="form-control" id="address" placeholder="37 Quai de Grenelle" required="" name="addresse">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label for="country">Ville</label>
                                            <input type="text" class="form-control" id="ville" placeholder="..." required="" name="ville">
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="zip">Code postal</label>
                                            <input type="number" class="form-control" id="codepostal" placeholder="..." required="" name="code_postal">
                                        </div>
                                    </div>
                                    <hr class="mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="same-address" required="">
                                        <label class="custom-control-label" for="same-address">Mon adresse de livraison est la même que l'adresse de facturation</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-outline-success" name="submit"> Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vos informations de paiement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../BackEnd/Acheteur/modifCardInfo.php" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 order-md-1">
                                    <h4 class="mb-3">Informations bancaires</h4>
                                    <div class="d-block my-3">
                                        <select name="carte" required="">
                                            <option value="MasterCard">MasterCard</option>
                                            <option value="Visa">Visa</option>
                                            <option value="PayPal">PayPal</option>
                                        </select>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-name">Titulaire de la carte</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder="" name="nameCarte" required="">
                                            <small class="text-muted">Nom et Prénom écrit sur la carte</small>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-number">Numéro de carte</label>
                                            <input type="text" pattern="\d*" class="form-control" id="cc-number" placeholder="" required="" maxlength="16" minlength="16" name="numCarte">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-expiration">Date d'expiration</label>
                                            <input type="date" class="form-control" style="margin-left: 2%" required="" name="expiCarte">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-cvv">CVV</label>
                                            <input type="text" pattern="\d*" class="form-control" id="cc-cvv" placeholder="" required="" maxlength="3" minlength="3" name="cvv">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cc-cvv">Solde :</label>
                                            <input type="number" class="form-control" id="cc-cvv" placeholder="" required="" name="solde">
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required ="">
                                <label class="form-check-label" for="exampleCheck1">J'accepte etre sous contrat legal pour acheter un item si l'offre est accepter par le vendeur </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-outline-success" name="submit"> Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-2" id="pied">
        <div class="container" style="text-align:center">
            <span class="text-muted">Nous contacter <a href="#"> eceebay@sav.fr </a></span>
        </div>
        <div class="container" style="text-align:center">
            <span class="text-muted"><a href="#"> Besoin d'aide ?</a></span>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>