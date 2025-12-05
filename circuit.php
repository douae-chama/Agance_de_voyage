<?php
include "connexion.php";
$circuit = $connexion->query("SELECT IdCircuit,Titre,Description, Prix, Duree, DateDepart,image FROM Circuits")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation de Hotels</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .background-clip {
            background-image: url('photo et logo/bk8.jpg');
            background-size: cover;
            background-position: center;
            height: 500px;
            width: 100%;
            clip-path: polygon(0 0,
                    100% 0,
                    100% 80%,
                    95% 88%,
                    90% 80%,
                    85% 90%,
                    80% 82%,
                    70% 94%,
                    60% 85%,
                    50% 95%,
                    40% 87%,
                    30% 92%,
                    20% 85%,
                    10% 90%,
                    0 80%);
        }
        .floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #003366;
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;              /* <-- هنا */
    justify-content: center;    /* أفقياً */
    align-items: center;        /* عمودياً */
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    transition: background-color 0.3s;
}

.floating-btn:hover {
    background-color: #0055a5;
}

.floating-btn a {
    color: white;
    text-decoration: none;
    display: block;
}

    </style>
</head>

<body>
    <div class="background-clip"></div>
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
    <div class="floating-btn">
  <a href="mesreservation.php" title="Mes reservation">
    <i class="fa fa-calendar-check"></i>
  </a>
</div>
    <form method="POST" action="searchcircuit.php" class="search-form">
        <input type="text" name="search" placeholder="Rechercher un Circuit..." required>
        <button type="submit">Rechercher</button>
    </form>
    <div id="reservations" style="margin-top: 20px;">
        <?php foreach ($circuit as $circuit): ?>
            <div class="cart">
                <?php
                $image_path = "photo et logo/" . htmlspecialchars($circuit['image']);
                if (!file_exists($image_path)) {
                    $image_path = "photo/default.jpg";
                }
                ?>
                <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($circuit['Titre']) ?>">
                <h3><?= htmlspecialchars($circuit['Titre']) ?></h3>
                <p><strong>Description de Circuit:</strong> <?= htmlspecialchars($circuit['Description']) ?></p>
                <p><strong>Durée de Circuit :</strong> <?= htmlspecialchars($circuit['Duree']) ?> Jours</p>
                <p><strong>Date de Départ:</strong> <?= htmlspecialchars($circuit['DateDepart']) ?> </p>
                <p class="price"><?= htmlspecialchars($circuit['Prix']) ?> dh</p>
                <a href="reservationcircuit.php?id_circuit=<?= $circuit['IdCircuit'] ?>"><button>Réserver</button></a>
            </div>
        <?php endforeach; ?>
    </div>
    <section class="social-section">
        <h3>TROUVEZ-NOUS SUR</h3><br>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-snapchat"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </section>
</body>

</html>