<?php

class commentManager {

    // DECLARATIONS ET INSTANCIATIONS
    private $bdd; // Instance de PDO.
    private $_result;
    private $_message;
    private $_comment; // Instance de commentaire 
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

    function get_comment() {
        return $this->_comment;
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

    function set_comment($_comment): void {
        $this->_comment = $_comment;
    }

    function set_getLastInsertId($_getLastInsertId): void {
        $this->_getLastInsertId = $_getLastInsertId;
    }

    
    
    public function get($cid) {

        // Prépare une requete de type SELECT
        $sql = 'SELECT * FROM comments WHERE cid = :cid';
        $req = $this->bdd->prepare($sql);

        //Execution de la requete

        $req->bindValue(':cid', $cid, PDO::PARAM_INT);
        $req->execute();

        // On stocke les données obtenu dans un tableau

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $comment = new comment();
        $comment->hydrate($donnees);
        //print_r2($article);
        return $comment;
    }

    public function getListCo() {
        $listComment = [];  // Equivalent de Array 
        //
        //
        // Prépare une requete de type SELECT
        $sql = 'SELECT  cid, '
                . 'uid, '
                . 'message '
                . 'FROM comments';
        $req = $this->bdd->prepare($sql);

        //Execution de la requete
        $req->execute();

        // On stocke les données obtenu dans un tableau

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $comment = new comment();
            $comment->hydrate($donnees);
            $listComment[] = $comment;
        }


        //print_r2($listArticle);
        return $listComment;
    }

    public function add(comment $comment) {
        $sql = "INSERT INTO comments "
                . "(uid, message)"
                . "VALUES (:uid, :message)";


        $req = $this->bdd->prepare($sql);
        // Sécurisation
        $req->bindValue(':uid', $comment->getUid(), PDO::PARAM_INT);
         // $req->bindValue(':date', $comment->getDate(), PDO::PARAM_STR);
        $req->bindValue(':message', $comment->getMessage(), PDO::PARAM_STR);
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
/*
    public function update(article $article) {
        //print_r2($article);
        $sql = 'update article set titre = :titre , texte = :texte , publie = :publie , date = :date where id = :id';
        
        $req = $this->bdd->prepare($sql);
        // Sécurisation
        $req->bindValue(':id', $article->getID(), PDO::PARAM_INT);
        $req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':texte', $article->getTexte(), PDO::PARAM_STR);
        $req->bindValue(':publie', $article->getPublie(), PDO::PARAM_INT);
        $req->bindValue(':date', $article->getDate(), PDO::PARAM_STR);

        //Execution de la requete
        $req->execute();
        //Vérification de la requete
        if ($req->errorCode() == 00000) {
            //var_dump($req->errorCode());
            $this->_result = true;
            $this->_getLastInsertId = $article->getId();
        } else {
            $this->_return = false;
        }
        return $this;
    }

    public function countArticlesPublie() {
        $sql = "SELECT COUNT(*) as total FROM article "
                . "WHERE publie = 1";

        $req = $this->bdd->prepare($sql);
        $req->execute();
        $count = $req->fetch(PDO::FETCH_ASSOC);
        $total = $count['total'];
        return $total;
    }

    public function getListArticleAfficher($depart, $limit) {
        $listArticle = [];
        // prepare une requete de type select avec une clause where selon l'id
        $sql = 'SELECT id, '
                . 'titre, '
                . 'texte, '
                . 'publie, '
                . 'DATE_FORMAT(date, "%d/%m/%y") as date '
                . 'FROM article '
                . 'WHERE publie=1 '
                . 'LIMIT :depart, :limit ';
        $req = $this->bdd->prepare($sql);

        $req->bindvalue(':depart', $depart, PDO::PARAM_INT);
        $req->bindvalue(':limit', $limit, PDO::PARAM_INT);

        $req->execute();

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $article = new article();
            $article->hydrate($donnees);
            $listArticle[] = $article;
        }

        //print_r2($listArticle);
        return $listArticle;
    }

    
    /*
    public function getListArticlesFromRecherche($recherche) {
        $listArticle = [];

        // Prépare une requête de type SELECT avec une clause WHERE selon l'id.
        $sql = 'SELECT id, '
                . 'titre, '
                . 'texte, '
                . 'publie, '
                . 'DATE_FORMAT(date, "%d/%m/%Y") as date '
                . 'FROM article '
                . 'WHERE publie = 1 '
                . 'AND (titre LIKE :recherche '
                . 'OR texte LIKE :recherche)';
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':recherche', "%" . $recherche . "%", PDO::PARAM_STR);

        // Exécution de la requête avec attribution des valeurs aux marqueurs nominatifs.
        $req->execute();

        // On stocke les données obtenues dans un tableau.
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            //On créé des objets avec les données issues de la table
            $article = new article();
            $article->hydrate($donnees);
            $listArticle[] = $article;
        }

        //print_r2($listArticle);
        return $listArticle;
    }
*/
}


