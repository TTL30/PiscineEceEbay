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
    include '../../BackEnd/Achat/Enchere/getDataEnchere.php';
    $url = $_SERVER['REQUEST_URI'];
    $myUrl = explode("?", $url);
    $monitem = explode("=", $myUrl[1])[1];
    $monvendor = explode("=", $myUrl[2])[1];
    $infoItem = getDataCurrentItem($monitem, $monvendor);
    $infoEnchere = getDataEnchere($monitem, $monvendor);
    $json =  @json_encode($infoItem);
    print "<script>console.log($json);</script>";
    $ench = "no";
    if(strcmp($infoItem[4],"enchere")===0){
        $display = 'yes';
        $prix = $infoEnchere["offre_actuelle"];
        $ench = "yes";
    }else{
        $display = 'none';
        $prix = $infoItem[5];
    }
    if(strcmp($infoItem[4],"immediat")===0){
        $displayImme = 'yes';
    }else{
        $displayImme = 'none';
    }
    if(strcmp($infoItem[4],"offre")===0){
        $displayNego = 'yes';
    }else{
        $displayNego = 'none';
    }
?>

<script>
    function CompteARebours() {
        var date_actuelle = new Date();
        var debutEnchere = <?php echo @json_encode($infoEnchere["debut"])?> ;
        var finEnchere = <?php echo @json_encode($infoEnchere["fin"])?> ;
        var days = debutEnchere.split(' ')[0].split('-');
        var hours = debutEnchere.split(' ')[1].split(':');
        var datBegin = new Date(parseInt(days[0]),parseInt(days[1])-1, parseInt(days[2]), parseInt(hours[0]),parseInt(hours[1]), parseInt(hours[2]));
        var datEnd = new Date(parseInt(days[0]),parseInt(days[1])-1, parseInt(days[2]), parseInt(hours[0])+parseInt(finEnchere),parseInt(hours[1]), parseInt(hours[2]));
        var tps_restant = datEnd.getTime() - date_actuelle.getTime(); 
        var s_restantes = tps_restant / 1000; 
        var i_restantes = s_restantes / 60;
        var H_restantes = i_restantes / 60;
        var d_restants = H_restantes / 24;
        s_restantes = Math.floor(s_restantes % 60); 
        i_restantes = Math.floor(i_restantes % 60); 
        H_restantes = Math.floor(H_restantes % 24); 
        d_restants = Math.floor(d_restants); 
        var texte = "Il reste exactement <strong>" + d_restants + " jours</strong>, <strong>" + H_restantes + " heures</strong>," +
            " <strong>" + i_restantes + " minutes</strong> et <strong>" + s_restantes + "s</strong>.";
        document.getElementById("affichage").innerHTML = texte;
    }
    var ench =<?php echo @json_encode($ench) ?>
   
    function rebours(ench){
        if( ench === "yes"){
        setInterval(CompteARebours, 1000); 
    }
    }
    rebours(ench)

    

</script>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background-color: whitesmoke;">
        <a class="navbar-brand" href="../HomePage/HomeAcheteur.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container">
                <div class="logo dropleft">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">

                        <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z" />
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd" />
                            </svg></a>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" style="text-align:center">
                        <a class="dropdown-item" href="../Panier/panierAcheteur.php">Mon panier</a>
                        <a class="dropdown-item" href="../Profils/ProfilGene.php">Mon profil</a>
                        <div class="dropdown-divider"></div>
                        <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <div id="conteneur">
        <div id="wrapper">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="monalert">
            <strong>Attention!</strong> Vous n'avez pas assez d'argent sur votre compte pour acheter.
                <button type="button" class="close" aria-label="Close" onclick="location='http://piscineeceebay.loc/FrontEnd/Items/AchatItems.php?item=<?php echo $monitem ?>?vendor=<?php echo $monvendor ?>'">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="2alert">
            <strong>Attention!</strong> Vous proposez deja la meilleure enchere.
                <button type="button" class="close" aria-label="Close" onclick="location='http://piscineeceebay.loc/FrontEnd/Items/AchatItems.php?item=<?php echo $monitem ?>?vendor=<?php echo $monvendor ?>'">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <script>
            if (window.location.href === "http://piscineeceebay.loc/FrontEnd/Items/AchatItems.php?item=<?php echo $monitem ?>?vendor=test@test.fr?") {
                document.getElementById('monalert').style.display = "block";
            } else {
                document.getElementById('monalert').style.display = "none";
            }

            if (window.location.href === "http://piscineeceebay.loc/FrontEnd/Items/AchatItems.php?item=<?php echo $monitem ?>?vendor=test@test.fr??") {
                document.getElementById('2alert').style.display = "block";
            } else {
                document.getElementById('2alert').style.display = "none";
            }
        </script>
            <div class="row" id="Produit">
                <div class="col-sm-4" id="photo">
                    <span class="helper"></span> <img id="img" src="../../BackEnd/IMG/<?php echo $infoItem[1] ?>">
                </div>
                <div class="col-sm-8" id="info">
                    <div id="test">
                        <p id="affichage" style= "display : <?php echo $display ?>"></p>
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
                                <h2><span class="badge badge-success"><?php echo $prix ?>€</span></h2>
                                <form action="../../BackEnd/Achat/Immediat/achatImmediat.php" method="POST"  style="display:<?php echo $displayImme ?>">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="number" class="form-control" name="id_item" value="<?php echo $infoItem[0] ?>" style="display : none">
                                        <input type="number" class="form-control" name="prix" value="<?php echo $infoItem[5] ?>" style="display : none">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Acheter</button>
                                </form>


                                <form class="form-inline" action="../../BackEnd/Achat/Enchere/encherir.php" method="POST" style= "display : <?php echo $display ?>">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="number" class="form-control" id="inputEnchere" name="id_item" value="<?php echo $infoEnchere["id_item"] ?>" style="display : none">
                                        <input type="number" class="form-control" id="inputEnchere" name="offre" placeholder="€" required="" min=<?php echo $infoEnchere["offre_actuelle"] + 1 ?>>         
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Enchérir</button>
                                </form>

                                <form class="form-inline" action="../../BackEnd/Achat/Enchere/offreAuto.php" method="POST" style= "display : <?php echo $display ?>">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="number" class="form-control" id="inputEnchere" name="id_item" value="<?php echo $infoEnchere["id_item"] ?>" style="display : none">
                                        <input type="number" class="form-control" id="inputEnchere" name="offre" placeholder="€" required="" min=<?php echo $infoEnchere["offre_actuelle"] + 1 ?>>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Offre automatique</button>
                                </form>





                                <form class="form-inline" action="../../BackEnd/Achat/Nego/acceptPropAcheteur.php" method="POST" style= "display : <?php echo $displayNego ?>">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="number" class="form-control" id="inputEnchere" name="id_item" value="<?php echo $infoItem[0] ?>" style="display : none">
                                        <input type="number" class="form-control" id="inputEnchere" name="offreVendeur" value="<?php echo $infoItem[5] ?>" >
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Accepter OFFRE</button>
                                </form>
                                
                                <form class="form-inline" action="../../BackEnd/Achat/Nego/contreProposition.php" method="POST" style= "display : <?php echo $displayNego ?>">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="number" class="form-control" id="inputEnchere" name="id_item" value="<?php echo $infoItem[0] ?>" style="display : none">
                                        <input type="number" class="form-control" id="inputEnchere" name="offreAcheteur" placeholder="€" required="" >
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Contre proposition</button>
                                </form>

                            </div>
                        </div>

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