<?php
include 'connexion.php';

// Vérification de l'ID du vol passé dans l'URL
if (isset($_GET['iv'])) {
    $idVol = $_GET['iv'];

    // Requête pour récupérer les détails du vol
    $sql = "SELECT * FROM Vols WHERE IdVol = :iv";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':iv', $idVol, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $vol = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("Vol non trouvé.");
    }
} else {
    die("ID du vol non fourni.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Vol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #003366, #00509e);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 30px 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }
        .sidebar ul li {
            padding: 12px 20px;
            margin-bottom: 10px;
            background-color: #7DA0CA;
            border-radius: 8px;
            cursor: pointer;
        }
        .sidebar ul li:hover {
            background-color: rgb(8, 52, 113);
        }
        .sidebar ul li a {
            text-decoration: none;
            color: white;
            display: block;
        }
        .submenu {
            display: none;
            background-color: rgba(255, 255, 255, 0.1);
            margin-top: 5px;
            padding-left: 10px;
            border-left: 2px solid #66a3ff;
        }
        .submenu li {
            padding: 10px 15px;
            font-size: 14px;
            margin-bottom: 5px;
            background-color: rgb(11, 44, 62);
            border-radius: 5px;
        }
        .submenu li:hover {
            background-color: #56ABD9;
        }
        .submenu li a {
            color: #e0e0e0;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: 80%;
        }
        .form-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            width: 80%;
            margin-left: 70px;
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #00509e;
        }
        .ll{
            margin-top: 400px;
        }
        h2{
            text-align: center;
            color: #003366;
            margin-left: 150px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>
        <div class="logo">
            <img src="photo et logo/logo3.png" alt="Logo" style="max-width: 100%;">
        </div>
    </h2>
    <ul>
        <li><a href="menu.php">Accueil</a></li>
        <li><a href="affichageclient.php">Les Clients</a></li>
        <li><a href="affichagehotels.php">Les Hôtels</a></li>
        <li><a href="affuchagevols.php">Les Vols</a></li>
        <li><a href="affichagebateaux.php">Les Bateaux</a></li>
        <li><a href="affichagecircuit.php">Les Circuits Touristiques</a></li>
        <li><a href="affichagevoyage.php">Les Voyages</a></li>
        <li><a href="admincontact.php">Contact</a></li>
        <li onclick="toggleSubmenu()">Réservations</li>
        <ul class="submenu" id="reservationMenu">
            <li><a href="res_vols.php">Réservations Vols</a></li>
            <li><a href="res_bateaux.php">Réservations Bateaux</a></li>
            <li><a href="res_circuits.php">Réservations Circuits</a></li>
            <li><a href="res_voyages.php">Réservations Voyages</a></li>
            <li><a href="res_hotels.php">Réservations Hôtels</a></li>
        </ul>
        <li class="ll"><a href="deconnexion.php">Déconnexion</a></li>
    </ul>
</div>
<h2>Modifier un Vol</h2>
<!-- Formulaire -->
<div class="main-content">
    <div class="form-container">
        
        <form action="insertionmodifiervol.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="iv" value="<?= htmlspecialchars($vol['IdVol']) ?>">

            <label>Destination :</label>
            <input type="text" name="destination" value="<?= htmlspecialchars($vol['Destination']) ?>" required>

            <label>Compagnie :</label>
            <input type="text" name="compagnie" value="<?= htmlspecialchars($vol['Compagnie']) ?>" required>

            <label>Numéro de vol :</label>
            <input type="text" name="numvol" value="<?= htmlspecialchars($vol['NumVol']) ?>" required>

            <label>Date de départ :</label>
            <input type="date" name="dateD" value="<?= $vol['DateDepart'] ?>">

            <label>Heure de départ :</label>
            <input type="time" name="heureD" value="<?= $vol['HeureDepart'] ?>">

            <label>Date d’arrivée :</label>
            <input type="date" name="dateA" value="<?= $vol['DateArrivee'] ?>">

            <label>Heure d’arrivée :</label>
            <input type="time" name="heureA" value="<?= $vol['HeureArrivee'] ?>">

            <label>Prix Économique :</label>
            <input type="number" name="prixE" step="0.01" value="<?= $vol['PrixEconomique'] ?>" required>

            <label>Prix Business :</label>
            <input type="number" name="prixB" step="0.01" value="<?= $vol['PrixBusiness'] ?>" required>

            <label>Prix Première :</label>
            <input type="number" name="prixP" step="0.01" value="<?= $vol['PrixPremiere'] ?>" required>

            <label>Image actuelle :</label><br>
            <?php if (!empty($vol['image'])): ?>
                <img src="photo et logo/<?= htmlspecialchars($vol['image']) ?>" alt="Image Vol" style="width:200px;"><br><br>
            <?php else: ?>
                <p>Aucune image enregistrée.</p>
            <?php endif; ?>

            <label>Nouvelle image :</label>
            <input type="file" name="image" accept="image/*"><br>

            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</div>

<script>
    function toggleSubmenu() {
        var submenu = document.getElementById("reservationMenu");
        submenu.style.display = (submenu.style.display === "block") ? "none" : "block";
    }
</script>

</body>
</html>
