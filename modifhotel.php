<?php
include 'connexion.php';

// Vérifier si l'ID de l'hôtel est passé dans l'URL
if (isset($_GET['ih'])) {
    $idHotel = $_GET['ih'];

    // Requête pour récupérer les détails de l'hôtel
    $sql = "SELECT * FROM Hotels WHERE IdHotel = :ih";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':ih', $idHotel, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifier si l'hôtel existe
    if ($stmt->rowCount() > 0) {
        $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Si l'hôtel n'existe pas, rediriger ou afficher un message d'erreur
        die("Hôtel non trouvé.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Hôtel</title>
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

        .form-container input,
        .form-container textarea {
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

        h1 {
            text-align: center;
            color: #003366;
            margin-left: 150px;
        }

        img {
            width: 150px;
        }
    </style>
</head>

<body>

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
    <h1>Modifier un Hôtel</h1>
    <div class="main-content">
        <div class="form-container">

            <form action="insertionmodifierhotel.php" method="post" enctype="multipart/form-data">
                <label for="ih">ID de l'hôtel :</label><br>
                <input type="text" id="ih" name="ih" value="<?php echo $hotel['IdHotel']; ?>" readonly><br><br>

                <label for="nom">Nom de l'hôtel :</label><br>
                <input type="text" id="nom" name="nom" value="<?php echo $hotel['Nom']; ?>" required><br><br>

                <label for="adresse">Adresse :</label><br>
                <input type="text" id="adresse" name="adresse" value="<?php echo $hotel['Adresse']; ?>" required><br><br>

                <label for="descriptions">Description :</label><br>
                <textarea id="descriptions" name="descriptions" placeholder="Description"><?php echo $hotel['Description']; ?></textarea><br><br>

                <label for="prix">Prix par nuit :</label><br>
                <input type="number" id="prix" name="prix" value="<?php echo $hotel['PrixParNuit']; ?>" step="0.01" placeholder="Prix par nuit" required><br><br>

                <label>Image actuelle :</label><br>
                <img src="photo et logo /<?php echo $hotel['image']; ?>" alt="Image de l'hôtel" style="width: 200px;"><br><br>

                <label>Nouvelle image :</label><br>
                <input type="file" name="image" accept="image/*"><br><br>

                <button type="submit">Modifier Hôtel</button>
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