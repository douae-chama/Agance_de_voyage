<?php
$client = true;
include_once("connexion.php");

$query = "
    SELECT c.IdClient, c.Nom, c.Prenom, c.telephone, c.Adresse, c.date_creation, u.email
    FROM Clients c
    JOIN Utilisateur u ON c.id_utilisateur = u.id
";
/* SELECT 
    Clients.IdClient, 
    Clients.Nom, 
    Clients.Prenom, 
    Clients.telephone, 
    Clients.Adresse, 
    Clients.date_creation, 
    Utilisateur.email
FROM 
    Clients
INNER JOIN 
    Utilisateur ON Clients.id_utilisateur = Utilisateur.id; */

$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
      margin: 0;
      padding: 0;
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
      font-size: 22px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      padding-bottom: 15px;
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
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .sidebar ul li:hover {
      background-color: rgb(8, 52, 113);
    }

    .sidebar ul li a {
      text-decoration: none;
      color: white;
      display: block;
      width: 100%;
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
      border-radius: 5px;
      background-color: rgb(11, 44, 62);
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

        h2 {
            color: #003366;
            
        }

        .btn-primary {
            background-color: #003366;
            border: none;
        }

        .btn-primary:hover {
            background-color: #56ABD9;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .logo img {
            width: 150px;
        }
        .bb{
    margin-top: 400px;
}
thead{
    background-color: #003366;
    color: white;
}
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>
            <div class="logo">
                <img src="photo et logo/logo3.png" alt="Logo" />
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
            <li class="bb"><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des Clients</h2>
            <a href="inscriptionClient.php" class="btn btn-primary">+ Ajouter un Client</a>
        </div>
        <table class="table table-hover table-bordered align-middle text-center">
            <thead >
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Date de création</th>
                    <th>Email</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($ligne["IdClient"]) ?></td>
                        <td><?= htmlspecialchars($ligne["Nom"]) ?></td>
                        <td><?= htmlspecialchars($ligne["Prenom"]) ?></td>
                        <td><?= htmlspecialchars($ligne["telephone"]) ?></td>
                        <td><?= htmlspecialchars($ligne["Adresse"]) ?></td>
                        <td><?= htmlspecialchars($ligne["date_creation"]) ?></td>
                        <td><?= htmlspecialchars($ligne["email"]) ?></td>
                        <td>
                            <a href="modifclient.php?id=<?= $ligne["IdClient"] ?>" class="btn btn-success btn-sm">Modifier</a>
                        </td>
                        <td>
                            <a href="insertionsupprimerclient.php?id=<?= $ligne["IdClient"] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce client ?');" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<script>
        function toggleSubmenu() {
            var submenu = document.getElementById("reservationMenu");
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
            } else {
                submenu.style.display = "block";
            }
        }
    </script>
</body>

</html>