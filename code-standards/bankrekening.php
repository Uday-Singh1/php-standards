<?php

class Bankrekening {
    public $banknummer = 'NL05 342342345';
    public $balans = null;
    public $bedragToevoegen;
    public $nieuwGeld;
    public $bedragOnttrekken;
    public $nieuwGeldMin;

    public function toevoegen() {
        $this->bedragToevoegen = 100;
        $this->nieuwGeld = $this->balans + $this->bedragToevoegen;
        echo $this->nieuwGeld;
    }

    public function onttrekken() {
        if ($this->bedragOnttrekken === $this->balans) {
            echo "te weinig geld";
        } else {
            $this->bedragOnttrekken = 100;
            $this->nieuwGeldMin = $this->balans - $this->bedragOnttrekken;
            echo $this->nieuwGeldMin;
        }
    }
}

class BankrekeningPlus extends Bankrekening {
    public $limiet = 1000;
    public $rente;

    public function onttrekken() {
        if ($this->balans === 1000) {
            echo "te weinig geld";
        } else {
            $this->bedragOnttrekken = 100;
            $this->nieuwGeldMin = $this->balans - $this->bedragOnttrekken;
            echo $this->nieuwGeldMin;
        }
    }

    public function rente() {
        $this->rente = $this->balans * 0.05;
        echo $this->rente;
    }
  
    public function getSummary() {
        echo 'Banknummer: ' . $this->banknummer . '<br>';
        if ($this->balans === 0) {
            echo 'Saldo: <br>';
        } else {
            echo 'Saldo: ' . number_format($this->balans, 2) . '<br>';
        }
        echo 'Rente: ' . $this->rente . '<br>';
        echo 'Datum: ' . date('d-m-Y');
    }
}

$rekening = new BankrekeningPlus();
$rekening->rente(); // geeft de waarde van de $rente-property
$rekening->getSummary(); // geeft de waarde van de $banknummer, $balans, $rente-eigenschappen en de huidige datum



class UserAccount {
    public $bankAccount;
    public $bankAccountPlus;

    public function __construct() {
        $this->bankAccount = null;
        $this->bankAccountPlus = null;
    }

    public function createBankAccount() {
        if ($this->bankAccount === null) {
            $this->bankAccount = new Bankrekening();
            return true;
        } else {
            echo "Er is al een bankrekening.<br>";
            return false;
        }
    }

    public function createBankAccountPlus() {
        if ($this->bankAccountPlus === null && $this->bankAccount !== null) {
            $this->bankAccountPlus = new BankrekeningPlus();
            echo "Bankrekening Plus Geopend<br>";
            return true;
        } else {
            echo "Kan geen Bankrekening Plus Openen.<br>";
            return false;
        }
    }
}

$userAccount = new UserAccount();
if ($userAccount->createBankAccount()) {
    echo "Bankrekening Geopend!<br>";
}
$userAccount->createBankAccountPlus();

?>