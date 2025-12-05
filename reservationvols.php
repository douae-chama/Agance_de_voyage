<?php
include 'connexion.php';
if (isset($_GET['id_vol'])) {
    $id_vol = $_GET['id_vol'];
    $query = $connexion->prepare("SELECT * FROM Vols WHERE IdVol = :id_vol");
    $query->bindParam(':id_vol', $id_vol, PDO::PARAM_INT);
    $query->execute();
    $vol = $query->fetch(PDO::FETCH_ASSOC);
    if (!$vol) die("Vol non trouvé.");
} else {
    die("ID du vol non fourni.");
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
            <h3>Détails du Vol</h3>
            <p><strong>Destination:</strong> <?= htmlspecialchars($vol['Destination']) ?></p>
            <p><strong>Compagnie:</strong> <?= htmlspecialchars($vol['Compagnie']) ?></p>
            <p><strong>Numéro du Vol:</strong> <?= htmlspecialchars($vol['NumVol']) ?></p>
            <p><strong>Date de départ:</strong> <?= htmlspecialchars($vol['DateDepart']) ?></p>
            <p><strong>Heure de départ:</strong> <?= htmlspecialchars($vol['HeureDepart']) ?></p>
            <p><strong>Date d'arrivée:</strong> <?= htmlspecialchars($vol['DateArrivee']) ?></p>
            <p><strong>Heure d'arrivée:</strong> <?= htmlspecialchars($vol['HeureArrivee']) ?></p>
            <p><strong>Economique:</strong> <?= htmlspecialchars($vol['PrixEconomique']) ?> dh</p>
            <p><strong>Business:</strong> <?= htmlspecialchars($vol['PrixBusiness']) ?> dh</p>
            <p><strong>Premiere:</strong> <?= htmlspecialchars($vol['PrixPremiere']) ?> dh</p>
            <?php if (!empty($vol['image'])): ?>
                <img src="photo et logo/<?= htmlspecialchars($vol['image']) ?>" alt="Image du vol" width="300">
            <?php endif; ?>
        </div>
        <div class="form-container2">
            <h3>Formulaire de Réservation</h3>
            <form method="POST" action="confirmerreservationvols.php">
                <input type="hidden" name="id_vol" value="<?= $vol['IdVol'] ?>">

                <label>Nom:</label>
                <input type="text" name="nom" required><br>

                <label>Prénom:</label>
                <input type="text" name="prenom" required><br>

                <label>Téléphone:</label>
                <input type="tel" name="telephone" required><br>

                <label>Email:</label>
                <input type="email" name="email" required><br>

                <label>Nombre de personnes:</label>
                <input type="number" name="number" required><br>

                <label>Adresse:</label>
                <textarea name="adresse" required></textarea><br>

                <label>Classe:</label>
                <select name="classe" id="classe" required onchange="updatePrix()">
                    <option value="">-- Sélectionner la classe --</option>
                    <option value="economique">Économique - <?= number_format($vol['PrixEconomique'], 2) ?> dh</option>
                    <option value="business">Business - <?= number_format($vol['PrixBusiness'], 2) ?> dh</option>
                    <option value="premiere">Première - <?= number_format($vol['PrixPremiere'], 2) ?> dh</option>
                </select><br>

                <p><strong>Prix sélectionné:</strong> <span id="prixSelectionne">0.00</span> dh</p>
                <input type="hidden" name="prix" id="prix" value="0.00">

                <button type="submit">Confirmer la Réservation</button>
            </form>
        </div>
    </div>
    <script>
        const prixE = <?= $vol['PrixEconomique'] ?>;
        const prixB = <?= $vol['PrixBusiness'] ?>;
        const prixP = <?= $vol['PrixPremiere'] ?>;

        function updatePrix() {
            const classe = document.getElementById("classe").value;
            let prix = 0;

            if (classe === "economique") prix = prixE;
            else if (classe === "business") prix = prixB;
            else if (classe === "premiere") prix = prixP;

            document.getElementById("prixSelectionne").innerText = prix.toFixed(2);
            document.getElementById("prix").value = prix.toFixed(2);
        }
    </script>
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