<?php

// CONNEXION A LA BASE DE DONNEES
try
{
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, affichafe d'un message et arrêt de tout
    die('Erreur : '.$e->getMessage());
}

// RECUPERATION DU CONTENU DE LA TABLE METEO
$sqlQuery = 'SELECT * FROM Météo';
$meteoStatement = $mysqlClient->prepare($sqlQuery);
$meteoStatement->execute();
$meteo = $meteoStatement->fetchAll();

// AFFICHER
foreach ($meteo as $city) {
    ?>
    <p><?php echo $city['ville']; ?></p>
    <?php
}
?>