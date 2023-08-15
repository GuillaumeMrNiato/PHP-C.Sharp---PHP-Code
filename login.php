<?php 
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputemail = $_POST["email"];
    $inputPassword = $_POST["password"];
    $escapedemail = $conn->real_escape_string($inputemail);
    $escapedPassword = $conn->real_escape_string($inputPassword);

    $query = "SELECT * FROM user WHERE email = '$escapedemail'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if (password_verify($escapedPassword, $storedPassword)) {
            $_SESSION["connected"] = true;
            echo "Connexion réussie !";
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    $conn->close();
}
?>
