<?php
include 'connexion.php';

if (isset($_GET['ic'])) {
    $idCircuit = $_GET['ic'];

    $sql = "SELECT * FROM Circuits WHERE IdCircuit = :ic";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':ic', $idCircuit, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $circuit = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("Circuit non trouvé.");
    }
} else {
    die("ID du circuit non fourni.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Circuit</title>
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
        .ll {
            margin-top: 400px;
        }
        h2 {
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

<h2>Modifier un Circuit</h2>

<div class="main-content">
    <div class="form-container">
        <form action="insertionmodifiercircuit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="ic" value="<?= htmlspecialchars($circuit['IdCircuit']) ?>">

            <label for="titre">Titre :</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($circuit['Titre']) ?>" required>

            <label for="description">Description :</label>
            <textarea name="description" rows="4" required><?= htmlspecialchars($circuit['Description']) ?></textarea>

            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" value="<?= $circuit['Prix'] ?>" required>

            <label for="duree">Durée (en jours) :</label>
            <input type="number" name="duree" value="<?= $circuit['Duree'] ?>" required>

            <label for="dateD">Date de départ :</label>
            <input type="date" name="dateD" value="<?= $circuit['DateDepart'] ?>" required>

            <label>Image actuelle :</label><br>
            <?php if (!empty($circuit['image'])): ?>
                <img src="photo et logo/<?= htmlspecialchars($circuit['image']) ?>" alt="Image Circuit" style="width:200px;"><br><br>
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
