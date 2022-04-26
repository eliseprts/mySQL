<?php

		// CONNEXION À LA DB
		include_once('mysql.php');
		
		// VARIABLES
		$name = $distance = $duration = $height_difference = $difficulty = $available = "";
		$nameErr = $distanceErr = $durationErr = $height_differenceErr = $difficultyErr = $availableErr = "";

		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			if(empty($_POST['name'])) {
				$nameErr = "Champs requis";
			} else {
				$name = $_POST['name'];
			}

			if(empty($_POST['distance']) || !is_numeric($_POST['distance'])) {
				$distanceErr= "Un nombre est requis";
			} else {
				$distance = $_POST['distance'];
			}

			if(empty($_POST['duration'])) {
				$durationErr= "Un nombre est requis";
			} else {
				$duration = $_POST['duration'];
			}
			
			// if(empty($_POST['duration']) || !is_numeric($_POST['duration'])) {
			// 	$durationErr= "Un nombre est requis";
			// } else {
			// 	$duration = $_POST['duration'];
			// }

			if(empty($_POST['height_difference']) || !is_numeric($_POST['height_difference'])) {
				$height_differenceErr = "Un nombre est requis";
			} else {
				$height_difference = $_POST['height_difference'];
			}

			if (isset($_POST['difficulty']) == 'très facile') {
				$difficulty = 'Très facile';
			} elseif (isset($_POST['difficulty']) == 'facile') {
				$difficulty = 'Facile';
			} elseif (isset($_POST['difficulty']) == 'moyen') {
				$difficulty = 'Moyen';
			} elseif (isset($_POST['difficulty']) == 'difficile') {
				$difficulty = 'Difficile';
			} elseif (isset($_POST['difficulty']) == 'très difficile') {
				$difficulty = 'Très difficile';
			} else {
				$difficultyErr = "Champs requis";
			}

			if(isset($_POST['available']) == 'Oui') {
				$available = 'Oui';
			} elseif (isset($_POST['available']) == 'Non') {
				$available = 'Non';
			} else {
				$availableErr = 'Champs requis';
			}

		}

		// REQUÊTE SQL
		$insertHiking = $db->prepare('INSERT INTO hiking(name, difficulty, distance, duration, height_difference, available) VALUES(:name, :difficulty, :distance, :duration, :height_difference, :available)');
		$insertHiking->execute([
			'name' => $name,
			'difficulty' => $difficulty,
			'distance' => $distance,
			'duration' => $duration,
			'height_difference' => $height_difference,
			'available' => $available,
		]);

		// // NOTIFICATION AJOUT
		// if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// 	echo '<p style="color:green;">La randonnée a bien été ajoutée avec succès !</p>';
		// }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter une randonnée</h1>
	<form action="" method="post">
		<div>
			<label for="name">Nom de la randonnée</label>
			<input type="text" name="name" value="">
			<span style="color:red;">* <?php echo $nameErr; ?></span>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="null">Choississez une difficulté</option>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
			<span style="color:red;">* <?php echo $difficultyErr; ?></span>
		</div>

		<div>
			<label for="distance">Distance (en kilomètres)</label>
			<input type="text" name="distance" value="">
			<span style="color:red;">* <?php echo $distanceErr; ?></span>
		</div>
		<div>
			<label for="duration">Durée (en heures)</label>
			<input type="time" name="duration" value="">
			<span style="color:red;">* <?php echo $durationErr; ?></span>
		</div>
		<div>
			<label for="height_difference">Dénivelé (en mètres)</label>
			<input type="text" name="height_difference" value="">
			<span style="color:red;">* <?php echo $height_differenceErr; ?></span>
		</div>
		<div>
			<p>Accessible ?</p>
			<input type="radio" id="yes" name="available" value="Oui">
			<label for="yes">Oui</label>
			<input type="radio" id="no" name="available" value="Non">
			<label for="no">Non</label>
			<span style="color:red;">* <?php echo $availableErr; ?></span>
		</div>
		<button type="submit" name="insert">Ajouter</button>
	</form>
</body>
</html>
