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
    deleteItems($infoItem[1], $infoItem[7]);
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

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background-color: whitesmoke;">
        <a class="navbar-brand" href="../HomePage/<?php echo $home ?>"> <img src="logo.png" alt="" width="60" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="container">
                      <div class="logo dropleft">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" >

                            <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                                </svg></a>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu" style="text-align:center">
                            <a class="dropdown-item" href="../Panier/panierAcheteur.php" style = "display : <?php echo $showButAddPanier ?>">Mon panier</a>
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
                    <span class="helper"></span> <img id="img" src="../../BackEnd/IMG/<?php echo $infoItem[1] ?>">
                </div>
                <div class="col-sm-8" id="info">
                    <div id="test">
                        <h1 style="text-align: center;"><?php echo $infoItem[1] ?></h1>
                        <div class="row" id="descript">
                            <div class="col-sm-3" id="madesc">
                                <h2><span class="badge badge-secondary">Description:</span></h2>
                            </div>
                            <div class="col-sm-9" id="text">
                                <p><?php echo $infoItem[2] ?></p>
                            </div>
                            <div class="col-sm-4" id="madesc" style="margin-top:-5%">
                                <h4><span class="badge badge-secondary">Categorie:</span></h4>
                                <p><?php echo $infoItem[3] ?></p>
                            </div>
                            <div class="col-sm-4" id="madesc" style="margin-top:-5%">
                                <h4><span class="badge badge-secondary">Vendeur:</span></h4>
                                <p><?php echo $infoItem[7] ?></p>
                            </div>
                            <div class="col-sm-4" id="madesc" style="margin-top:-5%">
                                <h4><span class="badge badge-secondary">Type d'achat:</span></h4>
                                <p><?php echo $infoItem[4] ?></p>
                            </div>
                            <div class="col-sm-12" style="height:10%;text-align:center">
                                <h2><span class="badge badge-success"><?php echo $infoItem[5] ?>€</h2>
                                <form method="post">
                                    <button type="submit" class="btn btn-outline-warning my-2 my-sm-0" name="add" value="add" style="float:right;float:bottom; display : <?php echo $showButAddPanier ?>">Ajouter au panier</button>
                                    <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="display: <?php echo $showBut ?>;float:right;float:bottom;margin-right:1%" disabled>Modifier</button>
                                    <button type="submit" class="btn btn-danger" style="display: <?php echo $showBut ?>;float:right;float:bottom;margin-right:1%" name="delete" value="delete">Supprimer</button>
                                </form>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>