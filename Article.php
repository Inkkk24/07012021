<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';

// print_r2($_POST);
?>

<?php
$idArticle = !empty($_GET['Id']) ? $_GET['Id'] : 0;

if (isset($_POST['edit'])) {
    echo'le formulaire est posté';

    // print_r2($_FILES);
    // print_r2($_POST);
    //
    //  
    //Modif de l'article
    $EditArticle = new article();
    $EditArticle->hydrate($_POST);
    $EditArticle->setDate(date('Y-m-d'));

    $publie = $EditArticle->getPublie() === 'on' ? 1 : 0;
    $EditArticle->setPublie($publie);

    $articleManager = new articleManager($bdd);
    $articleManager->update($EditArticle);

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
    //exit();
    header("Location: Index.php");
    exit();
}


if (isset($_POST['submit'])) {
    // echo 'oui';
    print_r2($_POST);
    print_r2($_FILES);

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
    //echo 'non';

    $Idedt = empty($_GET['Id']);


    if ($Idedt == false) {
        $articleManager = new articleManager($bdd);
        $EditArticle = $articleManager->get($_GET['Id']);
    }
    include_once 'includes/header.inc.php';
    ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">


                <?php if ($Idedt == false) { ?>
                    <h1 class="mt-5">Modification de l'article</h1>
                    <p class="lead">Veuillez modifier votre article</p>
                    <ul class="list-unstyled">
                        <li>5</li>
                        <li>jQuery 3.5.1</li>
                    </ul>
                <?php } else { ?>
                    <h1 class="mt-5">Page d'ajout d'article</h1>
                    <p class="lead">Veuillez ajouter un article</p>
                    <ul class="list-unstyled">
                        <li>5</li>
                        <li>jQuery 3.5.1</li>
                    </ul>
                <?php } ?>

            </div>
        </div>
    </div>

    <div classe="row">

        <div class="col-lg-6 offset-lg-3">
            <form id="articleForm" method="POST" action="article.php" enctype="multipart/form-data">

                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" id="id" value="<?php if ($Idedt == false) {
                    echo $_GET['Id'];
                } ?>" placeholder="" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?php if ($Idedt == false) {
                    echo $EditArticle->getTitre();
                } ?>" placeholder="" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="texte">Le texte de mon article</label>
                        <textarea class="form-control" id="texte" name="texte" rows="3"> <?php if ($Idedt == false) {
                    echo $EditArticle->getTexte();
                } ?> </textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="image">L'image de mon article</label>
                        <input type="file" class="form-control-file" id="image" name="image" >
                    </div>
                </div> 

                <div class="col-lg-12">
                    <div class="form-group form-check">
                        <input type="checkbox"  id="publie" name="publie" class="form-check-input" id="publie" <?php if ($Idedt == false) {
                    if ($EditArticle->getPublie() == '1') { ?> checked <?php }
                } ?>>  
                        <label class="form-check-label" for="publie">Article publié ?</label>
                    </div>
                </div>
                <?php if ($Idedt == false) { ?>
                    <div>
                        <button type="submit" id="edit" name="edit" class="btn btn-primary">Editer l'article</button>
                    </div>
    <?php } else { ?>
                    <div>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Créer mon article</button>
                    </div>
    <?php } ?>
            </form>
        </div>
    </div>

    <?php
    include_once 'includes/footer.inc.php';
}
    