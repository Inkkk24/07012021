
<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';

//print_r2($session);

if (isset($_POST['submit'])) {
    echo'le formulaire est posté';
    // print_r2($_POST);
    // print_r2($_FILES);
    // 
    // 
    //Création de l'utilisateur
    $utilisateur = new utilisateur();
    $utilisateur->hydrate($_POST);
    print_r2($utilisateur);
    // 
    // 
    //Recherche de l'utilisateur
    $UtilisateursManager = new UtilisateursManager($bdd);
    
    //recherche de l'utilisateur dans la bdd
    $UtilisateursEnBdd = $UtilisateursManager->getByEmail($utilisateur->getEmail());
    // print_r2($UtilisateursEnBdd);

    $isConnect = password_verify($utilisateur->getMdp(), $UtilisateursEnBdd->getMdp());
    //var_dump($isConnect);

    if ($isConnect == true) {

        $sid = md5($utilisateur->getEmail() . time());
        // Création du cookie
        setcookie('sid', $sid, time() + 86400);
        // Mise en BDD du sid
        $utilisateur->setSid($sid);
        $UtilisateursManager->updateByEmail($utilisateur);
         //var_dump($UtilisateursManager->get_result());
    }
    //exit();
    //Vérification/Erreur
    if ($isConnect == true) {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'Vous ètes connecté !';
        header("Location: Index.php");
        exit();
    } else {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'verifier votre login/mdp';
        header("Location: connexion.php");
        exit();
    }
} else {
    //echo 'AUCUN formulaire posté';
    include_once 'includes/header.inc.php';
    ?>

    <br><br>
    <div class="container">
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

        <!---------------------------- Page Content ---------------------------->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="mt-5">Page de connexion</h1>
                    <p class="lead">Veuillez vous connecter</p>
                    <ul class="list-unstyled">
                        <li>...</li>
                        <li>...</li>
                    </ul>
                </div>
            </div>
        </div>

        <div classe="row">

            <div class="col-lg-6 offset-lg-3">
                <form id="articleForm" method="POST" action="connexion.php" enctype="multipart/form-data">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" value="" name="email" required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="mdp">Mot de passe:</label>
                            <input type="password" class="form-control" id="mdp" value="" name="mdp" required>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Connexion</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        include_once 'includes/footer.inc.php';
    }
        ?>




