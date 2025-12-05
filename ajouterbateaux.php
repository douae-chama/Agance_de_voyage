<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter Bateau</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
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

    .content {
      margin-left: 250px;
      padding: 20px;
      width: calc(100% - 250px);
    }

    form {
      background-color: #f4f4f4;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 60%;
      margin: auto;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #003366;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #00509e;
    }

    h1 {
      text-align: center;
      color: #003366;
    }
    .ll{
      margin-top: 400px;
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

  <!-- Formulaire d'ajout de bateau -->
  <div class="content">
    <h1>Ajouter un Bateau</h1>
    <form action="insertionbateau.php" method="post" enctype="multipart/form-data">

      <label for="destination">Destination :</label>
      <input type="text" id="destination" name="destination" placeholder="Destination" required>

      <label for="compagnie">Compagnie :</label>
      <input type="text" id="compagnie" name="compagnie" placeholder="Compagnie" required>

      <label for="numbateau">Numéro de Bateau :</label>
      <input type="text" id="numbateau" name="numbateau" placeholder="Numéro de Bateau" required>

      <label for="dateD">Date de départ :</label>
      <input type="date" id="dateD" name="dateD" required>

      <label for="heureD">Heure de départ :</label>
      <input type="time" id="heureD" name="heureD" required>

      <label for="dateA">Date d’arrivée :</label>
      <input type="date" id="dateA" name="dateA" required>

      <label for="heureA">Heure d’arrivée :</label>
      <input type="time" id="heureA" name="heureA" required>

      <label for="prixI">Prix Cabine Intérieure :</label>
      <input type="number" id="prixI" name="prixI" step="0.01" placeholder="Prix économique" required>

      <label for="prixE">Prix Cabine Extérieure :</label>
      <input type="number" id="prixE" name="prixE" step="0.01" placeholder="Prix avec fenêtre" required>

      <label for="prixB">Prix Cabine avec Balcon :</label>
      <input type="number" id="prixB" name="prixB" step="0.01" placeholder="Prix avec balcon" required>

      <label for="prixL">Prix Suite de Luxe :</label>
      <input type="number" id="prixL" name="prixL" step="0.01" placeholder="Suite de Luxe" required>

      <label>Image :</label>
      <input type="file" name="image" accept="image/*" required>

      <button type="submit">Ajouter Bateau</button>

    </form>
  </div>

  <script>
    function toggleSubmenu() {
      const submenu = document.getElementById("reservationMenu");
      submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    }
  </script>

</body>

</html>
