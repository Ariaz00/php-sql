<?php
include './db/connexiondb.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $code_postal = $_POST['code_postal'];

    $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, mail = :mail, code_postal = :code_postal WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':code_postal', $code_postal);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        header('Location: ./index.php?success=Utilisateur mis à jour');
    }else{
        header('Location: ./index.php?error=Erreur pendant la mise à jours de l\'utilisateur');
    }
}
?>