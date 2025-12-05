<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Vols</title>
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
      margin-left: 240px;
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

    .card-img-top {
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      text-align: center;
    }

    .card {
      margin: 20px;

    }

    h3 {
      text-align: center;
      color: #003366;
    }

    p {
      color: #003366;
    }

    .cards-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .card-actions a {
      margin: 5px;
    }

    .bb {
      margin-top: 400px;
    }

    .cc {
      padding: 3px;
      border: 2px solid #00509e;
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
    <div class="container mt-4 ">
      <a href="ajoutervols.php" class="btn btn-primary mb-4 float-end cc">
        +Ajouter vol
      </a>
      <h2 class="mb-4">Liste des vols</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php
        $vols = true;
        include_once("connexion.php");
        $query = "SELECT IdVol, Destination, Compagnie, numvol, DateDepart, HeureDepart, DateArrivee, HeureArrivee, PrixEconomique, PrixBusiness, PrixPremiere, image FROM Vols";
        $pdostmt = $connexion->prepare($query);
        $pdostmt->execute();
        while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)):
        ?>
          <div class=" w-100 h-50">
            <div class="card h-100 shadow-sm d-flex flex-row" style="height: 150px;">

              <div style="flex: 1 1 50%;">
                <img src="photo et logo/<?= htmlspecialchars($ligne['image']) ?>" class="img-fluid h-100" style="object-fit: cover; border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" alt="Image du vol">
              </div>
              <div style="flex: 1 1 50%; display: flex; flex-direction: column;">
                <div class="card-body" style="flex: 1 1 auto;">
                  <h3 class="card-title"><?= htmlspecialchars($ligne["Destination"]) ?></h3>
                  <p class="card-text"><strong>Compagnie :</strong> <?= htmlspecialchars($ligne["Compagnie"]) ?><br>
                  <p class="card-text mb-1"><strong>Numéro de vol :</strong> <?= htmlspecialchars($ligne["numvol"]) ?><br>
                  <p class="card-text mb-1"><strong>Date et Heure de départ:</strong> <?= htmlspecialchars($ligne['DateDepart']) ?> <?= htmlspecialchars($ligne['HeureDepart']) ?></p>
                  <p class="card-text mb-1"><strong>Date et Heure d'arrivée:</strong> <?= htmlspecialchars($ligne['DateArrivee']) ?> <?= htmlspecialchars($ligne['HeureArrivee']) ?></p>
                  <p class="card-text mb-1"><strong>Economique:</strong> <?= htmlspecialchars($ligne['PrixEconomique']) ?> dh</p>
                  <p class="card-text mb-1"><strong>Business:</strong> <?= htmlspecialchars($ligne['PrixBusiness']) ?> dh</p>
                  <p class="card-text mb-0"><strong>Premiere:</strong> <?= htmlspecialchars($ligne['PrixPremiere']) ?> dh</p>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex p-2">
                  <a href="modifvol.php?iv=<?= $ligne["IdVol"] ?>" class="btn btn-success btn-sm me-2 ms-5">Modifier</a>
                  <a href="insertionsupprimervols.php?iv=<?= $ligne["IdVol"] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce vol ?');" class="btn btn-danger btn-sm">Supprimer</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
          </div>
      </div>
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