<?php

    include_once('mysql.php');

    // SUPPRESSION
    $deleteHiking = $db->prepare('DELETE FROM hiking WHERE id = :id');
    $deleteHiking->execute([
        'id' => $_GET['id'],
    ]);

    // NOTIFICATION SUPPRESSION
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
		echo '<p>La randonnée a été supprimée avec succès !</p>';
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <a href="read.php">Liste des données</a>
    <h1>Supprimer définitivement la randonnée ?</h1>

    <form action="" method="post">
        <button type="submit" name="delete">Supprimer</button>
    </form>

</body>
</html>