<?php
include 'connexion.php';
if (isset($_GET['id_hotel'])) {
    $id_hotel = $_GET['id_hotel'];
    $query = $connexion->prepare("SELECT * FROM Hotels WHERE IdHotel = :id_hotel");
    $query->bindParam(':id_hotel', $id_hotel, PDO::PARAM_INT);
    $query->execute();
    $hotel = $query->fetch(PDO::FETCH_ASSOC);
    if (!$hotel) {
        die("hotel non trouvé.");
    }
} else {
    die("ID du hotel non fourni.");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation du Hotel</title>
    <link rel="stylesheet" href="reservation.css">
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
    <div class="container">
        <div class="vol-info">
            <h3>Détails du Hotel</h3>
            <p><strong>Nom:</strong> <?= htmlspecialchars($hotel['Nom']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($hotel['Description']) ?></p>
            <p><strong>Adresse du hotel:</strong> <?= htmlspecialchars($hotel['Adresse']) ?></p>
            <p><strong>Prix:</strong> <?= number_format($hotel['PrixParNuit'], 2) ?>dh</p>
            <?php if (!empty($hotel['image'])): ?>
                <img src="photo et logo/<?= htmlspecialchars($hotel['image']) ?>" alt="Image du vol">
            <?php else: ?>
                <img src="photo/default.jpg" alt="Image par défaut du vol">
            <?php endif; ?>
        </div>
        <div class="form-container2">
            <h3>Formulaire de Réservation</h3>
            <form method="POST" action="confirmerreservationhotels.php">
                <input type="hidden" name="id_hotel" value="<?= $hotel['IdHotel'] ?>">

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