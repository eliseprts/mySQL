<?php

		// CONNEXION À LA DB
		try {
			// Connexion à MySQL
			$db = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', 'root');
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
		
		// VARIABLES
		$name = $_POST['name'];
		$distance = $_POST['distance'];
		$duration = $_POST['duration'];
		$height_difference = $_POST['height_difference'];

		if ($_POST['difficulty'] == 'très facile') {
			$difficulty = 'Très facile';
		} elseif ($_POST['difficulty'] == 'facile') {
			$difficulty = 'Facile';
		} elseif ($_POST['difficulty'] == 'moyen') {
			$difficulty = 'Moyen';
		} elseif ($_POST['difficulty'] == 'difficile') {
			$difficulty = 'Difficile';
		} else {
			$difficulty = 'Très difficile';
		}

		// REQUÊTE SQL
		$insertHiking = $db->prepare('INSERT INTO hiking(name, difficulty, distance, duration, height_difference) VALUES(:name, :difficulty, :distance, :duration, :height_difference)');
		$insertHiking->execute([
			'name' => $name,
			'difficulty' => $difficulty,
			'distance' => $distance,
			'duration' => $duration,
			'height_difference' => $height_difference,
		]);

		// NOTIFICATION AJOUT
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			echo '<p>La randonnée a bien été ajoutée avec succès !</p>';
		}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/php-pdo/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
