<?php
include 'connexion.php';
if (isset($_GET['id_bateau'])) {
    $id_bateau = $_GET['id_bateau'];
    $query = $connexion->prepare("SELECT * FROM Bateaux WHERE IdBateau = :id_bateau");
    $query->bindParam(':id_bateau', $id_bateau, PDO::PARAM_INT);
    $query->execute();
    $bateau = $query->fetch(PDO::FETCH_ASSOC);
    if (!$bateau) {
        die("Bateau non trouvé.");
    }
} else {
    die("ID du Bateau non fourni.");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation du Bateau</title>
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
            <h3>Détails du Bateau</h3>
            <p><strong>Destination:</strong> <?= htmlspecialchars($bateau['Destination']) ?></p>
            <p><strong>Compagnie:</strong> <?= htmlspecialchars($bateau['Compagnie']) ?></p>
            <p><strong>Numéro du Bateau:</strong> <?= htmlspecialchars($bateau['NumBateau']) ?></p>
            <p><strong>Date de départ:</strong> <?= htmlspecialchars($bateau['DateDepart']) ?></p>
            <p><strong>Heure de départ:</strong> <?= htmlspecialchars($bateau['HeureDepart']) ?></p>
            <p><strong>Date d'arrivée:</strong> <?= htmlspecialchars($bateau['DateArrivee']) ?></p>
            <p><strong>Heure d'arrivée:</strong> <?= htmlspecialchars($bateau['HeureArrivee']) ?></p>
            <p><strong>Cabine Interieure:</strong><?= htmlspecialchars($bateau['PrixCabineInterieure']) ?> dh</p>
            <p><strong>Cabine Exterieure:</strong><?= htmlspecialchars($bateau['PrixCabineExterieure']) ?> dh</p>
            <p><strong>Cabine Balcon:</strong><?= htmlspecialchars($bateau['PrixCabineBalcon']) ?> dh</p>
            <p><strong>Suite Luxe:</strong><?= htmlspecialchars($bateau['PrixSuiteLuxe']) ?> dh</p>
            <?php if (!empty($bateau['image'])): ?>
                <img src="photo et logo/<?= htmlspecialchars($bateau['image']) ?>" alt="Image du vol">
            <?php else: ?>
                <img src="photo/default.jpg" alt="Image par défaut du vol">
            <?php endif; ?>
        </div>
        <div class="form-container2">
            <h3>Formulaire de Réservation</h3>
            <form method="POST" action="confirmerreservationBateaux.php">
                <input type="hidden" name="id_bateau" value="<?= $bateau['IdBateau'] ?>">

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

                <label>Classe:</label>
                <select name="classe" id="classe" required onchange="updatePrix()">
                    <option value="">-- Sélectionner la croisière --</option>
                    <option value="Interieure">Cabine Interieure - <?= number_format($bateau['PrixCabineInterieure'], 2) ?> dh</option>
                    <option value="Exterieure">Cabine Exterieure - <?= number_format($bateau['PrixCabineExterieure'], 2) ?> dh</option>
                    <option value="Balcon">Cabine avec Balcon - <?= number_format($bateau['PrixCabineBalcon'], 2) ?> dh</option>
                    <option value="Luxe">Suite de Luxe - <?= number_format($bateau['PrixSuiteLuxe'], 2) ?> dh</option>
                </select><br>
                <p><strong>Prix sélectionné:</strong> <span id="prixSelectionne">0.00</span> dh</p>
                <input type="hidden" name="prix" id="prix" value="0.00">

                <button type="submit">Confirmer la Réservation</button>
            </form>
        </div>
    </div>
    <script>
        const prixI = <?= $bateau['PrixCabineInterieure'] ?>;
        const prixE = <?= $bateau['PrixCabineExterieure'] ?>;
        const prixB = <?= $bateau['PrixCabineBalcon'] ?>;
        const prixL = <?= $bateau['PrixSuiteLuxe'] ?>;
        function updatePrix() {
            const classe = document.getElementById("classe").value;
            let prix = 0;

            if (classe === "Interieure") prix = prixI;
            else if (classe === "Exterieure") prix = prixE;
            else if (classe === "Balcon") prix = prixB;
            else if (classe === "Luxe") prix = prixL;

            else prix = 0; // Si aucune classe n'est sélectionnée
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