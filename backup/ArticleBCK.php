<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';

//print_r2($session);

if (isset($_POST['submit'])) {
    echo'le formulaire est posté';
    // print_r2($_POST);
    // print_r2($_FILES);


    //Création de l'article
    $article = new article();
    $article->hydrate($_POST);

    $article->setDate(date('Y-m-d'));

    $publie = $article->getPublie() === 'on' ? 1 : 0;
    $article->setPublie($publie);
    // print_r2($article);

    //Insertion de l'article
    $articleManager = new articleManager($bdd);
    $articleManager->add($article);
    //var_dump($articleManager);
    // Traitement de l'image
    if ($_FILES['image']['error'] == 0) {
        $fileInfos = pathinfo($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],
                'img/' . $articleManager->get_getLastInsertId() . '.' . $fileInfos['extension']);
    }
    if ($articleManager->get_result() == true) {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'Votre article a été ajouté !';
    } else {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'Une erreur est survenue pendant la création de votre article';
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
                <h1 class="mt-5">Page d'ajout d'article</h1>
                <p class="lead">Veuillez ajouter un article</p>
                <ul class="list-unstyled">
                    <li>55</li>
                    <li>jQuery 3.5.1</li>
                </ul>
            </div>
        </div>
    </div>

    <div classe="row">

        <div class="col-lg-6 offset-lg-3">
            <form id="articleForm" method="POST" action="article.php" enctype="multipart/form-data">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre"  placeholder="" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="texte">Le texte de mon article</label>
                        <textarea class="form-control" id="texte" name="texte" rows="3" required></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="image">L'image de mon article</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div> 

                <div class="col-lg-12">
                    <div class="form-group form-check">
                        <input type="checkbox"  id="publie" name="publie" class="form-check-input" id="publie"> <!-- Checked = Pré coche la case --> 
                        <label class="form-check-label" for="publie">Article publié ?</label>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Créer mon article</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include_once 'includes/footer.inc.php';
}



