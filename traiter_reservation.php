<?php
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupération des paramètres
    $id = $_POST['id_reservation'] ?? $_GET['id'] ?? null;
    $action = $_POST['action'] ?? $_GET['action'] ?? 'confirmer'; // par défaut "confirmer"
    $type = $_POST['type'] ?? $_GET['type'] ?? null; // type de réservation (vol, bateau, circuit, voyage, hotel)

    if (!$id) {
        echo "ID de réservation manquant.";
        exit;
    }

    if (!$type || !in_array($type, ['vol', 'bateau', 'circuit', 'voyage', 'hotel'])) {
        echo "Type de réservation invalide ou manquant.";
        exit;
    }

    // Déterminer le statut
    $nouveauStatut = ($action === 'annuler') ? 'Annulée' : 'Confirmée';

    try {
        // Préparer la mise à jour du statut
        $stmt = $connexion->prepare("UPDATE Reservations SET Statut = :statut WHERE IdReservation = :id");
        $stmt->bindParam(':statut', $nouveauStatut);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirection vers la page de la réservation selon le type
        switch ($type) {
            case 'vol':
                header("Location: res_vols.php?message=Statut mis à jour");
                break;
            case 'bateau':
                header("Location: res_bateaux.php?message=Statut mis à jour");
                break;
            case 'circuit':
                header("Location: res_circuits.php?message=Statut mis à jour");
                break;
            case 'voyage':
                header("Location: res_voyages.php?message=Statut mis à jour");
                break;
            case 'hotel':
                header("Location: res_hotels.php?message=Statut mis à jour");
                break;
        }
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}

