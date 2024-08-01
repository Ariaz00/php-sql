<?php
require_once './db/connexiondb.php';

$codesql = $db->prepare("SELECT * FROM utilisateurs");
$codesql->execute();
$result = $codesql->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Document</title>
</head>

<body>
<h1>Liste des Utilisateurs</h1>
    <div class="form">
        <form action="process.php" method="POST">
            <div>
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" id="mail" name="mail" required>
            </div>
            <div>
                <label for="codePostale">Code Postal</label>
                <input type="number" name="code_postal" id="code_postal" required>
            </div>
            <div class="ajouter">
                <button type="submit" name="action" value="ajouter">Ajouter</button>
            </div>
        </form>
    </div>
  
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Code Postal</th>
                <th>Actions</th>
            </tr>
        </thead>


        <?php
        foreach ($result as $value) {
            if (isset($_GET['edit_id']) && $_GET['edit_id'] == $value['id']) {
                // Champs de saisie pour l'édition
                echo "<form action='update.php' method='POST'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($value['id']) . "'>";
                echo "<tr class='edit-form'>";
                echo "<td><input type='text' name='nom' class='inline-input' value='" . htmlspecialchars($value['nom']) . "' required></td>";
                echo "<td><input type='text' name='prenom' class='inline-input' value='" . htmlspecialchars($value['prenom']) . "' required></td>";
                echo "<td><input type='email' name='mail' class='inline-input' value='" . htmlspecialchars($value['mail']) . "' required></td>";
                echo "<td><input type='number' name='code_postal' class='inline-input' value='" . htmlspecialchars($value['code_postal']) . "' required></td>";
                echo "<td class='edit-buttonss'>
                <button type='submit'>Enregistrer</button>
                <a href='index.php' class='no-style'>Annuler</a>
              </td>";
                echo "</tr>";
                echo "</form>";
            } else {
                // Les données de l'utilisateur
                echo "<tr>";
                echo "<td>" . htmlspecialchars($value['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($value['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($value['mail']) . "</td>";
                echo "<td>" . htmlspecialchars($value['code_postal']) . "</td>";
                echo "<td class='edit-buttons'>
                <form action='index.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='edit_id' value='" . htmlspecialchars($value['id']) . "'>
                    <button type='submit'>Modifier</button>
                </form>
                <form action='delete.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\");'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($value['id']) . "'>
                    <button type='submit'>Supprimer</button>
                </form>
              </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>