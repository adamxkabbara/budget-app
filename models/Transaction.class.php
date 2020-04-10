<?php
ini_set('display_errors', 1);

    class Transaction {
        public $idTransaction;
        public $idUser;
        public $idItem;
        public $merchant;
        public $amount;
        public $date;
        public $category;
        public $notes;
        public $status;
    
        public function __construct($idTransaction=null, $idUser=null, $idItem=null, $merchant=null, $amount=null, $date=null, $category=null, $notes=null, $status=null) {
    
          $this->idTransaction = $idTransaction;
          $this->idUser = $idUser;
          $this->idItem = $idItem;
          $this->merchant = $merchant;
          $this->amount = $amount;
          $this->date = $date;
          $this->category = $category;
          $this->notes = $notes;
          $this->status = $status;
        }
    }