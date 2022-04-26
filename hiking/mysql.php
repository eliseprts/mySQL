<!-- CONNEXION À LA BASE DE DONNÉES -->
<?php
try {
    // Connexion à MySQL
    $db = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', 'root');
} 
catch (Exception $e) {
    // Message d'erreur
    die('Erreur : ' . $e->getMessage());
}
?>