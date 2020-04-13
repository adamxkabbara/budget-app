<?php
ini_set('display_errors', 1);

class Revenue {
    public $idRevenue;
    public $idUser;
    public $amount;
    public $date;


    public function __construct($idRevenue=null, $idUser=null, $amount=null, $date=null) {

        $this->$idRevenue = $idRevenue;
        $this->idUser = $idUser;
        $this->amount = $amount;
        $this->date = $date;
    }
}