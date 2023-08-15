<?php 
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if ($nom && $prenom && $email && $password) {
        $motDePasseHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $prenom, $email, $motDePasseHash);

        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription : " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Données invalides.";
    }
}
?>
