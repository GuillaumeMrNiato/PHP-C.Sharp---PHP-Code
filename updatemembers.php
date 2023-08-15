<?php
include 'connect.php';

if (isset($_POST['colonne']) && isset($_POST['id']) && isset($_POST['nouvelle_valeur'])) 
{
    $colonne = $_POST['colonne'];
    $id = $_POST['id'];
    $nouvelleValeur = $_POST['nouvelle_valeur'];

    $stmt = null;
    switch ($colonne) {
        case 'Prénom':
            $stmt = $conn->prepare("UPDATE user SET prenom = ? WHERE id = ?");
            break;
        case 'Nom':
            $stmt = $conn->prepare("UPDATE user SET nom = ? WHERE id = ?");
            break;
        case 'Email':
            $stmt = $conn->prepare("UPDATE user SET email = ? WHERE id = ?");
            break;
        case 'Commentaire':
            $stmt = $conn->prepare("UPDATE user SET commentaire = ? WHERE id = ?");
            break;
        default:
            echo "Colonne non gérée.";
            exit();
    }

    if ($stmt) {
        $stmt->bind_param("si", $nouvelleValeur, $id);

        if ($stmt->execute() === TRUE) 
        {
            echo "La valeur a été mise à jour avec succès.";
        } else 
        {
            echo "Erreur lors de la mise à jour de la valeur : " . $conn->error;
        }

        $stmt->close();
    }
    
    $conn->close();
} 
else 
{
    echo "Les paramètres nécessaires sont absents de la requête.";
}
?>
