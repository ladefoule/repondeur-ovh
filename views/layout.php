<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontello/css/fontello.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Gestion de votre répondeur</title>
  </head>
  <body class="full">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <?php if($account){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mon répondeur
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php if(! $responder){ ?>
                                <a class="dropdown-item" href="/create">Créer</a>
                            <?php }else{ ?>
                                <a class="dropdown-item" href="/show">Visualiser</a>
                                <a class="dropdown-item" href="/update">Modifier</a>
                            <?php } ?>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <?php if($account){ ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item nav-link-profil dropdown">
                        <span id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo $account ?>
                        </span>

                        <div class="dropdown-menu dropdown-menu-right mb-2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/logout">
                                Se déconnecter
                            </a>
                        </div>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center py-3 flex-wrap">
        <?php echo $content; ?>
    </div>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>