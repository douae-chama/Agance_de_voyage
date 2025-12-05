<?php
include("Connexion.php");

if (!empty($_GET["id"])) {
    $clientId = $_GET["id"];

    // Récupérer l'id_utilisateur du client à supprimer
    $query = "SELECT id_utilisateur FROM Clients WHERE IdClient = :id";
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([":id" => $clientId]);
    $clientData = $pdostmt->fetch(PDO::FETCH_ASSOC);

    // Si un utilisateur associé est trouvé
    if ($clientData) {
        $userId = $clientData["id_utilisateur"];

        // Commencer une transaction pour assurer l'intégrité des données
        $connexion->beginTransaction();

        try {
            // Supprimer l'utilisateur de la table Utilisateur
            $queryDeleteUser = "DELETE FROM Utilisateur WHERE id = :userId";
            $pdostmt = $connexion->prepare($queryDeleteUser);
            $pdostmt->execute([":userId" => $userId]);

            // Supprimer le client de la table Clients
            $queryDeleteClient = "DELETE FROM Clients WHERE IdClient = :id";
            $pdostmt = $connexion->prepare($queryDeleteClient);
            $pdostmt->execute([":id" => $clientId]);

            // Valider la transaction
            $connexion->commit();

            // Rediriger vers la confirmation de la suppression
            header("Location:confirmationclientsup.php?etat=ok&id=$clientId");
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            $connexion->rollBack();
            header("Location:confirmationclientsup.php?etat=echec&id=$clientId");
        }
    } else {
        // Si le client n'existe pas
        header("Location:confirmationclientsup.php?etat=echec&id=$clientId");
    }
}
?>
