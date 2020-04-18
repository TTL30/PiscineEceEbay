
<!doctype html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="accueil.css" rel="stylesheet" media="all" type="text/css">
        <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


        <title>EceBay</title>
        <link href="HomePage.css" rel="stylesheet" media="all" type="text/css">
    </head>

    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
            <a class="navbar-brand" href="HomeVendeur.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
        <div class="containeur" id="conteneur">
            <div class="row" id="row">
                <div class="col-md-5" id="col1">
                </div>
                <div class="col-md-7" id="col2">
                    <div class="top">
                        <div class="col-6" id="col21">
                        </div>
                        <div class="col-6" id="col22">
                        </div>
                    </div>
                    <div class="bot">
                        <div class="col-6" id="col23">
                        </div>
                        <div class="col-6" id="col24">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class ="col-12" id="texte">
            <h1 style="color:whitesmoke;"> Venez vous aussi trouver vos trésors sur EceEbay</h1>
            <div class="col-12" id="boutons">
                <a href="../Auth/inscription.php" class="s3"><button class="btn  btn-lg my-2 my-sm-0" id="inscription" type="submit" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Inscription</button></a>
                <a href="../Auth/login.php" class="s3"><button class="btn  btn-lg my-2 my-sm" id="connexion" type="Connexion" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.7), 0 6px 20px 0 rgba(0,0,0,0.19);">Connexion</button></a>
            </div>
        </div>
    </body>

</html>