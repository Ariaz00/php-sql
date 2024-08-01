<?php
include './db/connexiondb.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $sql = 'DELETE FROM utilisateurs WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        header('Location: index.php?success=Utilisateur mis à jours avec succès');
    }else{
        header('Location: index.php?error=Erreur lors de la mise à jours de l\'utilisateur');
    }
}



?>