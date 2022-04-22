<!-- CONNEXION À LA BASE DE DONNÉES -->
<?php
try {
  // Connexion à MySQL
  $db = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', 'root');
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <!-- Afficher la liste des randonnées -->
      <tr>
        <th></th>
        <th>Nom de la randonnée</th>
        <th>Difficulté</th>
        <th>Distance (km)</th>
        <th>Durée</th>
        <th>Dénivelé (m)</th>
      </tr>

      <a href=""></a>

      <?php
        // RÉCUPÉRATION CONTENU DE LA TABLE HIKING
        $result = $db->query('SELECT * FROM hiking');
        while ($data = $result->fetch()) {
          echo
            '<tr>
                <td>' . $data['id'] . '</td>
                <td><a href="update.php">' . $data['name'] . '</a></td>
                <td>' . $data['difficulty'] . '</td>
                <td>' . $data['distance'] . '</td>
                <td>' . $data['duration'] . '</td>
                <td>' . $data['height_difference'] . '</td>
            </tr>';
        }
        $result->closeCursor();
      ?>

    </table>
  </body>
</html>
