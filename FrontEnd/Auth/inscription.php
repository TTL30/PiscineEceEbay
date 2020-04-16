<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v3.8.6">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.j s"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.j s"> </script>
        <title>EceBay</title>
        <link href="InscriptionConnexion.css" rel="stylesheet" media="all" type="text/css">
    </head>

    <?php
    $myUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>

    <body class="text-center">
        <div class="formulaire">
            <form class="form-signin" action="../../BackEnd/Auth/register.php" method="POST">
                <img class="mb-4" src="logo.png" alt="" width="200" height="110">
                <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>
                <h5> Veuillez renseigner les champs suivants</h5>
                <?php
                if (strpos($myUrl, "register=email") == true) {
                    echo "<h5><span class=\"badge\">Email deja utilise</span></h5>";
                }
                ?>
                <label for="inputNom" class="sr-only">Nom</label>
                <input type="nom" id="inputNom" class="form-control" placeholder="Nom" required="" autofocus="" name="name">
                <label for="inputPrenom" class="sr-only">Prénom</label>
                <input type="prenom" id="inputPrenom" class="form-control" placeholder="Prénom" required="" name="last_name">
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="email">
                <label for="inputPassword" class="sr-only">Mot de passe</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="" name="password">
                <div class="Type">
                    <select size="1" class="mr-sm-2" name="type">
                        <option value="2">Je suis ici pour vendre !</option>
                        <option value="3" selected>Je suis ici pour acheter !</option>
                    </select>
                </div>
                <div class="bouton">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit">Inscription</button>
                    <button class="btn btn-primary btn-lg " type="reset" value="BouttonReset" name="ResetChamps"> Vider les champs</button>
                </div>
            </form>
        </div>
        <a href =login.php><h6> Connectez-vous !</h6></a>
        <p class="mt-5 mb-3 text-muted">© 2020 -- MARZE Oscar TEIXEIRA Tiago</p>

    </body>

</html>