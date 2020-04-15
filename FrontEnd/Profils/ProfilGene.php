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
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background-color: whitesmoke;" >
            <a class="navbar-brand" href="../HomePage/HomeAcheteur.php">   <img  src="logo.png" alt="" width="60" height="30"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="logo">
                    <a href="ProfilGene.php"><svg class="profil" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                        </svg></a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row" id="Profil">
                <h1 class="Titre"> Votre profil </h1>
                <div class="col-sm-12" id="Pdp"> 
                    <img  src="TTL.jpg" width="100" height="100">
                </div>
                <div class="col" id="Info">
                    <form>
                        <fieldset disabled="disabled">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNom"> Nom </label>
                                    <input type="nom" class="form-control" id="inputNom">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPrenom">Prénom</label>
                                    <input type="Prenom" class="form-control" id="inputPrenom">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4"> Adresse Email</label>
                                    <input type="email" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Addresse</label>
                                <input type="text" class="form-control" id="inputAddress">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Ville</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Code postal</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="col-sm-12" id="boutons">
                        <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">Mes informations de paiement</button>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vos informations de paiement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 order-md-1">
                                    <h4 class="mb-3">Adresse de livraison</h4>
                                    <form class="needs-validation" novalidate="">

                                        <div class="mb-3">
                                            <label for="address">Addresse</label>
                                            <input type="text" class="form-control" id="address" placeholder="37 Quai de Grenelle" required="">
                                            <div class="invalid-feedback">
                                                Champs obligatoire
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-5 mb-3">
                                                <label for="country">Pays</label>
                                                 <input type="text" class="form-control" id="pays" placeholder="..." required="">
                                                <div class="invalid-feedback">
                                                    Champs obligatoire
                                                </div>
                                            </div>
                                            <div class="col-md-5 mb-3">
                                                <label for="zip">Code postal</label>
                                                <input type="text" class="form-control" id="codepostal" placeholder="..." required="">
                                                <div class="invalid-feedback">
                                                   Champs obligatoire
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="same-address">
                                            <label class="custom-control-label" for="same-address">Mon adresse de livraison est la même que l'adresse de facturation</label>
                                        </div>
                                        <hr class="mb-4">
                                        <h4 class="mb-3">Informations bancaires</h4>

                                        <div class="d-block my-3">
                                            <div class="custom-control custom-radio">
                                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                                                <label class="custom-control-label" for="credit"> Visa </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                                                <label class="custom-control-label" for="debit">MasterCard</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                                                <label class="custom-control-label" for="paypal">PayPal</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-name">Titulaire de la carte</label>
                                                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                                <small class="text-muted">Nom et Prénom écrit sur la carte</small>
                                                <div class="invalid-feedback">
                                                    Champs obligatoire
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-number">Numéro de carte</label>
                                                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                                <div class="invalid-feedback">
                                                    Champs obligatoire
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-expiration">Date d'expiration</label>
                                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                                <div class="invalid-feedback">
                                                    Champs obligatoire
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="cc-cvv">CVV</label>
                                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                                <div class="invalid-feedback">
                                                    Champs obligatoire
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"> Annuler</button>
                            <button type="submit" class="btn btn-outline-success"> Enregistrer les modifications</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>