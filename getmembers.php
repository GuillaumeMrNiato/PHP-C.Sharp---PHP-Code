<?php
include 'connect.php';

$sql = "SELECT id, prenom, nom, email, commentaire FROM user"; // Sélectionnez également l'ID et l'email
$result = $conn->query($sql);
$members = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $member = array(
            "id" => $row['id'],
            "prenom" => $row['prenom'],
            "nom" => $row['nom'],
            "email" => $row['email'],
            "commentaire" => $row['commentaire']
        );
        $members[] = $member;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($members);
?>
