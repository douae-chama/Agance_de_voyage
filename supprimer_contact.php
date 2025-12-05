<?php
include("connexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    try {
        $stmt = $connexion->prepare("DELETE FROM Contact WHERE IdContact = :id");
        $stmt->execute(['id' => $id]);

        // Redirige après suppression
        header("Location: admincontact.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "Requête invalide.";
}
?>
