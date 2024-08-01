<?php
include './db/connexiondb.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $codesql = $db->prepare(
                "INSERT INTO utilisateurs(nom, prenom, mail, code_postal)
                    VALUES(:nom, :prenom, :mail, :code_postal)"
            );

            $codesql->bindParam(':nom', $_POST['nom']);
            $codesql->bindParam(':prenom', $_POST['prenom']);
            $codesql->bindParam(':mail', $_POST['mail']);
            $codesql->bindParam(':code_postal', $_POST['code_postal']);

            $codesql->execute();
            // Rediriger vers index.php avec un message de succès
        header('Location: index.php?success=Utilisateur créé avec succès');
        exit();

            echo "Utilisateur ajouté !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    ?>