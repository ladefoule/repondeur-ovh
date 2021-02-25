<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <title>Gestion de votre répondeur</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php if(! $account){ ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Accueil</a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gestion du répondeur
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/?route=create">Créer</a>
                            <a class="dropdown-item" href="/?route=show">Visualiser</a>
                            <a class="dropdown-item" href="/?route=update">Modifier</a>
                            <a class="dropdown-item" href="/?route=delete">Supprimer</a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <?php if($account){ ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item nav-link-profil dropdown pl-2 d-flex flex-shrink-0">
                        <span id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo $account ?>
                        </span>

                        <div class="dropdown-menu dropdown-menu-right mb-2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/?route=logout">
                                Se déconnecter
                            </a>
                        </div>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center pt-3 flex-wrap">
        <?php
            // Personnalisation du message
            if(isset($message) && isset($class)){
                ?>
                <div class="col-12 d-flex justify-content-center">
                    <div class="col-md-6 alert alert-<?php echo $class ?> alert-block">    
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong><?php echo $message ?></strong>
                    </div>
                </div>
                <?php 
            }
        ?>
        <?php echo $contenu; ?>
    </div>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  </body>
</html>