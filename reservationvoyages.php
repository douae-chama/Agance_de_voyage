<?php
include 'connexion.php';
if (isset($_GET['id_voyage'])) {
    $id_voyage = $_GET['id_voyage'];
    $query = $connexion->prepare("SELECT * FROM Voyages WHERE IdVoyage = :id_voyage");
    $query->bindParam(':id_voyage', $id_voyage, PDO::PARAM_INT);
    $query->execute();
    $Voyage = $query->fetch(PDO::FETCH_ASSOC);
    if (!$Voyage) {
        die("Voyage non trouvé.");
    }
} else {
    die("ID du Voyage non fourni.");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation du Voyage</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="c lientres.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="floating-btn">
        <a href="mesreservation.php" title="Mes reservation">
            <i class="fa fa-calendar-check"></i>
        </a>
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
    <div class="container">
        <div class="vol-info">
            <h3>Détails du Voyage</h3>
            <p><strong>Destination:</strong> <?= htmlspecialchars($Voyage['Destination']) ?></p>
            <p><strong>Titre:</strong> <?= htmlspecialchars($Voyage['Titre']) ?></p>
            <p><strong>Description du Voyage:</strong> <?= htmlspecialchars($Voyage['Description']) ?></p>
            <p><strong>Date de départ:</strong> <?= htmlspecialchars($Voyage['DateDepart']) ?></p>
            <p><strong>Date de Reteur:</strong> <?= htmlspecialchars($Voyage['DateRetour']) ?></p>
            <p><strong>Prix:</strong> <?= number_format($Voyage['Prix'], 2) ?>dh</p>
            <?php if (!empty($Voyage['image'])): ?>
                <img src="photo et logo/<?= htmlspecialchars($Voyage['image']) ?>" alt="Image du voyage">
            <?php else: ?>
                <img src="photo/default.jpg" alt="Image par défaut du voyage">
            <?php endif; ?>
        </div>
        <div class="form-container2">
            <h3>Formulaire de Réservation</h3>
            <form method="POST" action="confirmerreservationvoyages.php">
                <input type="hidden" name="id_voyage" value="<?= $Voyage['IdVoyage'] ?>">

                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="telephone">Téléphone:</label>
                <input type="tel" id="telephone" name="telephone" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="email">Numbre de personnes:</label>
                <input type="number" id="number" name="number" required>

                <label for="adresse">Adresse:</label>
                <textarea id="adresse" name="adresse" required></textarea>

                <button type="submit">Confirmer la Réservation</button>
            </form>
        </div>
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