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


    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background-color: whitesmoke;" >
            <a class="navbar-brand" href="Acceuil.html">   <img  src="logo.png" alt="" width="60" height="30"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="logo">
                    <a href="Acceuil.html"><svg class="profil" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                        </svg></a>
                </div>
            </div>
        </nav>
        <div class="container" id="conteneur">
            <div class="row" id="Produit">
                <div class="col-sm-4" id="photo"> 
                    <img id="img"src="Exemple.jpg">
                </div>
                <div class="col" id="info">

                    <div id="test">
                        <table class="tab" cellpadding=10>
                            <tr>
                                <td><p>Nom du produit</p> </td>
                                <td><p style="background-color:whitesmoke"> hi</p></td>
                            </tr>
                            <tr>
                                <td><p>Description</p></td>
                                <td><p style="background-color:whitesmoke;max-width:550px;max-height:150px"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae felis fringilla, ornare nulla vel, consequat turpis. Maecenas vel ex ac justo tincidunt venenatis vitae quis ante. Nunc dignissim varius est vel eleifend. Sed ac interdum libero. Morbi at finibus sem. Proin dignissim molestie dolor non rhoncus. Fusce at ex ante.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae felis fringilla, ornare nulla vel, consequat turpis. Maecenas</p></td>
                            </tr>
                            <tr>
                                <td><p>Prix</p> </td>
                                <td><p style="background-color:whitesmoke;max-width:400px"> hi</p></td>
                            </tr>
                        </table>
                    </div>
                    <div id="boutons">
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Modifier</button>
                        <input type="submit" class="btn btn-outline-warning my-2 my-sm-0" name="button2" value="Ajouter au panier" style="float:right;float:bottom">
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