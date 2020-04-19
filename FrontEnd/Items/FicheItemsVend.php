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
    <link href="FicheItems.css" rel="stylesheet" media="all" type="text/css">
    <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<?php
include '../../BackEnd/Items/getDataCurrentItem.php';
include '../../BackEnd/Vendor/deleteItems.php';
include '../../BackEnd/Acheteur/addItemPanier.php';
$url = $_SERVER['REQUEST_URI'];
$myUrl = explode("?", $url);
$monitem = explode("=", $myUrl[1])[1];
$monvendor = explode("=", $myUrl[2])[1];

$infoItem = getDataCurrentItem($monitem, $monvendor);
if ($monvendor == $_SESSION['email']) {
    $showBut = 'block';
    $showButAddPanier = 'none';
} else {
    $showBut = 'none';
    $showButAddPanier = 'block';
}

if (isset($_POST['delete'])) {
    deleteItems($infoItem[0]);
}
if (isset($_POST['add'])) {

    addItemPanier($infoItem[0]);
}



if ($_SESSION['type'] === 3) {
    $home = 'HomeAcheteur.php';
    $profil = 'ProfilGene.php';
} else if ($_SESSION['type'] === 2) {
    $home = 'HomeVendeur.php';
    $profil = 'ProfilVendeur.php';
}


?>


<script>
    var it = <?php echo json_encode($infoItem); ?>;
    console.log(it);
    if(it[3].localeCompare('Bon_pour_le_musee')==0){
        $(document).ready(function() {
                    $("#Cate").html("Bon pour le musée");
                });
    }
    if(it[3].localeCompare('Feraille_et_Tresor')==0){
        $(document).ready(function() {
                    $("#Cate").html("Férailles et Trésors");
                });
    }
    if(it[3].localeCompare('Accesoires_VIP')==0){
        $(document).ready(function() {
                    $("#Cate").html("Accesoires VIP");
                });
    }
    if(it[4].localeCompare('offre')==0){
        if(it[9].localeCompare('aucun')==0)
        {
            $(document).ready(function() {
                    $("#type").html("Négociation");
                });
        }
        else{
            $(document).ready(function() {
                    $("#type").html("Négociation/Achat");
                });
        }
    }
    if(it[4].localeCompare('immediat')==0){
        if(it[9].localeCompare('aucun')==0)
        {
            $(document).ready(function() {
                    $("#type").html("Achat");
                });
        }
        else{
            $(document).ready(function() {
                    $("#type").html("Négociation/Achat");
                });
        }
    }
    if(it[4].localeCompare('enchere')==0){
       
            $(document).ready(function() {
                    $("#type").html("Enchère");
                });
        
    }

</script>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey;background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
        <a class="navbar-brand" href="../HomePage/<?php echo $home ?>" style="width:170px;text-align:center"> <img src="logo.png" alt="" width="65" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <nav class="nav">
            <a id="lien" class="nav-link" href="../Panier/itemVenduVendor.php">Ventes</a>
            <a id="lien" class="nav-link" href="../Panier/negociation.php">Offres</a>
            </nav>
            <div class="container">
                <div class="logo dropleft">
                    <button class="btn btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="background-color:#f1404b">

                        <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z" />
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd" />
                            </svg></a>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" style="text-align:center">
                        <a class="dropdown-item" href="../Profils/<?php echo $profil ?>">Mon profil</a>
                        <div class="dropdown-divider"></div>
                        <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                    </div>
                </div>

            </div>
        </div>
    </nav>


    <div id="conteneur">
        <div id="wrapper">
            <div class="row" id="Produit">
                <div class="col-sm-4" id="photo">
                    <span class="helper"></span> <img id="img" src="../../BackEnd/IMG/ITEM/<?php echo $infoItem[6] ?>">
                </div>
                <div class="col-sm-8" id="info">
                    <div id="test" style="color:whitesmoke;text-align: center">
                        <h1 style="text-align: center;max-width:500px;margin:auto"><?php echo $infoItem[1] ?></h1>
                        <div class="container" style="height:90%">
                            <div class="row">
                                <div class="col-sm-12" style="text-align:left;margin-top:5%">
                                <h4 style="max-width:150px;background-color:#083386;border-radius:5px;padding:10px;color:white">Description:</h4>

                                </div>
                                <div class="col-sm-11" style="background-color:whitesmoke;text-align:left;margin:auto;margin-top:1%;border-radius:20px">
                                    <div style="height:30%;width:90%;margin:auto;color:black">
                                        <p><?php echo $infoItem[2] ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-top:3%">
                                    <div class="row" >

                                        <div class="col-sm-6" >
                                        <h5 style="max-width:200px;margin:auto;background-color:#083386;border-radius:5px;padding:10px;color:white">Catégorie:</h5>

                                        </div>
                                        <div class="col-sm-6" >
                                            <h5 id="Cate" style="max-width:200px;margin:auto;background-color:#A4B4BE;border-radius:5px;padding:10px;color:white"><?php echo $infoItem[3] ?></h5>

                                        </div>
                                        <div class="col-sm-6" style="margin-top:3%">
                                        <h5 style="max-width:200px;margin:auto;background-color:#083386;border-radius:5px;padding:10px;color:white">Type d'achat:</h5>

                                        </div>
                                        <div class="col-sm-6" style="margin-top:3%">
                                            <h5 id="type" style="background-color:#98BBDA;border-radius:5px;padding:10px;color:white;max-width:200px;margin:auto"><?php echo $infoItem[4] ?></h5>

                                        </div>
                                        <div class="col-sm-6" style="margin-top:3%">
                                        <h5 style="max-width:200px;margin:auto;background-color:#083386;border-radius:5px;padding:10px;color:white">Email vendeur:</h5>

                                        </div>
                                        <div class="col-sm-6" style="margin-top:3%">
                                        <h5 style="background-color:#F35C56;border-radius:5px;padding:10px;color:white;max-width:200px;margin:auto"><?php echo $infoItem[7] ?></h5>

                                        </div>
                                       
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="margin-top:3%">
                            <div class="col-sm-6" >
                                            <h4 style="background-color:#3EC10C;border-radius:5px;padding:10px;color:white;max-width:200px;margin:auto">Prix initial : <strong style="color: #C13B0C"><?php echo $infoItem[5] ?>€</strong></h4>

                                        </div>
            
                                        <div class="col-sm-6" >
                                            <form method="post">
                                            <button type="submit" class="btn btn-outline-warning" name="add" value="add" style="padding:10px;max-width:200px;margin:auto;display : <?php echo $showButAddPanier ?>">Ajouter au panier</button>
                                            <button type="submit" class="btn btn-danger" style="display: <?php echo $showBut ?>;padding:10px;max-width:200px;margin:auto" name="delete" value="delete">Supprimer</button>
                                        </form>

                                        </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier votre article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="was-validated">
                            <table class="tabModal" cellpadding=10>
                                <tr>
                                    <td>Nom du produit </td>
                                    <td><input type="text" class="form-control" style="background-color:whitesmoke;border:0" required=""></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><input type="text" class="form-control" maxlength="465" style="background-color:whitesmoke;border:0" required=""></td>
                                </tr>
                                <tr>
                                    <td>Prix </td>
                                    <td>
                                        <div class="input-group-text">
                                            <input type="Number" class="form-control" style="background-color:whitesmoke;border:0;" required="">
                                            <div class="€">
                                                <span>€</span>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"> Annuler</button>
                        <button type="submit" class="btn btn-outline-success" onClick="alert('Salut')"> Enregistrer les modifications</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3" id="pied">
        <div class="container" style="text-align:center">
            <span class="text-muted">Nous contacter <a href="#"> eceebay@sav.fr </a></span>
        </div>
        <div class="container" style="text-align:center">
            <span class="text-muted"><a href="#"> Besoin d'aide ?</a></span>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    </body>

</html>