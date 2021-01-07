<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
//$article = new article();
//$article->hydrate(array());
//print_r2($_SESSION);

$page = !empty($_GET['p']) ? $_GET['p'] : 1;
define("nb_article_Page", 2);

//<!-- Managers -->
$articleManager = new articleManager($bdd);
$listArticle = $articleManager->getList();
//print_r2($newArticle);
$UtilisateursManager = new UtilisateursManager($bdd);
$listUtilisateurs = $UtilisateursManager->getList();
//<!-- Managers -->


$nbArticlesTotalAPublie = $articleManager->countArticlesPublie();
// print_r2($nbArticlesTotalAPublie);

$indexDepart = ($page - 1) * nb_article_Page;

$nbPages = ceil($nbArticlesTotalAPublie / nb_article_Page);

$listArticles = $articleManager->getListArticleAfficher($indexDepart, nb_article_Page);

include_once 'includes/header.inc.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center mt-5">
            <form class="form-inline" id="rechercheForm" method="GET" action="recherche.php" >
                <label class="sr-only" for="recherche">Recherche</label>
                <input type="text" class="form-control mb-2 mr-sm-2 " id="recherche" name="recherche" placeholder="Rechercher un article" value="">
                <button type="submit" class="btn btn-primary mb-2" name="submitRecherche">Rechercher</button>
            </form>
        </div>
    </div>
</div>  

<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5">Page d'accueil</h1>
        <p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
        <ul class="list-unstyled">
            <li>Bootstrap 4.5.0</li>
            <li>jQuery 3.5.1</li>
        </ul>
    </div>
</div>

<?php if (isset($_SESSION['notification'])) { ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-<?= $_SESSION['notification']['result'] ?>" role="alert">
                <?= $_SESSION['notification']['message'] ?>

            </div> 
        </div>
    </div>
    <?php
    unset($_SESSION['notification']);
}
?>
<div class="row">
    <?php
    foreach ($listArticle as $key => $article) {
        ?>
        <div class="col-md-6">
            <div class="card" style="">
                <img src="img/<?= $article->getId(); ?>.jpg" class="card-img-top" alt="<?= $article->getTitre(); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $article->getTitre(); ?></h5>
                    <p class="card-text"><?= substr($article->getTexte(), 0, 150) . "..."; ?></p>
                    <a href="#" class="btn btn-primary"><?= $article->getDate(); ?></a>
                    <a href="Article.php?p=<?= $article->getId() ?>" class="btn btn-warning">Modifier</a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                for ($index = 1; $index <= $nbPages; $index++) {
                    ?>
                    <li class="page-item active" <?php if ($page == $index) { ?> active <?php } ?>"><a class="page-link" href="index.php?p=<?= $indexDepart ?>"><?= $index ?></a></li>
                    <?php
                }
                ?>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
            </ul>
        </nav>
    </div>
</div>

<?php
include_once 'includes/footer.inc.php';
?>


