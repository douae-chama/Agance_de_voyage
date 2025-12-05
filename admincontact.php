<?php
include("connexion.php");
$query = $connexion->prepare("SELECT * FROM Contact ORDER BY DateContact DESC");
$query->execute();
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .admin-container {
            width: 60%;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-left:400px ;
        }

        .admin-container h2 {
            text-align: center;
            margin-bottom: 20px;
        color: #003366;
        }
        .message-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
        }

        .message-box h3 {
            margin-bottom: 10px;
            color:#003366;
        }

        .message-box p {
            margin: 5px 0;
        }

        .message-box .subject {
            font-weight: bold;
        }

        .message-box .email {
            font-style: italic;
        }

        .response-form {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .response-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .response-form button {
            width: 100%;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        .response-form button:hover {
            background-color: darkblue;
        }
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
    .ll{
        margin-top: 400px;
    }
    </style>
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

<div class="admin-container">
    <h2>Messages des Clients</h2>

    <?php if (count($messages) > 0): ?>
        <?php foreach ($messages as $message): ?>
            <div class="message-box">
                <h3><?= htmlspecialchars($message['NOM']) ?> (<?= htmlspecialchars($message['Email']) ?>)</h3>
                <p class="subject"><?= htmlspecialchars($message['Sujet']) ?></p>
                <p><?= nl2br(htmlspecialchars($message['Message'])) ?></p>
                <p><small>Envoyé le <?= date('d/m/Y H:i', strtotime($message['DateContact'])) ?></small></p>
                <form action="supprimer_contact.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
            <input type="hidden" name="id" value="<?= $message['IdContact'] ?>">
            <button type="submit" class="btn btn-danger mt-2">Supprimer</button>
        </form>
            </div>
            
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun message n'a été envoyé.</p>
    <?php endif; ?>
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
