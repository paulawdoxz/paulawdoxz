<!DOCTYPE html>
<html>
<head>

    <title>Eindopdracht OOP</title>

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
        <form action="eindopdracht-resultaat-Paula-Wdowiak-1.php" method="post">
         <label for="voertuig">Voertuig:</label>
         <select name="voertuig" id="voertuig">
                <option value="elektrische_fiets">Elektrische fiets</option>
                <option value="gewone_fiets">Gewone fiets</option>
                <option value="snorscooter">Snorscooter</option>
                <option value="bromscooter">Bromscooter</option>
         </select>
            <label for="bandenspanning">Bandenspanning:</label>
            <input type="number" name="bandenspanning" min="0" max="100">
            <label for="afstand">Afstand:</label>
            <input type="number" name="afstand" step="0.1">
            <label for="vertraging">Vertraging:</label>
            <input type="number" name="vertraging" step="1">
            <button type="submit">Bereken reistijd</button>
        </form>
    </div>
</body>
</html>