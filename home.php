<?php
include "connexion.php";
$vols = $connexion->query("SELECT IdVol, Destination, Compagnie, NumVol, DateDepart, HeureDepart, DateArrivee, HeureArrivee,PrixEconomique,PrixBusiness,PrixPremiere, image FROM Vols")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
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
    <section class="main-section">
        <div class="content">
            <h1>Bienvenue sur notre site !</h1>
            <p>Découvrez nos services exceptionnels et planifiez votre prochaine aventure avec nous.</p>
            <a href="contact.php" class="contact-button">Contactez-nous</a>
        </div>
    </section>
   
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
            <p ><strong>Economique:</strong> <?= htmlspecialchars($vol['PrixEconomique']) ?> dh</p>
            <p ><strong>Business:</strong> <?= htmlspecialchars($vol['PrixBusiness']) ?> dh</p>
            <p ><strong>Premiere:</strong> <?= htmlspecialchars($vol['PrixPremiere']) ?> dh</p>
            <a href="inscriptionClient.php" class="btn">Pour Réserver Inscrit Dabort</a>
        </div>
    <?php endforeach; ?>
</div>

    <!-- Section Contact -->
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
