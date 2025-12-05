<?php
session_start();
if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Menu Admin</title>
    <link rel="stylesheet" href="css.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .background-section {
            background-image: url('photo et logo/a34.jpg');
            background-size: cover;
            background-position: center;
            height: 500px;
            width: 100%;
            border-radius: 20px;
            border: 2px solid #0055a5;
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.5);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #003366, #00509e);
            /* Dégradé de bleu */
            color: white;
            height: 100vh;
            position: fixed;
            /* Menu fixé à gauche */
            top: 0;
            /* Positionné tout en haut */
            left: 0;
            /* Collé à gauche */
            padding: 30px 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            overflow-y: auto;
            /* Permettre le défilement si nécessaire */
        }

        /* Autres styles */
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 15px;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            padding: 12px 20px;
            margin-bottom: 10px;
            background-color: #7DA0CA;
            border-radius: 8px;
            transition: background-color 0.3s;
            cursor: pointer;
            position: relative;
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

        /* Sous-menu */
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

        /* Contenu */
        .content {
            margin-left: 250px;
            /* Ajuster la marge pour que le contenu ne chevauche pas le menu */
            padding: 40px;
            background-color: #fff;
            min-height: 100vh;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .content h1 {
            font-size: 24px;
            margin-top: 210px;
            color: #00509e;
            text-align: center;
        }

        .content p {
            font-size: 24px;

            color: rgb(0, 0, 0);
            text-align: center;
        }

        .btn {
            position: fixed;
            top: 20px;
            right: 20px;
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

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!-- Bouton d'inscription admin -->
    <a href="inscritionadmin.php" class="btn btn-primary" style="float:right;margin-bottom:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
    </a>

    <!-- Sidebar -->
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

    <!-- Contenu -->
    <div class="content">
        <div class="background-section">
            <h1>Bienvenue dans le tableau de bord</h1>
            <p>Sélectionnez une section à partir du menu à gauche pour afficher les détails.</p>
        </div>
    </div>

    <!-- Script pour activer/désactiver le sous-menu -->
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