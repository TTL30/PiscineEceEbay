<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet"
          href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.j s"> </script>
    <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.j s"> </script>
    <title>EceBay</title>
    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    

    <link href="InscriptionConnexion.css" rel="stylesheet" media="all" type="text/css"> 
    </head>
    <?php
    $myUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <body class="text-center">
            <div class="formulaire">
                <form class="form-signin" action="../../BackEnd/Auth/login.php" method="POST">
                    <img class="mb-4" src="logo.png" alt="" width="200" height="100">
                    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
                    <?php
                    if (strpos($myUrl, "login=email/pass") == true) {
                        echo "<h5><span class=\"badge\">Cette combinaison email/password n'existe pas</span></h5>";
                    }
                    ?>
                    <label for="inputEmail" class="sr-only">Email</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="email">
                    <label for="inputPassword" class="sr-only">Mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">

                    <button class="btn btn-lg btn-warning btn-block" type="submit" name="Submit">Connexion</button>
                    <a href =inscription.php><h4> Inscivez-vous !</h4></a>


                </form>
            </div>
            <p class="mt-5 mb-3 text-muted">© 2020 -- MARZE Oscar TEIXEIRA Tiago</p>

    </body></html>

