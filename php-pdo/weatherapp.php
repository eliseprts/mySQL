<?php

// CONNEXION A LA BASE DE DONNEES
try
{
    // Connexion à MySQL
    $db = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, affichafe d'un message et arrêt de tout
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>WeatherApp</title>
</head>
<body class="m-5">
    <h1 class="fs-1 text fw-light text-uppercase text-primary text-center pyb-5">WheatherApp</h1>
    <div class="container py-5">
        <div class="row">
            <div class="col-6">
                <form action="" method="POST">
                    <table class="table">
                        <tr class="table-primary">
                            <th></th>
                            <th class="text-uppercase">Ville</th>
                            <th class="text-uppercase">Température maximale</th>
                            <th class="text-uppercase">Température minimale</th>
                        </tr>
                            <?php
                                // RECUPERATION CONTENU DE LA TABLE METEO
                                $result = $db->query('SELECT * FROM Météo');
                                $data = $result->fetch();
                                while ($data = $result->fetch()) {
                                    echo 
                                        '<tr>
                                            <th><input type="checkbox" name="city[]" value="' . $data['ville'] . '"></th>
                                            <th>' . $data['ville'] . '</th>
                                            <td>' . $data['haut'] . '</td>
                                            <td>' . $data['bas'] . '</td>
                                        </tr>';
                                }
                                $result->closeCursor();
                            ?>
                    </table>
                            <?php
                                if(isset($_POST['city'])) {
                                    foreach($_POST['city'] as $value) {
                                        $deleteCity = $db->prepare('DELETE FROM Météo WHERE ville = :ville');
                                        $deleteCity->execute([
                                            'ville' => $value,
                                        ]);
                                    }
                                }
                            ?>
                    <input type="submit" name="submit" value="Supprimer" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            <h2 class="fs-4">Ajouter une ville</h2>
            <form action="" method="POST">

            <?php

                $cityErr = $higherTemperatureErr = $lowerTemperatureErr = "";
                $city = $higherTemperature = $lowerTemperature = "";

                // VÉRIFICATION DU FORMULAIRE SOUMIS ET RECUPERATION DONNÉES
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    if(empty($_POST['city'])) {
                        $cityErr = "Le nom d'une ville est requis";
                    } else {
                        $city = $_POST['city'];
                    }
                    
                    if(empty($_POST['higherTemperature'])) {
                        $higherTemperatureErr = "La température maximale est requise";
                    } else {
                        $higherTemperature = $_POST['higherTemperature'];
                    }
                    
                    if(empty($_POST['lowerTemperature'])) {
                        $lowerTemperatureErr = "La température minimale est requise";
                    } else {
                        $lowerTemperature = $_POST['lowerTemperature'];
                    }
                }

                // REQUÊTE SQL

                // Préparation
                $insertCity = $db->prepare('INSERT INTO Météo(ville, haut, bas) VALUES (:city, :higherTemperature, :lowerTemperature)');

                // Exécution
                $insertCity->execute([
                    'city' => $city,
                    'higherTemperature' => $higherTemperature,
                    'lowerTemperature' => $lowerTemperature,
                ]);
                // header("Location:/mySQL/php-pdo/weatherapp.php");
                // $db->closeCursor();

            ?>

                <div class="mb-3">
                    <label for="city" class="fw-light">Ville</label>
                    <input type="text" name="city">
                    <span class="text-danger fw-lighter fs-6">* <?php echo $cityErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="higherTemperature" class="fw-light">Température maximale</label>
                    <input type="text" name="higherTemperature">
                    <span class="text-danger fw-lighter fs-6">* <?php echo $higherTemperatureErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="lowerTemperature" class="fw-light">Température minimale</label>
                    <input type="text" name="lowerTemperature">
                    <span class="text-danger fw-lighter fs-6">* <?php echo $lowerTemperatureErr; ?></span>
                </div>
                <input type="submit" name="submit" value="Ajouter" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
</html>