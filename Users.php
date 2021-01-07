<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';

//print_r2($session);

if (isset($_POST['submit'])) {
    echo'le formulaire est posté';
    // print_r2($_POST);
    // print_r2($_FILES);


    //Création de l'utilisateur
    $utilisateur = new utilisateur();
    $utilisateur->hydrate($_POST);
    $utilisateur->setMdp(password_hash($utilisateur->getMdp(),PASSWORD_DEFAULT));

/*
    $publie = $article->getPublie() === 'on' ? 1 : 0;
    $article->setPublie($publie);
    print_r2($utilisateur);
*/
    
    //Insertion de l'utilisateur
    $UtilisateursManager = new UtilisateursManager($bdd);
    $UtilisateursManager->add($utilisateur);

    
    if ($UtilisateursManager->get_result() == true) {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'Votre utilisateur a été ajouté !';
    } else {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'Une erreur est survenue pendant la création de votre utilisateur';
    }


    header("Location: Index.php");
    exit();
} else {
    //echo 'AUCUN formulaire posté';
    include_once 'includes/header.inc.php';
    ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Page d'ajout d'un utilisateur</h1>
                <p class="lead">Veuillez ajouter un utilisateur</p>
                <ul class="list-unstyled">
                    <li>Bootstrap 4.5.0</li>
                    <li>jQuery 3.5.1</li>
                </ul>
            </div>
        </div>
    </div>

    <div classe="row">

        <div class="col-lg-6 offset-lg-3">
            <form id="articleForm" method="POST" action="users.php" enctype="multipart/form-data">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom"  placeholder="" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="prenom">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="mdp">Mot de passe:</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>
                </div>


                <div class="col-lg-12">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Créer mon Utilisateur</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include_once 'includes/footer.inc.php';
}





