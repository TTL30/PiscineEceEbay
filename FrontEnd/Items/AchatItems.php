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
    <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>

    <link href="FicheItems.css" rel="stylesheet" media="all" type="text/css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>


<?php
include '../../BackEnd/Items/getDataCurrentItem.php';
include '../../BackEnd/Achat/Enchere/getDataEnchere.php';
include '../../BackEnd/Achat/Nego/getDataNegocia.php';
include '../../BackEnd/Acheteur/delete.php';


$url = $_SERVER['REQUEST_URI'];
$myUrl = explode("?", $url);
$monitem = explode("=", $myUrl[1])[1];
$monvendor = explode("=", $myUrl[2])[1];
$infoItem = getDataCurrentItem($monitem, $monvendor);
$json =  @json_encode($infoItem);
print "<script>console.log($json);</script>";




if (strcmp($infoItem[4], "enchere") === 0) {
    $typeItem = 1;
} else if (strcmp($infoItem[4], "immediat") === 0) {
    if (strcmp($infoItem[9], "offre") === 0) {
        $typeItem = 4;
    } else {
        $typeItem = 2;
    }
} else if (strcmp($infoItem[4], "offre") === 0) {
    if (strcmp($infoItem[9], "immediat") === 0) {
        $typeItem = 4;
    } else {
        $typeItem = 3;
    }
}
$prix = $infoItem[5];


if ($typeItem === 1) {
    $infoEnchere = getDataEnchere($monitem, $monvendor);
    $prix = $infoEnchere["offre_actuelle"];
} else if ($typeItem === 3) {
    $infoNego = getDataNegocia($monitem, $monvendor);
    if (empty($infoNego)) {
        $prix = $infoItem[5];
    } else {
        if ($infoNego['last_offer'] === 0) {
            $prix = $infoNego["offre_vendeur"];
        } else if ($infoNego['last_offer'] === 1) {
            $prix = $infoNego["offre_acheteur"];
        }
    }
} else if ($typeItem === 4) {
    $infoNego = getDataNegocia($monitem, $monvendor);
    if (empty($infoNego)) {
        $prix = $infoItem[5];
    } else {
        if ($infoNego['last_offer'] === 0) {
            $prix = $infoNego["offre_vendeur"];
        } else if ($infoNego['last_offer'] === 1) {
            $prix = $infoNego["offre_acheteur"];
        }
    }
}

if (isset($_POST['delete'])) {
    delete($infoItem[0], $infoItem[7]);
}

?>

<!-- NEGOCIATION DISPLAY -->
<script>
    var type = <?php echo json_encode($typeItem) ?>;
    if (type === 3) {
        var infoneg = <?php echo json_encode($infoNego); ?>;

        $(document).ready(function() {
            $("#nego").css('display', 'block')
            $("#ofreVend").val(infoneg['offre_vendeur'])
        });


        if (infoneg.length === 0) {
            $(document).ready(function() {
                $("#accepter").css('display', 'none')
            });
        }

        if (infoneg['nb'] == 5) {
            $(document).ready(function() {
                $("#contrePro :input").prop("disabled", true);
                $("#contreProBut").html('Vous ne pouvez plus faire de proposition')
                $("#contreProInp").css('display', 'none')
            });
        }

        if (infoneg['last_offer'] == 1) {
            $(document).ready(function() {
                $("#contrePro :input").prop("disabled", true);
                $("#accepter").css('display', 'none')

                $("#contreProBut").html('En attente du vendeur');

                
                $("#contreProInp").css('display', 'none');
            });
        }

        function contrePro() {
            var val = document.getElementById('contreProInp').value;
            alert("Vous avez fait une contre proposition de " + val + " €");
        }

        function acceptProp() {
            alert("Vous avez acheter cette objet felicitatiosn retrouves le dans votre rubrique mes achats");
        }
    }
</script>


<!-- NEGOCIATION + IMMEDIAT -->
<script>
    var type = <?php echo json_encode($typeItem) ?>;
    if (type === 4) {
        var infoneg = <?php echo json_encode($infoNego); ?>;

        $(document).ready(function() {
            $("#nego").css('display', 'block')
            $("#immediat").css('display', 'block')
            $("#ofreVend").val(infoneg['offre_vendeur'])

        });

        if (infoneg.length === 0) {
            $(document).ready(function() {
                $("#accepter").css('display', 'none')
            });
        }

        if (infoneg['nb'] == 5) {
            $(document).ready(function() {
                $("#contrePro :input").prop("disabled", true);
                $("#contreProBut").html('Vous ne pouvez plus faire de proposition')
                $("#contreProInp").css('display', 'none')
            });
        }

        if (infoneg['last_offer'] == 1) {
            $(document).ready(function() {
                $("#contrePro :input").prop("disabled", true);
                $("#accepter").css('display', 'none')

                $("#contreProBut").html('En attente du vendeur');
                $("#contreProInp").css('display', 'none');
            });
        }

        function contrePro() {
            var val = document.getElementById('contreProInp').value;
            alert("Vous avez fait une contre proposition de " + val + " €");
        }

        function acceptProp() {
            alert("Vous avez acheter cette objet felicitatiosn retrouves le dans votre rubrique mes achats");
        }
    }
</script>

<!--IMMEDIAT -->
<script>
    var type = <?php echo json_encode($typeItem) ?>;
    if (type === 2) {
        $(document).ready(function() {
            $("#immediat").css('display', 'block')
        });

        function acceptProp() {
            alert("Vous avez acheter cette objet felicitatiosn retrouves le dans votre rubrique mes achats");
        }
    }
</script>

<!--Enchere -->
<script>
    var type = <?php echo json_encode($typeItem) ?>;
    if (type === 1) {
        var infoench = <?php echo json_encode($infoEnchere); ?>;
        console.log(infoench['id_item']);

        $(document).ready(function() {
            $("#enchere").css('display', 'block');
            $("#affichage").css('display', 'block');

            $("#inputEnchere1").val(infoench['id_item'])
            $("#inputEnchere2").attr({
                "min": infoench['offre_actuelle'] + 1
            })
            $("#inputEnchere3").val(infoench['id_item'])
            $("#inputEnchere4").attr({
                "min": infoench['offre_actuelle'] + 1
            })
        });
        var user = <?php echo json_encode($_SESSION['email']); ?>;
        if (infoench["email_acheteur_actuel"].localeCompare(user) === 0) {
            $(document).ready(function() {
                $("#enche :input").prop("disabled", true);
                $("#encheBut").html('Meilleure enchère')
            });
        }

        function CompteARebours() {
            var date_actuelle = new Date();
            var debutEnchere = <?php echo @json_encode($infoEnchere["debut"]) ?>;
            var finEnchere = <?php echo @json_encode($infoEnchere["fin"]) ?>;
            var days = debutEnchere.split(' ')[0].split('-');
            var hours = debutEnchere.split(' ')[1].split(':');
            var datBegin = new Date(parseInt(days[0]), parseInt(days[1]) - 1, parseInt(days[2]), parseInt(hours[0]), parseInt(hours[1]), parseInt(hours[2]));
            var datEnd = new Date(parseInt(days[0]), parseInt(days[1]) - 1, parseInt(days[2]), parseInt(hours[0]) + parseInt(finEnchere), parseInt(hours[1]), parseInt(hours[2]));
            var tps_restant = datEnd.getTime() - date_actuelle.getTime();
            var s_restantes = tps_restant / 1000;
            var i_restantes = s_restantes / 60;
            var H_restantes = i_restantes / 60;
            var d_restants = H_restantes / 24;
            s_restantes = Math.floor(s_restantes % 60);
            i_restantes = Math.floor(i_restantes % 60);
            H_restantes = Math.floor(H_restantes % 24);
            d_restants = Math.floor(d_restants);
            var texte = "Fin dans <strong>" + H_restantes + " heures</strong>," +
                " <strong>" + i_restantes + " minutes</strong> et <strong>" + s_restantes + "s</strong>.";
            document.getElementById("affichage").innerHTML = texte;
        }
        setInterval(CompteARebours, 1000);

        function offreAUTO() {
            var valOfre = document.getElementById('inputEnchere4').value;
            alert("Vous avez fait une offre automatique de " + valOfre + " €");
        }

        function encheri() {
            var valOfre2 = document.getElementById('inputEnchere2').value;
            alert("Vous avez encheri de " + valOfre2 + " €");
        }
    }
</script>

<script>
    var it = <?php echo json_encode($infoItem); ?>;
    console.log(it);
    if (it[3].localeCompare('Bon_pour_le_musee') == 0) {
        $(document).ready(function() {
            $("#Cate").html("Bon pour le musée");
        });
    }
    if (it[3].localeCompare('Feraille_et_Tresor') == 0) {
        $(document).ready(function() {
            $("#Cate").html("Férailles et Trésors");
        });
    }
    if (it[3].localeCompare('Accesoires_VIP') == 0) {
        $(document).ready(function() {
            $("#Cate").html("Accesoires VIP");
        });
    }
    if (it[4].localeCompare('offre') == 0) {
        if (it[9].localeCompare('aucun') == 0) {
            $(document).ready(function() {
                $("#type").html("Négociation");
            });
        } else {
            $(document).ready(function() {
                $("#type").html("Négociation/Achat");
            });
        }
    }
    if (it[4].localeCompare('immediat') == 0) {
        if (it[9].localeCompare('aucun') == 0) {
            $(document).ready(function() {
                $("#type").html("Achat");
            });
        } else {
            $(document).ready(function() {
                $("#type").html("Négociation/Achat");
            });
        }
    }
    if (it[4].localeCompare('enchere') == 0) {

        $(document).ready(function() {
            $("#type").html("Enchère");
        });

    }
</script>



<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey;background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
        <a class="navbar-brand" href="../HomePage/HomeAcheteur.php" style="width:170px;text-align:center"> <img src="logo.png" alt="" width="65" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <nav class="nav">
                <a id="lien" class="nav-link" href="../Panier/mesAchats.php">Mes achats</a>
                <a id="lien" class="nav-link" href="../Panier/panierAcheteur.php"><i class="fas fa-shopping-cart"></i></a>
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="3alert">
                <strong>Attention!</strong> Vous n'avez pas assez d'argent sur votre compte pour encherir.
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
                if (window.location.href === "http://piscineeceebay.loc/FrontEnd/Items/AchatItems.php?item=<?php echo $monitem ?>?vendor=test@test.fr????") {
                    document.getElementById('3alert').style.display = "block";
                } else {
                    document.getElementById('3alert').style.display = "none";
                }
            </script>
            <div class="row" id="Produit">
                <div class="col-sm-4" id="photo">
                    <span class="helper"></span> <img id="img" src="../../BackEnd/IMG/ITEM/<?php echo $infoItem[6] ?>">
                </div>
                <div class="col-sm-8" id="info">
                    <div id="test" style="color:whitesmoke;text-align: center">
                        <h1 style="text-align: center;max-width:500px;margin:auto"><?php echo $infoItem[1] ?></h1>

                        <div class="container" style="height:90%">
                            <h3 id="affichage" style="color : #FD0909;display: none"></h3>

                            <div class="row" style="margin-top: -4%">
                                <div class="col-sm-12" style="text-align:left;margin-top:5%">
                                    <h4 style="max-width:150px;background-color:#083386;border-radius:5px;padding:10px;color:white">Description:</h4>

                                </div>
                                <div class="col-sm-11" style="background-color:whitesmoke;text-align:left;margin:auto;margin-top:1%;border-radius:20px">
                                    <div style="height:30%;width:90%;margin:auto;color:black">
                                        <p><?php echo $infoItem[2] ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-top:3%">
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <h5 style="max-width:200px;margin:auto;background-color:#083386;border-radius:5px;padding:10px;color:white">Catégorie:</h5>

                                        </div>
                                        <div class="col-sm-6">
                                            <h5 id="Cate" style="max-width:200px;margin:auto;background-color:#A4B4BE;border-radius:5px;padding:10px;color:white"><?php echo $infoItem[3] ?></h5>

                                        </div>
                                        <div class="col-sm-6" style="margin-top:3%">
                                            <h5 style="max-width:200px;margin:auto;background-color:#083386;border-radius:5px;padding:10px;color:white">Type d'achat:</h5>

                                        </div>
                                        <div class="col-sm-6" style="margin-top:3%">
                                            <h5 id="type" style="background-color:#98BBDA;border-radius:5px;padding:10px;color:white;max-width:200px;margin:auto"><?php echo $infoItem[4] ?></h5>

                                        </div>


                                    </div>
                                </div>

                            </div>
                            <hr class="my-3" style="background-color: whitesmoke;height:1px">

                            <div class="row" style="margin-top:3%">

                                <div class="col-sm-6">
                                    <h4 style="background-color:#3EC10C;border-radius:5px;color:white;max-width:200px;margin:auto">Prix Initial :<br><strong style="color: #C13B0C"><?php echo $infoItem[5] ?>€</strong></h4>
                                    <h4 style="background-color:#CF2F16;border-radius:5px;color:white;max-width:200px;margin:auto;margin-top:2%">Offre Actuelle : <br> <strong style="color: #44CF16"><?php echo $prix ?>€</strong></h4>
                                </div>


                                <div class="col-sm-6">
                                    


                                    <div id="enchere" style="display: none; margin-top:7%">

                                        <form class="form-inline" action="../../BackEnd/Achat/Enchere/encherir.php" method="POST" id='enche'>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <input type="number" class="form-control" id="inputEnchere1" name="id_item" style="display : none">
                                                <input type="number" class="form-control" id="inputEnchere2" name="offre" placeholder="€" required=""style="width:160px" >
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-info mb-2" id="encheBut">Enchérir</button>
                                        </form>
                                        <form class="form-inline" action="../../BackEnd/Achat/Enchere/offreAuto.php" method="POST">
                                            <div class="form-group mx-sm-3 mb-2">
                                                <input type="number" class="form-control" id="inputEnchere3" name="id_item" style="display : none">
                                                <input type="number" class="form-control" id="inputEnchere4" name="offre" placeholder="€" required="" style="width:160px">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-warning mb-2">Offre automatique</button>
                                        </form>
                                    </div>



                                    <div id="nego" style="display: none; margin-left:10%">
                                        <form class="form-inline" action="../../BackEnd/Achat/Nego/acceptPropAcheteur.php" method="POST" id="accepter" >
                                            <div class="form-group mx-sm-3 mb-2">
                                                <input type="number" class="form-control" id="inputEnchere" name="id_item" value="<?php echo $infoItem[0] ?>" style="display : none">
                                                <input type="number" class="form-control" id="ofreVend" name="offreVendeur" disabled style="width:100px">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-info mb-2">Accepter</button>
                                        </form>

                                        <form class="form-inline" action="../../BackEnd/Achat/Nego/contreProposition.php" method="POST" id="contrePro" >
                                            <div class="form-group mx-sm-3 mb-2">
                                                <input type="number" class="form-control" id="inputEnchere" name="id_item" value="<?php echo $infoItem[0] ?>" style="display : none">
                                                <input type="number" class="form-control" id="contreProInp" name="offreAcheteur" placeholder="€" required=""  style="width:100px">
                                            </div>
                                            <button type="submit" name="submit" id="contreProBut" class="btn btn-warning mb-2">Proposer</button>
                                        </form>
                                    </div>


                                    <div id="immediat" style="display:none">
                                        <form action="../../BackEnd/Achat/Immediat/achatImmediat.php" method="POST" >
                                            <div class="form-group mx-sm-3 mb-2">
                                                <input type="number" class="form-control" name="id_item" value="<?php echo $infoItem[0] ?>" style="display : none">
                                                <input type="number" class="form-control" name="prix" value="<?php echo $infoItem[5] ?>" style="display : none">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-success mb-2">Achat immédiat</button>
                                        </form>
                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>




                </div>
            </div>


        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>