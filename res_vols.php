<?php
include 'connexion.php';

$sql = "SELECT r.IdReservation, r.Nom, r.Prenom, r.telephone, r.Adresse, r.email, r.DateReservation, r.NombrePersonnes, r.prixtotal,r. Statut, v.Destination
        FROM Reservations r
        JOIN Vols v ON r.IdVol = v.IdVol
        WHERE r.IdVol IS NOT NULL";
$result = $connexion->query($sql);
$result->execute();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservations Vols</title>
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
        }

        h2 {
            color: #003366;
        }

        thead {
            background-color: #003366;
            color: white;
        }

        .logo img {
            width: 150px;
        }


        .bb {
            margin-top: 400px;
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
        <h2>Liste des Réservations de Vols</h2>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Date Réservation</th>
                    <th>Nombre de Personnes</th>
                    <th>Prix Total</th>
                    <th>Destination</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->rowCount() > 0): ?>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Nom']) ?></td>
                        <td><?= htmlspecialchars($row['Prenom']) ?></td>
                        <td><?= htmlspecialchars($row['telephone']) ?></td>
                        <td><?= htmlspecialchars($row['Adresse']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['DateReservation']) ?></td>
                        <td><?= htmlspecialchars($row['NombrePersonnes']) ?></td>
                        <td><?= htmlspecialchars($row['prixtotal']) ?> dh</td>
                        <td><?= htmlspecialchars($row['Destination']) ?></td>
                        <td><?= htmlspecialchars($row['Statut']) ?></td>
<td>
                       <?php if ($row['Statut'] === 'Confirmée') : ?>
            <a href="traiter_reservation.php?id=<?= $row['IdReservation'] ?>&action=annuler&type=vol" class="btn btn-danger btn-sm">Annuler</a>
        <?php else : ?>
            
            <a href="traiter_reservation.php?id=<?= $row['IdReservation'] ?>&action=confirmer&type=vol" class="btn btn-success btn-sm">Confirmer</a>
        <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                 <?php else: ?>
                <tr><td colspan="9">Aucune réservation trouvée</td></tr>
            <?php endif; ?>
        </tbody>
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