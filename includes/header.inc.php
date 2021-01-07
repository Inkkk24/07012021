<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Homepage</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="#">667-EKIP</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/Projet%201/">Homepage
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>

                        <?php
                        if ($utilisateurConnect->isConnect == true) {
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/Projet%201/Article.php">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/Projet%201/Users.php">Utilisateurs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/Projet%201/deconnexion.php">Deconnexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/Projet%201/Comment.php">Comment</a>
                            </li>
                            <?php
                        }
                        ?>    

                        <?php
                        if ($utilisateurConnect->isConnect == false) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/Projet%201/connexion.php">Connexion</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
