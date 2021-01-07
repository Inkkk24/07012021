<?php

class UtilisateursManager {

    // DECLARATIONS ET INSTANCIATIONS
    private $bdd; // Instance de PDO.
    private $_result;
    private $_message;
    private $_utilisateur; // Instance de l'utilisateur
    private $_getLastInsertId;

    public function __construct(PDO $bdd) {
        $this->setBdd($bdd);
    }

    function getBdd() {
        return $this->bdd;
    }

    function get_result() {
        return $this->_result;
    }

    function get_message() {
        return $this->_message;
    }

    function get_utilisateur() {
        return $this->_utilisateur;
    }

    function get_getLastInsertId() {
        return $this->_getLastInsertId;
    }

    function setBdd($bdd): void {
        $this->bdd = $bdd;
    }

    function set_result($_result): void {
        $this->_result = $_result;
    }

    function set_message($_message): void {
        $this->_message = $_message;
    }

    function set_utilisateur($_utilisateur): void {
        $this->_utilisateur = $_utilisateur;
    }

    function set_getLastInsertId($_getLastInsertId): void {
        $this->_getLastInsertId = $_getLastInsertId;
    }
//-------------------------------------------------------------------------------//
    public function get($id) {
        // prepare une requete de type select avec une clause where selon l'id
        $sql = 'SELECT * FROM utilisateurs WHERE id = :id';
        $req = $this->bdd->prepare($sql);

        $req->bindvalue('id', $id, PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateur = new utilisateur();
        $utilisateur->hydrate($donnees);
        return $utilisateur;
    }
//-------------------------------------------------------------------------------//
    public function getByEmail($email) {

        // Prépare une requete de type SELECT
        $sql = 'SELECT * FROM utilisateurs WHERE email = :email';
        $req = $this->bdd->prepare($sql);

        //Execution de la requete

        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        // On stocke les données obtenu dans un tableau

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateur = new utilisateur();
        $utilisateur->hydrate($donnees);
        //print_r2($article);
        return $utilisateur;
    }

    public function updateByEmail(utilisateur $utilisateur) {
        //print_r2($utilisateur);
        $sql = "UPDATE utilisateurs SET sid = :sid WHERE email = :email";
        $req = $this->bdd->prepare($sql);
        // Sécurisation
        $req->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateur->getSid(), PDO::PARAM_STR);
        //Execution de la requete
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->_result = true;
        } else {
            $this->_return = false;
        }
        return $this;
    }
//-------------------------------------------------------------------------------//
    public function getList() {
        $listUtilisateur = [];  // Equivalent de Array 
        //
        //
        // Prépare une requete de type SELECT
        $sql = 'SELECT  id, '
                . 'nom, '
                . 'prenom, '
                . 'email, '
                . 'mdp, '
                . 'sid '
                . 'FROM utilisateurs';
        $req = $this->bdd->prepare($sql);

        //Execution de la requete
        $req->execute();

        // On stocke les données obtenu dans un tableau

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $utilisateur = new utilisateur();
            $utilisateur->hydrate($donnees);
            $listUtilisateur[] = $utilisateur;
        }


        //print_r2($listArticle);
        return $listUtilisateur;
    }
//-------------------------------------------------------------------------------//
    public function add(utilisateur $utilisateur) {
        $sql = "INSERT INTO utilisateurs "
                . "(nom, prenom, email, mdp, sid)"
                . "VALUES (:nom, :prenom, :email, :mdp, :sid)";


        $req = $this->bdd->prepare($sql);
        // Sécurisation
        $req->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $utilisateur->getMdp(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateur->getSid(), PDO::PARAM_STR);
        //Execution de la requete
        $req->execute();
        //Vérification de la requete
        if ($req->errorCode() == 00000) {
            $this->_result = true;
            $this->_getLastInsertId = $this->bdd->lastInsertId();
        } else {
            $this->_return = false;
        }
        return $this;
    }
//-------------------------------------------------------------------------------//
    public function getBySid($sid) {
        $sql = "SELECT * FROM utilisateurs WHERE sid = :sid";
        $req = $this->bdd->prepare($sql);

        $req->bindvalue(':sid', $sid, PDO::PARAM_STR);
        $req->execute();

        $donnee = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateur = new utilisateur();
        $utilisateur->hydrate($donnee);

        return $utilisateur;
    }

}
