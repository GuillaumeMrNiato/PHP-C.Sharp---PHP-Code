<?php
include 'connect.php';

if (isset($_POST['prenom'])) 
{
    $prenom = $_POST['prenom'];

    $stmt = $conn->prepare("INSERT INTO user (prenom) VALUES (?)");
    $stmt->bind_param("s", $prenom);

    if ($stmt->execute() === TRUE) {
        echo "Le prénom a été inséré avec succès dans la table user.";
    } else {
        echo "Erreur lors de l'insertion du prénom : " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} 
else 
{
    echo "Le prénom n'a pas été envoyé depuis le logiciel C#.";
}
?>
