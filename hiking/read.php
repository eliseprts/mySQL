<!-- CONNEXION À LA BASE DE DONNÉES -->
<?php
    include_once('mysql.php');


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
        <th>Accessible</th>
      </tr>

      <a href=""></a>

      <?php
        // RÉCUPÉRATION CONTENU DE LA TABLE HIKING
        $result = $db->query('SELECT * FROM hiking');
        while ($data = $result->fetch()) {
          echo
            '<tr>
                <td>' . $data['id'] . '</td>
                <td><a href="update.php?id=' . $data['id'] . '">' . $data['name'] . '</a></td>
                <td>' . $data['difficulty'] . '</td>
                <td>' . $data['distance'] . '</td>
                <td>' . $data['duration'] . '</td>
                <td>' . $data['height_difference'] . '</td>
                <td>' . $data['available'] . '</td>
                <td><a href="delete.php?id=' . $data['id'] . '">Supprimer</a></td>
            </tr>';
        }
        $result->closeCursor();
      ?>

    </table>
    <div>
      <a href="create.php" target="_blank">Ajouter une randonnée</a>
    </div>
  </body>
</html>
