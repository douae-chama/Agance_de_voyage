<?php
include "connexion.php";

$search = $_POST['search'] ?? '';

if ($search) {
    $like = "%" . $search . "%";

    $queries = [
        'Vols' => "SELECT *, 'Vols' as type FROM Vols WHERE Destination LIKE :search OR Compagnie LIKE :search OR NumVol LIKE :search",
        'Hotels' => "SELECT *, 'Hotels' as type FROM Hotels WHERE Nom LIKE :search OR Adresse LIKE :search OR Description LIKE :search",
        'Voyages' => "SELECT *, 'Voyages' as type FROM Voyages WHERE Titre LIKE :search OR Description LIKE :search OR Destination LIKE :search",
        'Circuits' => "SELECT *, 'Circuits' as type FROM Circuits WHERE Titre LIKE :search OR Description LIKE :search",
        'Bateaux' => "SELECT *, 'Bateaux' as type FROM Bateaux WHERE Destination LIKE :search OR Compagnie LIKE :search OR NumBateau LIKE :search"
    ];

    $results = [];

    foreach ($queries as $label => $sql) {
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':search', $like);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {
            $row['type'] = $label;
            $results[$label][] = $row; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #003366;
}

.navbar1 {
    background-color:  #003366; /* Bleu ciel */
    display: flex;
    justify-content: space-between; /* space between: logo يسار، menu يمين */
    align-items: center;
   
    margin: 0px 0px;
    flex-wrap: wrap;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    
}

.navbar1 .logo img {
    max-width: 120px;
}

.navbar1 ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.navbar1 ul li {
    margin: 0 15px;
}

.navbar1 ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.navbar1 ul li a:hover {
    color:#56ABD9;
}

/* Search form inside menu */
form {
    position: relative;
    width: 0;
    height: 40px;
    background: transparent;
    box-sizing: border-box;
    border-radius: 30px;
    border: 2px solid transparent;
    padding: 0 15px;
    display: flex;
    align-items: center;
    transition: all 0.5s ease;
    overflow: hidden;
    margin-top: -2px;
}

form input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0 15px;
    font-size: 1.1rem;
    border-radius: 30px;
    outline: none;
    border: 2px solid #fff;
    background-color: #fff;
    color: #003366;
    display: none;
    transition: width 0.3s ease, padding 0.3s ease;
}

form input:focus {
    border-color: #56ABD9;
    background-color: #f9f9f9;
}

form .fa {
    box-sizing: border-box;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 50%;
    background: #003366;
    color: #fff;
    font-size: 1.4em;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 2px;
}


form:hover {
    width: 300px;
    border-color: #003366;
}

form:hover input {
    display: block;
    width: 100%;
    padding: 0 20px;
}

form:hover .fa {
    background-color: #003366;
    transform: rotate(180deg);
}


form input::placeholder {
    color: #aaa;
    font-style: italic;
}
.btn{
    background-color: #003366;
    color: white;
}
.btn:hover{
    background-color: #56ABD9;
}
       
h1{
    margin-top: 60px;
    text-align: center;
    
    border: 1px solid #003366;
    border-radius: 5px;
    background-color: #003366;
    color: white;
}
    </style>
</head>

<body>
    <div class="navbar1">
    <div class="logo">
        <img src="photo et logo/logo3.png" alt="Logo" />
    </div>
    <ul>
        <li> <form method="POST" action="search_globale.php">
    <input type="search" name="search" placeholder="Rechercher un destination..." required>
    <i class="fa fa-search"></i>
</form></li>
        <li><a href="home.php">Accueil</a></li>
        <li><a href="loing.php">Espace Client</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>
    

    <?php if (isset($results['Vols']) && count($results['Vols']) > 0): ?>
        <h1>Résultats des Vols</h1>
        <div class="cards-container">
            <?php foreach ($results['Vols'] as $item): ?>
                <div class="cart">
                    <?php
                        $image_path = "photo et logo/" . htmlspecialchars($item['image']);
                        if (!file_exists($image_path)) {
                            $image_path = "photo/default.jpg";
                        }
                    ?>
                    <img src="<?= $image_path ?>" alt="Image Vol">
                    <h3><?= htmlspecialchars($item['Destination']) ?> - <?= htmlspecialchars($item['Compagnie']) ?></h3>
                    <p><strong>Numéro :</strong> <?= htmlspecialchars($item['NumVol']) ?></p>
                    <p><strong>Départ :</strong> <?= htmlspecialchars($item['DateDepart']) ?> à <?= htmlspecialchars($item['HeureDepart']) ?></p>
                    <p><strong>Arrivée :</strong> <?= htmlspecialchars($item['DateArrivee']) ?> à <?= htmlspecialchars($item['HeureArrivee']) ?></p>
                    <p><strong>Economique:</strong> <?= htmlspecialchars($item['PrixEconomique']) ?> dh</p>
                <p><strong>Business:</strong> <?= htmlspecialchars($item['PrixBusiness']) ?> dh</p>
                <p><strong>Premiere:</strong> <?= htmlspecialchars($item['PrixPremiere']) ?> dh</p>
                    <a href="inscriptionClient.php" class="btn">Pour Réserver Inscrit Dabort</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($results['Hotels']) && count($results['Hotels']) > 0): ?>
        <h1>Résultats des Hôtels</h1>
        <div class="cards-container">
            <?php foreach ($results['Hotels'] as $item): ?>
                <div class="cart">
                    <?php
                        $image_path = "photo et logo/" . htmlspecialchars($item['image']);
                        if (!file_exists($image_path)) {
                            $image_path = "photo/default.jpg";
                        }
                    ?>
                    <img src="<?= $image_path ?>" alt="Image Hôtel">
                    <h3><?= htmlspecialchars($item['Nom']) ?></h3>
                    <p><?= htmlspecialchars($item['Adresse']) ?></p>
                    <p><?= htmlspecialchars($item['Description']) ?></p>
                    <p class="price"><?= htmlspecialchars($item['PrixParNuit']) ?> dh/nuit</p>
                    <a href="inscriptionClient.php" class="btn">Pour Réserver Inscrit Dabort</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($results['Voyages']) && count($results['Voyages']) > 0): ?>
        <h1>Résultats des Voyages</h1>
        <div class="cards-container">
            <?php foreach ($results['Voyages'] as $item): ?>
                <div class="cart">
                    <?php
                        $image_path = "photo et logo/" . htmlspecialchars($item['image']);
                        if (!file_exists($image_path)) {
                            $image_path = "photo/default.jpg";
                        }
                    ?>
                    <img src="<?= $image_path ?>" alt="Image Voyage">
                    <h3><?= htmlspecialchars($item['Titre']) ?></h3>
                    <p><?= htmlspecialchars($item['Description']) ?></p>
                    <p><strong>Destination :</strong> <?= htmlspecialchars($item['Destination']) ?></p>
                    <p><strong>Départ :</strong> <?= htmlspecialchars($item['DateDepart']) ?></p>
                    <p class="price"><?= htmlspecialchars($item['Prix']) ?> dh</p>
                    <a href="inscriptionClient.php" class="btn">Pour Réserver Inscrit Dabort</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($results['Circuits']) && count($results['Circuits']) > 0): ?>
        <h1>Résultats des Circuits Touristiques</h1>
        <div class="cards-container">
            <?php foreach ($results['Circuits'] as $item): ?>
                <div class="cart">
                    <?php
                        $image_path = "photo et logo/" . htmlspecialchars($item['image']);
                        if (!file_exists($image_path)) {
                            $image_path = "photo/default.jpg";
                        }
                    ?>
                    <img src="<?= $image_path ?>" alt="Image Circuit">
                    <h3><?= htmlspecialchars($item['Titre']) ?></h3>
                    <p><?= htmlspecialchars($item['Description']) ?></p>
                    <p><strong>Durée :</strong> <?= htmlspecialchars($item['Duree']) ?> jours</p>
                    <p><strong>Départ :</strong> <?= htmlspecialchars($item['DateDepart']) ?></p>
                    <p class="price"><?= htmlspecialchars($item['Prix']) ?> dh</p>
                    <a href="inscriptionClient.php" class="btn">Pour Réserver Inscrit Dabort</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($results['Bateaux']) && count($results['Bateaux']) > 0): ?>
        <h1>Résultats des Bateaux</h1>
        <div class="cards-container">
            <?php foreach ($results['Bateaux'] as $item): ?>
                <div class="cart">
                    <?php
                        $image_path = "photo et logo/" . htmlspecialchars($item['image']);
                        if (!file_exists($image_path)) {
                            $image_path = "photo/default.jpg";
                        }
                    ?>
                    <img src="<?= $image_path ?>" alt="Image Bateau">
                    <h3><?= htmlspecialchars($item['Destination']) ?> - <?= htmlspecialchars($item['Compagnie']) ?></h3>
                    <p><strong>Numéro :</strong> <?= htmlspecialchars($item['NumBateau']) ?></p>
                    <p><strong>Départ :</strong> <?= htmlspecialchars($item['DateDepart']) ?> à <?= htmlspecialchars($item['HeureDepart']) ?></p>
                    <p><strong>Arrivée :</strong> <?= htmlspecialchars($item['DateArrivee']) ?> à <?= htmlspecialchars($item['HeureArrivee']) ?></p>
                    <p><strong>Cabine Interieure:</strong><?= htmlspecialchars($item['PrixCabineInterieure']) ?> dh</p>
                <p><strong>Cabine Exterieure:</strong><?= htmlspecialchars($item['PrixCabineExterieure']) ?> dh</p>
                <p><strong>Cabine Balcon:</strong><?= htmlspecialchars($item['PrixCabineBalcon']) ?> dh</p>
                <p><strong>Suite Luxe:</strong><?= htmlspecialchars($item['PrixSuiteLuxe']) ?> dh</p>
                    <a href="inscriptionClient.php" class="btn">Pour Réserver Inscrit Dabort</a>
                  
                </div>
            <?php endforeach; ?>
        </div>
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
</html>
