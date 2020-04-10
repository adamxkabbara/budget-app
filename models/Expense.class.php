<?php
ini_set('display_errors', 1);

class Expense {
    public $idExpense;
    public $idUser;
    public $idItem;
    public $merchant;
    public $amount;
    public $date;
    public $category;
    public $notes;
    public $status;

    public function __construct($idExpense=null, $idUser=null, $idItem=null, $merchant=null, $amount=null, $category=null, $notes=null, $date=null, $status=null) {

        $this->$idExpense = $idExpense;
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