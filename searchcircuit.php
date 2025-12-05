<?php
include "connexion.php"; 

if (isset($_POST['search'])) {
    $searchTerm = htmlspecialchars($_POST['search']);
    $stmt = $connexion->prepare("SELECT IdCircuit, Titre, Description, Prix, Duree, DateDepart, image 
                                  FROM Circuits 
                                  WHERE Titre LIKE :searchTerm OR Description LIKE :searchTerm");
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();
    $circuits = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche - Circuits</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="c lientres.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .cards-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 50px;
        }

        .cart {
            background-color: #f0f0f0;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        }

        .no-results {
            text-align: center;
            font-size: 18px;
            color: #333;
            margin-top: 300px;
            color: #003366;
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

<?php if (isset($circuits) && count($circuits) > 0): ?>
    <div class="cards-container">
        <?php foreach ($circuits as $circuit): ?>
            <div class="cart">
                <?php
                $image_path = "photo et logo/" . htmlspecialchars($circuit['image']);
                if (!file_exists($image_path)) {
                    $image_path = "photo/default.jpg";
                }
                ?>
                <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($circuit['Titre']) ?>">
                <h3><?= htmlspecialchars($circuit['Titre']) ?></h3>
                <p><strong>Description :</strong> <?= htmlspecialchars($circuit['Description']) ?></p>
                <p><strong>Durée :</strong> <?= htmlspecialchars($circuit['Duree']) ?> jours</p>
                <p><strong>Date de départ :</strong> <?= htmlspecialchars($circuit['DateDepart']) ?></p>
                <p class="price"><?= htmlspecialchars($circuit['Prix']) ?> dh</p>
                <a href="reservationcircuit.php?id_circuit=<?= $circuit['IdCircuit'] ?>"><button>Réserver</button></a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <h1 class="no-results">Aucun circuit trouvé pour votre recherche.</h1>
<?php endif; ?>

<section class="social-section"><br>
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
