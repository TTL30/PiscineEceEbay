<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../Auth/login.php");
    exit();
}
?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>EceBay</title>
    <link href="Admin.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>

</head>



<?php
include '../../BackEnd/Acheteur/getAllitems.php';
include '../../BackEnd/Items/trieItems.php';
include '../../BackEnd/Vendor/deleteItems.php';

?>

<?php
$url = $_SERVER['REQUEST_URI'];
$myUrl = explode("?", $url);
if (!empty($myUrl[1])) {
    $macategorie = explode("=", explode("&", parse_url($url)["query"])[0])[1];
    $monTypeAchat = explode("=", explode("&", parse_url($url)["query"])[1])[1];
    $itemsToSell = trieItems($macategorie, $monTypeAchat);
} else {
    $itemsToSell = getAllitems();
}

if (isset($_POST['delete'])) {
    deleteItems($_POST['delete']);
}
?>


<script type="text/javascript">
    var itemsToSell = <?php echo json_encode($itemsToSell); ?>;
    console.log(itemsToSell);
    insertItems = function() {
        var parent = document.getElementsByClassName("row list")[0];
        itemsToSell.forEach(function(e) {
            var col = document.createElement('div');
            col.className = 'col-sm-4';
            var title = document.createElement('p');
            title.className = 'titleItem';
            var span_text = document.createTextNode(e[0].title);
            title.appendChild(span_text);
            var img = document.createElement('img');
            img.setAttribute('src', '../../BackEnd/IMG/ITEM/' + e[0].img)
            var divImgTit = document.createElement('div');
            divImgTit.className = 'divImgTit';
            img.className = 'imgItem';
            var conta = document.createElement('div');
            var descri = document.createElement('span');
            descri.className = 'badge badge-success'
            var span_prix = document.createTextNode(e[0].prix + '€');
            var deleteItem = document.createElement('form');
            deleteItem.method='POST';
            var ButDelete = document.createElement('button');
            ButDelete.type='submit';
            ButDelete.style="float:right"
            ButDelete.className='btn btn-danger';
            ButDelete.name='delete';
            ButDelete.value=e[0].id
            ButDelete.innerHTML ="X";
            deleteItem.appendChild(ButDelete);

            descri.appendChild(span_prix);
            conta.className = 'conta';
            divImgTit.appendChild(img);
            conta.appendChild(deleteItem)

            conta.appendChild(title);
            conta.appendChild(divImgTit)
            conta.appendChild(descri)
            col.appendChild(conta)
            parent.appendChild(col);
        });
    }
    window.onload = insertItems
</script>


<body>
    <div class="container">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                               background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
            <a class="navbar-brand" href="HomeAdmin.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="btn-top" style="margin-left:6%">
                    <nav class="nav">
                        <a id="lien" class="nav-link active" href="AdminItems.php">Liste des items</a>
                        <a id="lien" class="nav-link" href="AdminAcheteurs.php">Liste des acheteurs</a>
                        <a id="lien" class="nav-link" href="AdminVendeurs.php">Liste des vendeurs</a>
                    </nav>
                </div>
                <div class="container">
                    <div class="logo dropleft">
                        <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="Wrapper-VM">
            <div class="vertical-menu">
                <a href="#" class="active"><strong style="color:white"> Objets en ventes</strong></a>
                <form>
                    <div class="Categorie">
                        <label style="color:white">Appliquer des filtres:</label>
                        <select style="min-width : 170px;margin-top:10%" name="categorie">
                            <option value="all" hidden> Catégorie </option>
                            <option value="Feraille_et_Tresor">Feraille et Trésor</option>
                            <option value="Bon_pour_le_musee">Bon pour le musée</option>
                            <option value="Accesoires_VIP">Accessoire VIP</option>
                        </select>
                    </div>
                    <div class="Achat">
                        <select style="min-width : 170px" name="Achat">
                            <option value="all" hidden> Achat </option>
                            <option value="enchere"> Enchère</option>
                            <option value="immediat">Achat immédiat</option>
                            <option value="offre">Meilleur offre</option>
                        </select>
                    </div>
                    <button type="submit" class="btn" style="margin-top:10%;background-color:rgba(241,149,155,0.8);color:white">Valider</button>
                </form>
            </div>
        </div>

    <div class="listItems">
        <div class="row list" style="margin-left:0%"></div>
        <div class="col-sm-4">
            <div style="height : 200px;text-align : center;border-radius: 5px;">
                <a data-toggle="modal" data-target="#ModalAjout">
                    <i class="fas fa-plus-square fa-7x"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalAjout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../BackEnd/Vendor/addItems.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Title">Intitulé:</label>
                                <input type="text" class="form-control" placeholder="Entrer l'intitulé de votre item" name="title" required="">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description:</label>
                                <textarea class="form-control" name="description" rows="1" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Categorie">Catégorie:</label>
                                <select class="form-control" name="categorie" required="">
                                    <option value="Feraille_et_Tresor">Feraille et Trésor</option>
                                    <option value="Bon_pour_le_musee">Bon pour le musée</option>
                                    <option value="Accesoires_VIP">Accessoire VIP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Type Achat">Type d'achat:</label>
                                <select class="form-control" name="typeAchat" required="" onchange="achat2()" id="achat1">
                                    <option value="immediat">Achat immédiat</option>
                                    <option value="offre">Meilleur offre</option>
                                    <option value="enchere">Enchère (24 heures)</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Type Achat 2">Type d'achat secondaire:</label>
                                <select class="form-control" name="typeAchat2" required="">
                                    <option value="aucun" >Aucun</option>
                                    <option value="immediat" id = "immed">Achat immédiat</option>
                                    <option value="offre" id = "offer">Meilleur offre</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="Price">Prix:</label>
                                <div class="input-group-text">
                                    <input type="number" class="form-control" name="prix" required="">
                                    <div class="€">
                                        <span>€</span>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Photo">Image:</label>
                                    <input type="file" class="form-control-file" name="img" required="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="Submit">Valider</button>
                            </div>
                        </form>
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