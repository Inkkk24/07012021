<?php

class comment {

    public $cid;
    public $uid;
    // public $date;
    public $message;

    public function __construct() {
        
    }

    function getCid() {
        return $this->cid;
    }

    function getUid() {
        return $this->uid;
    }

   // function getDate() {
       // return $this->date;
   // }

    function getMessage() {
        return $this->message;
    }

    function setCid($cid): void {
        $this->cid = $cid;
    }

    function setUid($uid): void {
        $this->uid = $uid;
    }

   // function setDate($date): void {
       // $this->date = $date;
   // }

    function setMessage($message): void {
        $this->message = $message;
    }

    
    public function hydrate($donnees) {
        if (isset($donnees['cid'])) {
            $this->cid = $donnees['cid'];
        } else {
            $this->cid = '';
        }

        if (isset($donnees['uid'])) {
            $this->uid = $donnees['uid'];
        } else {
            $this->uid = '';
        }
       /* 
        if (isset($donnees['date'])) {
            $this->date = $donnees['date'];
        } else {
            $this->date = '';
        }
        
       */
        
        if (isset($donnees['message'])) {
            $this->message = $donnees['message'];
        } else {
            $this->message = '';
        }

    }

}

