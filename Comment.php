<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';

//print_r2($session);

if (isset($_POST['submit'])) {
    echo'le formulaire est posté';
    // print_r2($_POST);
    // print_r2($_FILES);


    //Création de l'utilisateur
    $comment = new comment();
    $comment->hydrate($_POST);
    

/*
    $publie = $article->getPublie() === 'on' ? 1 : 0;
    $article->setPublie($publie);
    print_r2($utilisateur);
*/
    
    //Insertion de l'utilisateur
    $commentManager = new commentManager($bdd);
    $commentManager->add($comment);

    
    if ($commentManager->get_result() == true) {
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
                <h1 class="mt-5">Page d'ajout d'un Commentaire</h1>
                <p class="lead">Veuillez ajouter un Commentaire</p>
                <ul class="list-unstyled">
                </ul>
            </div>
        </div>
    </div>

    <div classe="row">

        <div class="col-lg-6 offset-lg-3">
            <form id="articleForm" method="POST" action="Comment.php" enctype="multipart/form-data">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="nom">Commentaire:</label>
                        <input type="text" class="form-control" id="message" name="message"  placeholder="" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Créer mon Commentaire</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include_once 'includes/footer.inc.php';
}





