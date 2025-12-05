<?php
include "connexion.php";
$vols = $connexion->query("SELECT IdVol, Destination, Compagnie, NumVol, DateDepart, HeureDepart, DateArrivee, HeureArrivee,PrixEconomique,PrixBusiness,PrixPremiere, image FROM Vols")->fetchAll(PDO::FETCH_ASSOC);
?>
PrixPremiere
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation de Vols</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
    .background-section {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 460px;
        padding: 40px;
        margin-top: 60px;
    }

    .background-section::before {
        content: "";
        background-image: url('photo et logo/bk16.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.4;
        z-index: -1;
    }

    .background-section .card-container2 {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 130px;
        flex-wrap: wrap;
    }

    .card2 {
        background-color: #003366;
        border-radius: 10px;
        padding: 20px;
        width: 250px;
        transition: transform 0.3s ease-in-out;
        text-align: center;
    }

    .card2:hover {
        transform: scale(1.05);
    }

    .card2 img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
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

<body>

    <div class="background-section">
        <div class="card-container2">
            <div class="card2">
                <img src="photo et logo/a1.jpg" alt="Vols">
            </div>
            <div class="card2">
                <img src="photo et logo/a2.jpg" alt="Vols">
            </div>
            <div class="card2">
                <img src="photo et logo/a3.jpg" alt="Vols">
            </div>
        </div>
    </div>
    <<div class="floating-btn">
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
    <form method="POST" action="searchvol.php" class="search-form">
        <input type="text" name="search" placeholder="Rechercher un vol..." required>
        <button type="submit">Rechercher</button>
    </form>
    <div class="cards-container">
       
        <?php foreach ($vols as $vol): ?>
            <div class="cart">
                <?php
                $image_path = "photo et logo/" . htmlspecialchars($vol['image']);
                if (!file_exists($image_path)) {
                    $image_path = "photo/default.jpg";
                }
                ?>
                <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($vol['Destination']) ?>">

                <h3><?= htmlspecialchars($vol['Destination']) ?> - <?= htmlspecialchars($vol['Compagnie']) ?></h3>
                <p><strong>Numéro de vol:</strong> <?= htmlspecialchars($vol['NumVol']) ?></p>
                <p><strong>Date et Heure de départ:</strong> <?= htmlspecialchars($vol['DateDepart']) ?> <?= htmlspecialchars($vol['HeureDepart']) ?></p>
                <p><strong>Date et Heure d'arrivée:</strong> <?= htmlspecialchars($vol['DateArrivee']) ?> <?= htmlspecialchars($vol['HeureArrivee']) ?></p>
                <p><strong>Economique:</strong> <?= htmlspecialchars($vol['PrixEconomique']) ?> dh</p>
                <p><strong>Business:</strong> <?= htmlspecialchars($vol['PrixBusiness']) ?> dh</p>
                <p><strong>Premiere:</strong> <?= htmlspecialchars($vol['PrixPremiere']) ?> dh</p>
                <a href="reservationvols.php?id_vol=<?= $vol['IdVol'] ?>"><button>Réserver</button></a>
            </div>
        <?php endforeach; ?>
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