<?php

require_once 'bdd.conf.php';

if(isset($_COOKIE['sid'])){
    $sid = $_COOKIE['sid'];
    $utilisateursManager = new utilisateursManager($bdd);
    $utilisateurConnect = $utilisateursManager->getBySid($sid);
    
    if($utilisateurConnect->getEmail() != ''){
       $utilisateurConnect->isConnect = true;
    }else{
        $utilisateurConnect->isConnect = false;
    }
    //print_r2($utilisateursConnect);
} else{
    $utilisateurConnect = new utilisateur();
    $utilisateurConnect->isConnect = false;
    //print_r2($utilisateursConnect);
}

