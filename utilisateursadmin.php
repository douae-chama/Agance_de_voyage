<?php
include 'connexion.php';
$erreur = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $mdp = $_POST["mdp"] ?? '';
    $confirm = $_POST["confirm"] ?? '';

    if (empty($email) || empty($mdp) || empty($confirm)) {
        $erreur = " Tous les champs sont obligatoires.";
    } elseif ($mdp !== $confirm) {
        $erreur = " Les mots de passe ne correspondent pas.";
    } else {
        if (strlen($mdp) >= 6 && preg_match('/[0-9]/', $mdp) && preg_match('/[a-z]/', $mdp) && preg_match('/[A-Z]/', $mdp)) {
            $type_user = 'admin';
            
        } else {
            $erreur = " Mot de passe faible. Il doit contenir au moins 6 caractères, un chiffre, une lettre majuscule et une lettre minuscule.";
        }        

        if (empty($erreur)) {
            $query = "INSERT INTO Utilisateur (email, password, type_user) VALUES (:email, :password, :type_user)";
            $pdostmt = $connexion->prepare($query);
            $pdostmt->execute([
                ':email' => $_POST["email"],
                ':password' => $_POST["mdp"],
                ':type_user' => $type_user
            ]);
            $pdostmt->closeCursor();
            header("Location:menu.php");
            

            $success = " Inscription réussie en tant que $type_user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>Formulaire d'inscription</h2>

    <?php if (!empty($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>
    <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" maxlength="50" required><br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" maxlength="40" required><br><br>

        <label for="confirm">Confirmation du mot de passe :</label><br>
        <input type="password" id="confirm" name="confirm" maxlength="40" required><br><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
