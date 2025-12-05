<?php
include "connexion.php"; // الاتصال بقاعدة البيانات

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchTerm = htmlspecialchars($searchTerm);
    $stmt = $connexion->prepare("SELECT IdBateau, Destination, Compagnie, NumBateau, DateDepart, HeureDepart, DateArrivee, HeureArrivee, PrixCabineInterieure,
    PrixCabineExterieure,PrixCabineBalcon,
    PrixSuiteLuxe,image 
                                FROM Bateaux
                                WHERE Destination LIKE :searchTerm OR Compagnie LIKE :searchTerm");
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();
    $bateaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       
        .cards-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px; 
    margin-top: 0px; 
    margin-top: 50px; 
    position: relative; 
    z-index: 1; 
}

.cart {
    background-color: #f0f0f0;
    padding: 20px;
    width: 300px; 
    height: 500px; 
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    overflow: hidden; 
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
}

.cart img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px; 
}

.cart h3 {
    font-size: 1.2em;
    margin: 10px 0;
}

.cart p {
    font-size: 0.9em;
    margin: 5px 0;
}

.cart .price {
    font-weight: bold;
    font-size: 1.2em;
    margin-top: 10px;
}

.cart button {
    background-color: #003366;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    width: 100%;
}

.cart button:hover {
    background-color: #0055a5; 
}form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px; 
    padding: 10px;
}
input[type="text"] {
    padding: 10px;
    font-size: 16px;
    width: 300px; 
    border: 2px solid #003366; 
    border-radius: 5px; 
    outline: none;
    transition: border-color 0.3s ease;
}


input[type="text"]:focus {
    border-color: #0055a5; 
}


button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #003366; 
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px; 
    transition: background-color 0.3s ease;
}


button:hover {
    background-color: #0055a5; 
}


.no_resultas {
    text-align: center;
    font-size: 18px;
    color: #333;
    margin-top: 20px;
}


    </style>
       
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

    
    <?php if (isset($bateaux) && count($bateaux) > 0): ?>
        <div id="reservations" style="margin-top: 20px;">
    <?php foreach ($bateaux as $bateaux): ?>
        <div class="cart">
            <?php
                $image_path = "photo et logo/" . htmlspecialchars($bateaux['image']);
                if (!file_exists($image_path)) {
                    $image_path = "photo/default.jpg";
                }
            ?>
            <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($bateaux['Destination']) ?>">
            
            <h3><?= htmlspecialchars($bateaux['Destination']) ?> - <?= htmlspecialchars($bateaux['Compagnie']) ?></h3>
            <p><strong>Numéro de Bateau:</strong> <?= htmlspecialchars($bateaux['NumBateau']) ?></p>
            <p><strong>Date et Heure de départ:</strong> <?= htmlspecialchars($bateaux['DateDepart']) ?> <?= htmlspecialchars($bateaux['HeureDepart']) ?></p>
            <p><strong>Date et Heure d'arrivée:</strong> <?= htmlspecialchars($bateaux['DateArrivee']) ?> <?= htmlspecialchars($bateaux['HeureArrivee']) ?></p>
            <p><strong>Cabine Interieure:</strong><?= htmlspecialchars($bateaux['PrixCabineInterieure']) ?> dh</p>
                <p><strong>Cabine Exterieure:</strong><?= htmlspecialchars($bateaux['PrixCabineExterieure']) ?> dh</p>
                <p><strong>Cabine Balcon:</strong><?= htmlspecialchars($bateaux['PrixCabineBalcon']) ?> dh</p>
                <p><strong>Suite Luxe:</strong><?= htmlspecialchars($bateaux['PrixSuiteLuxe']) ?> dh</p>
            <a href="reservationbateaux.php?id_bateau=<?= $bateaux['IdBateau'] ?>"><button>Réserver</button></a>
        </div>
    <?php endforeach; ?>
</div>
    <?php else: ?>
        <p class="no_resultas">Aucun vol trouvé pour votre recherche.</p>
    <?php endif; ?>
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
</body>
</html>
