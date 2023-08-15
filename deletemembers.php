<?php
include 'connect.php';

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) 
    {
        echo "Le membre a été supprimé avec succès.";
    } 
    else 
    {
        echo "Erreur lors de la suppression du membre : " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} 
else 
{
    echo "L'ID du membre est absent de la requête.";
}
?>
