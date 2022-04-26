<?php

	include_once('mysql.php');

	// 	RÉCUPÉRATION DONNÉES EN FONCTION DE L'ID
	$retrieveHiking = $db->prepare('SELECT * FROM hiking WHERE id = :id');
	$retrieveHiking->execute([
		'id' => $_GET['id'],
	]);

	$hiking = $retrieveHiking->fetch(PDO::FETCH_ASSOC);

	// ENVOI DES MODIFICATIONS

	// Variables
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

	// $name = $_POST['name'];
	// $distance = $_POST['distance'];
	// $duration = $_POST['duration'];
	// $height_difference = $_POST['height_difference'];
	// $available = $_POST['available'];

	// switch($_POST['difficulty']) {
	// 	case 'très facile' :
	// 		$difficulty = 'Très facile';
	// 		break;
	// 	case 'facile' :
	// 		$difficulty = 'Facile';
	// 		break;
	// 	case 'moyen' :
	// 		$difficulty = 'Moyen';
	// 		break;
	// 	case 'difficile' :
	// 		$difficulty = 'Difficile';
	// 		break;
	// 	case 'très difficile' :
	// 		$difficulty = 'Très difficile';
	// 		break;
	// }

	// Requête SQL
	$updateHiking = $db->prepare('UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference, available = :available WHERE id = :id');
	$updateHiking->execute([
		'name' => $name,
		'difficulty' => $difficulty,
		'distance' => $distance,
		'duration' => $duration,
		'height_difference' => $height_difference,
		'available' => $available,
		'id' => $_GET['id'],
	]);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Modifier</h1>


	<form action="" method="post">
		<div>
			<label for="id">Identifiant de la randonnée</label>
			<input id="id" name="id" value="<?php echo($_GET['id']); ?>">
		</div>
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo($hiking['name']); ?>">
			<!-- <span style="color:red;">* <?php echo $nameErr; ?></span> -->
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
				<span style="color:red;">* <?php echo $difficultyErr; ?></span>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance (en kilomètres)</label>
			<input type="text" name="distance" value="<?php echo($hiking['distance']); ?>">
			<span style="color:red;">* <?php echo $distanceErr; ?></span>
		</div>
		<div>
			<label for="duration">Durée (en heures)</label>
			<input type="duration" name="duration" value="<?php echo($hiking['duration']); ?>">
			<!-- <span style="color:red;">* <?php echo $durationErr; ?></span> -->
		</div>
		<div>
			<label for="height_difference">Dénivelé (en mètres)</label>
			<input type="text" name="height_difference" value="<?php echo($hiking['height_difference']); ?>">
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
		<button type="submit" name="button">Modifier</button>
	</form>
</body>
</html>
