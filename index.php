<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
require_once('components/smarty/libs/Smarty.class.php');
//$article = new article();
//$article->hydrate(array());
//print_r2($_SESSION);

$page = !empty($_GET['p']) ? $_GET['p'] : 1;
define("nb_article_Page", 2);

//<!-- Managers -->
$articleManager = new articleManager($bdd);
//$commentManager = new commentManager($bdd);
//$listeArticle = $articleManager->getList();
//print_r2($newArticle);
$UtilisateursManager = new UtilisateursManager($bdd);
$listUtilisateurs = $UtilisateursManager->getList();
//<!-- Managers -->


$nbArticlesTotalAPublie = $articleManager->countArticlesPublie();
// print_r2($nbArticlesTotalAPublie);

$indexDepart = ($page - 1) * nb_article_Page;

$nbPages = ceil($nbArticlesTotalAPublie / nb_article_Page);

$listeArticle = $articleManager->getListArticleAfficher($indexDepart, nb_article_Page);
//$listComment = $commentManager->getListCo();

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

$smarty->assign('listeArticle', $listeArticle);
$smarty->assign('utilisateurConnect', $utilisateurConnect);
$smarty->assign('nbPages', $nbPages);
$smarty->assign('page', $page);
// $smarty->assign('listComment', $listComment);

include_once 'includes/header.inc.php';

$smarty->display('index.tpl');

include_once 'includes/footer.inc.php';

unset($_SESSION['notification']);







