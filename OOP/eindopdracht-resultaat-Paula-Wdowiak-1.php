<?php


class Weg {
    private $afstand;
    private $vertraging;


    // init is hier gebruikt om te verwijzen naar een methode die een object/class instelt
    public function init($afstand, $vertraging) {
        $this->afstand = $afstand;
        $this->vertraging = $vertraging;
    }

    public function getAfstand() {
        return $this->afstand;
    }

    public function getVertraging() {
        return $this->vertraging;
    }
}

class Voertuig {
    //Protected hadden we ook niet perse, het betekent dat het toegankelijk is binnen de klasse en in de afgeleide klassen, zoals fiets/scooter (nog steeds niet buiten de klasse zoals public)
    //Waarom niet private dan? met private kan je alleen binnen de klasse en niet in de afgeleide klasses
    protected $bandenspanning;
    protected $maxSnelheid;

    public function init($bandenspanning, $maxSnelheid) {
        $this->bandenspanning = $bandenspanning;
        $this->maxSnelheid = $maxSnelheid;
    }

    public function getSnelheid() {
        return ($this->bandenspanning / 100) * $this->maxSnelheid;
    }

    public function berekenReistijd($afstand) {
        return $afstand / $this->getSnelheid();
    }
}

class Fiets extends Voertuig {
    public function init($bandenspanning, $elektrisch) {
        $maxSnelheid = $elektrisch ? 25 : 15;
        parent::init($bandenspanning, $maxSnelheid);
    }
}

class Scooter extends Voertuig {
    private $vertraging;

    public function init($bandenspanning, $maxSnelheid) {
        parent::init($bandenspanning, $maxSnelheid); 
    }

    public function initScooter($vertraging) {
        $this->vertraging = $vertraging;
    }

    public function berekenReistijd($afstand) {
        return ($afstand / $this->getSnelheid()) + ($this->vertraging / 60);
    }
}

// Dit is om de formulier te laten verwerken
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $afstand = $_POST['afstand'];
    $vertraging = $_POST['vertraging'];
    $bandenspanning = $_POST['bandenspanning'];
    $voertuig = $_POST['voertuig'];
    
    $weg = new Weg();
    $weg->init($afstand, $vertraging);

    $fiets = new Fiets();
    $fiets->init($bandenspanning, $voertuig == 'elektrische_fiets' ? 25 : 15); 

    $scooter = new Scooter();
    $scooter->init($bandenspanning, $voertuig == 'snorscooter' ? 25 : 45); 
    $scooter->initScooter($weg->getVertraging()); 

    $tijdFiets = $fiets->berekenReistijd($weg->getAfstand());
    $tijdScooter = $scooter->berekenReistijd($weg->getAfstand());
    
    $advies = $tijdFiets < $tijdScooter ? 'fiets' : 'scooter';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OOP eindopdracht</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: rgb(239, 205, 231);
        }

        .container { 
            max-width: 500px; 
            margin: auto; 
            background-color: rgb(210, 205, 231);
            padding: 30px;
            border-radius: 30px;
            border: solid black;
        }

        label, input, select { 
            display: block; 
            margin: 10px 0; 
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Reisadvies</h2>
        <p>Beste optie: <strong><?php echo ucfirst($advies); ?></strong></p>
        <p>Reistijd fiets: <?php echo round($tijdFiets, 2); ?> uur</p>
        <p>Reistijd scooter: <?php echo round($tijdScooter, 2); ?> uur</p>
        <a href="eindopdracht-formulier-Paula-Wdowiak-1.php">Nog een keer?</a>
    </div>
</body>
</html>

