<?php
include "connexion.php";
$hotels = $connexion->query("SELECT IdHotel, Nom , Adresse, Description, PrixParNuit, image FROM Hotels")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation de Hotels</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            background-image: url('photo et logo/bkhotel.jpg');
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

        .slider-container {
            position: relative;
            width: 80%;
            max-width: 700px;
            height: 400px;
            margin: auto;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .slider-container img {
            margin-top: 5%;
            margin-left: 9%;
            width: 80%;
            height: 80%;
            object-fit: cover;
            display: block;
            transition: opacity 0.5s ease-in-out;
            border-radius: 12px;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            color: white;
            background-color: rgba(43, 19, 138, 0.9);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 2;
            transition: background-color 0.3s ease;
        }

        .arrow:hover {
            background-color: rgb(42, 127, 196);
        }

        .arrow.left {
            left: 0px;
        }

        .arrow.right {
            right: 0px;
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
    <div class="background-section">

        <!-- Slider manuel avec images choisies -->
        <div class="slider-container">
            <div class="arrow left" onclick="prevImage()"><i class="fas fa-chevron-left"></i></div>
            <img id="sliderImage" src="" alt="Hôtel">
            <div class="arrow right" onclick="nextImage()"><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>
    <script>
        const images = [
            'photo et logo/linxhotel.jpg',
            'photo et logo/Parkhotel.jpg',
            'photo et logo/HOTELDBALP.jpg'
        ];

        let currentIndex = 0;
        const imgElement = document.getElementById('sliderImage');

        function showImage(index) {
            imgElement.style.opacity = 0;
            setTimeout(() => {
                imgElement.src = images[index];
                imgElement.style.opacity = 1;
            }, 200);
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        // Afficher la première image au chargement
        showImage(currentIndex);
    </script>

    <form method="POST" action="searchhotel.php" class="search-form">
        <input type="text" name="search" placeholder="Rechercher un hôtel..." required>
        <button type="submit">Rechercher</button>
    </form>

    <div id="reservations" style="margin-top: 20px;">
        <?php foreach ($hotels as $hotel): ?>
            <div class="cart">
                <?php
                $image_path = "photo et logo/" . htmlspecialchars($hotel['image']);
                if (!file_exists($image_path)) {
                    $image_path = "photo/default.jpg";
                }
                ?>
                <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($hotel['Nom']) ?>">
                <h3><?= htmlspecialchars($hotel['Nom']) ?> </h3>
                <p><strong>Description de l'hôtel:</strong> <?= htmlspecialchars($hotel['Description']) ?></p>
                <p><strong>Adresse:</strong> <?= htmlspecialchars($hotel['Adresse']) ?></p>
                <p class="price"><?= htmlspecialchars($hotel['PrixParNuit']) ?> dh / nuit</p>
                <a href="reservationhotels.php?id_hotel=<?= $hotel['IdHotel'] ?>"><button>Réserver</button></a>
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