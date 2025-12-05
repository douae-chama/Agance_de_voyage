<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
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
      margin-left: 270px;
      /* Espace pour le menu */
      padding: 20px;
    }

    .cc {
      background-color: #003366;
    }

    .cc :hover {
      background-color: rgb(23, 95, 167);
      color: white;
    }

    h2 {
      color: #003366;

    }

    strong {
      color: #003366;
    }

    

    .ll {
      margin-top: 400px;
    }

    p {
      font-size: larger;
    }
  </style>
  <script>
    function toggleSubmenu() {
      var menu = document.getElementById("reservationMenu");
      menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }
  </script>
  </head>

  <body>
  <div class="sidebar">
    <h2>
      <div class="logo">
        <img src="photo et logo/logo3.png" alt="Logo" style="max-width:100%;">
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
  <div class="main-content">
    <div class="container mt-4 ">
      <a href="ajoutervoyage.php" class="btn btn-primary mb-4 float-end cc">
        +Ajouter Voyage
      </a>

      <h2 class="mb-4">Liste des Voyages</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">

<?php
$voyage=true;
include_once("connexion.php");
$query = "select IdVoyage,Titre,Description,Prix,DateDepart,DateRetour,Destination,image from Voyages";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)):
?>
 <div class="w-100 h-50">
            <div class="card h-100 shadow-sm d-flex flex-row" style="height: 150px;">

              <!-- Image -->
              <div style="flex: 1 1 40%;">
                <img src="photo et logo/<?php echo htmlspecialchars($ligne['image']); ?>" class="img-fluid h-100" style="object-fit: cover; border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" alt="Image de l'hôtel">
              </div>
              <div style="flex: 1 1 60%; display: flex; flex-direction: column;">

                <!-- Texte -->
                <div class="card-body" style="flex: 1 1 auto;">
                  <p class="card-text mb-1"><strong>ID Voyage:</strong> <?php echo htmlspecialchars($ligne["IdVoyage"]); ?></p>
                  <p class="card-text mb-1"><strong>Titre:</strong> <?php echo htmlspecialchars($ligne["Titre"]); ?></p>
                  <p class="card-text mb-1"><strong>Description:</strong> <?php echo htmlspecialchars($ligne["Description"]); ?></p>
                  <p class="card-text mb-1"><strong>Date de depart:</strong> <?php echo htmlspecialchars($ligne["DateDepart"]); ?></p>
                  <p class="card-text mb-1"><strong>Date de Retour:</strong> <?php echo htmlspecialchars($ligne["DateRetour"]); ?></p>
                  <p class="card-text mb-0"><strong>Destination:</strong> <?php echo htmlspecialchars($ligne["Destination"]); ?> </p>
                  <p class="card-text mb-0"><strong>Prix:</strong> <?php echo htmlspecialchars($ligne["Prix"]); ?> dh</p>
                </div>
                <!-- Boutons -->
                <div class="card-footer bg-white border-top-0 d-flex p-2">
                  <a href="modifvoyage.php?ig=<?php echo $ligne["IdVoyage"]; ?>" class="btn btn-success btn-sm me-2 ms-5">Modifier</a>
                  <a href="insertionsupprimervoyage.php?ig=<?php echo $ligne["IdVoyage"]; ?>" onclick="return confirm('Vous confirmez la suppression ?');" class="btn btn-danger btn-sm ">Supprimer</a>
                </div>


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
