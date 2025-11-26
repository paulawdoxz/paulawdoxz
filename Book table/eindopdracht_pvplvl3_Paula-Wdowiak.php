<?php

// Al die uitleg is ook voor mij om de code beter te begrijpen en beter te leren
// Het was best een moeilijke opdracht, heb chatGPT gebruikt om dingen te fixen, maar ik zorgde om alles toch goed te begrijepn
// - Paula Wdowiak 

function formatName($naam) {
    $geformatteerdeNaam = ''; // Het is leeg om later de "gefixte" naam te weergeven
    
    for ($i = 0; $i < strlen($naam); $i++) { //Loop om door elke karakter in de $naam heen gaan
        $char = $naam[$i]; //Eerste letter 

        if ($i == 0 || $naam[$i - 1] == ' ' || $naam[$i - 1] == '.') { //Het controleert voor eerste letter, spaties en punten
            $geformatteerdeNaam .= strtoupper($char);  //Als het eerste letter, spatie of punt bevat, wordt het een hoofdletter
        } else {
            $geformatteerdeNaam .= $char;  // Als de voorwaarde "if" niet waar is, dit "else" zorgt om andere letters onveranderd blijven
        }
    }

    return $geformatteerdeNaam; // Na die hele proces van functie, geeft het de juiste naam terug
}

$boeken = [
    "Harry Potter en de Steen der Wijzen" => ["auteur" => "j.k. rowling", "jaar" => 1997],
    "De Hobbit" => ["auteur" => "J.r.r. Tolkien", "jaar" => 1937],
    "Het spel der tronen" => ["auteur" => "George R.R. martin", "jaar" => 1996],
    "1984" => ["auteur" => "George Orwell", "jaar" => 1949],
    "Moord op de Oriënt-Expres" => ["auteur" => "Agatha Christie", "jaar" => 1934],
    "Moby Dick" => ["auteur" => "herman melville", "jaar" => 1851],
    "To Kill a Mockingbird" => ["auteur" => "harper lee", "jaar" => 1960],
    "Pride and Prejudice" => ["auteur" => "jane austen", "jaar" => 1813],
    "Onmacht" => ["auteur" => "Charles den tex", "jaar" => 2010], //speciaal kleine letters voor onze functie
    "Ruination" => ["auteur" => "Anthony reynolds", "jaar" => 2022]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekentabel</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #e6e6fa;
        }
    </style>
</head>
<body>

<h1>Eindopdracht PHP level 3</h1>
<table>
    <thead>
        <tr>
            <th>Titel</th>
            <th>Auteur</th>
            <th>Jaar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($boeken as $boekTitel => $boekDetail): ?>  <!-- Deze deel vroeg ik aan de chatGPT hoe het precies moest, tijdens de les wou ik meekijken maar ik kon niet helemaal zien want ik was te ver vanaf de bord -->
            <tr>
                <!--Maar ik begrijp wat hier allemaal gebeurt, die vraagteken en php moet bij elke regel met code want anders ziet het als html en geen code -->
                <td><?php echo $boekTitel; ?></td>               <!--Boektitel is de titel, sleutel, boekDetail is de waarde, dus auteur en jaar -->
                <td><?php echo formatName($boekDetail['auteur']); ?></td>    <!-- Binnen deze foreach loop, beide gegevens (waarden en sleutels) worden weergegeven in een nieuwe rij -->
                <td><?php echo $boekDetail['jaar']; ?></td>      <!-- Met deze methode het is best simpel, CSS hierboven zorgt voor de kleurtjes als met de muis hover -->
            </tr>
        <?php endforeach; ?>    <!-- Had veel moeite met deze opdracht, want helaas kon ik niet meekijken tijdens de les, het lijkt wel op een simpelere methode van uitwerking van deze opdracht -->
    </tbody>
</table>

</body>
</html>
