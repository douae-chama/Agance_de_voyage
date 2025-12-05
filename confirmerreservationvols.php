<?php
session_start();
include "connexion.php";

if (!isset($_SESSION['id'])) {
    die("Utilisateur non connecté.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_utilisateur = $_SESSION['id'];

    
    $stmt = $connexion->prepare("SELECT IdClient FROM Clients WHERE id_utilisateur = ?");
    $stmt->execute([$id_utilisateur]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Client introuvable.");
    }

    $id_client = $client['IdClient'];

    
    $id_vol = $_POST['id_vol'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $number = $_POST['number'];
    $prix = $_POST['prix'];

    $query = $connexion->prepare("SELECT * FROM Vols WHERE IdVol = :id_vol");
    $query->bindParam(':id_vol', $id_vol, PDO::PARAM_INT);
    $query->execute();
    $vol = $query->fetch(PDO::FETCH_ASSOC);

    if (!$vol) {
        die("Vol non trouvé.");
    }
    $prixUnitaire = $prix; // Prix unitaire du vol
    $prixTotal = $prix * $number;

    $query = $connexion->prepare("
        INSERT INTO Reservations (IdClient, IdVol, Nom, Prenom, Telephone, Email, Adresse, NombrePersonnes, DateReservation, prixtotal)
        VALUES (:id_client, :id_vol, :nom, :prenom, :telephone, :email, :adresse, :number, NOW(), :prixtotal)
    ");

    $query->execute([
        'id_client' => $id_client,
        'id_vol' => $id_vol,
        'nom' => $nom,
        'prenom' => $prenom,
        'telephone' => $telephone,
        'email' => $email,
        'adresse' => $adresse,
        'number' => $number,
        'prixtotal' => $prixTotal
    ]);

    echo "<div class='confirmation-container'>";
    echo "<h2>Réservation Confirmée !</h2>";
    echo "<p><strong>Vol:</strong> " . htmlspecialchars($vol['Destination']) . " - " . htmlspecialchars($vol['Compagnie']) . "</p>";
    echo "<p><strong>Nom:</strong> " . htmlspecialchars($nom) . "</p>";
    echo "<p><strong>Prénom:</strong> " . htmlspecialchars($prenom) . "</p>";
    echo "<p><strong>Téléphone:</strong> " . htmlspecialchars($telephone) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Adresse:</strong> " . nl2br(htmlspecialchars($adresse)) . "</p>";
    echo "<p><strong>Nombre de Personnes:</strong> " . htmlspecialchars($_POST['number']) . "</p>";
    echo "<p><strong>Prix Unitaire:</strong> " . htmlspecialchars($prixUnitaire) . " DH</p>";
    echo "<p><strong>Prix Total:</strong> " . htmlspecialchars($prixTotal) . " DH</p>";
    echo "<p><strong>Date de Réservation:</strong> " . date('Y-m-d H:i:s') . "</p>";
    echo "<p>Merci d'avoir réservé avec nous. Vous recevrez un email de confirmation bientôt.</p>";
    echo "</div>";
} else {
    echo "Aucune donnée reçue.";
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="confirmreservation.css">
    <link rel="stylesheet" href="c lientres.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>

<body>
    <div class="floating-btn">
  <a href="mesreservation.php" title="Mes reservation">
    <i class="fa fa-calendar-check"></i>
  </a>
</div>
    <div class="navbar">
        <div class="logo">
            <img src="photo et logo/logo3.png" alt="Logo" />
        </div>
        <ul>
            <li><a href="services.php">Accueil</a></li>
            <li><a href="vols.php">Vols</a></li>
            <li><a href="bateaux.php">Bateaux</a></li>
            <li><a href="hotel.php">Hotels</a></li>
            <li><a href="circuit.php">Circuit Touristique</a></li>
            <li><a href="voyage.php">Voyages</a></li>
            <li><a href="contact2.php">Contact</a></li>
            <li><a href="deconnexion.php">Se déconnecter</a></li>
        </ul>
    </div>
    <section class="social-section"><BR>
        <h3>TROUVEZ-NOUS SUR</h3><BR>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-snapchat"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
    </section>
</body>

</html>