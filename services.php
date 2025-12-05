

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>
    <style>
         .background-section {
            background-image: url('photo et logo/bk15.jpg'); /* 🔁 Mets ici le chemin correct de l'image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 500px;
            width: 100%;
             margin-top:60px ;
        } 
        .background-section h1 {
           
            color: #0055a5;
            text-align: center;
            padding-top: 200px; 
            font-size: 3em; 
        }
        .background-section p {
            color: white;
            text-align: center;
            font-size: 1.5em; 
        }
        .background-section .content {
            position: absolute;
            text-align: center;
            color: white;
            padding: 20px;
            top: 20%;
        } 
        .floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #003366;
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    transition: background-color 0.3s;
  }

  .floating-btn:hover {
    background-color: #0055a5;
  }

  .floating-btn a {
    color: white;
    text-decoration: none;
    display: block;
  }
    </style>
</head>
<body>

    
    <div class="background-section"> 
        <div class="content">
        <h1>Bonjour dans Notre Services </h1>
    <p>Nous offrons une large gamme de services pour répondre à tous vos besoins de voyage, confort et sécurité.</p>
        </div>
    </div>
    <div class="floating-btn">
  <a href="mesreservation.php" title="Mes reservation">
    <i class="fa fa-calendar-check"></i>
  </a>
</div>

    <!-- Contenu principal -->
    <div class="navbar">
        <div class="logo">
            <img src="photo et logo/logo3.png" alt="Logo" />
        </div>
        <ul>
            <li><a href="services.php">Accueil</a></li>
            <li><a href="vols.php">Vols</a></li>
            <li><a href="bateaux.php">Bateaux</a></li>
            <li><a href="hotel.php">Hotels</a></li>
            <li><a href="circuit.php">Circuit Touristique</a></li>
            <li><a href="voyage.php">Voyages</a></li>
            <li><a href="contact2.php">Contact</a></li>
            <li><a href="deconnexion.php">Se déconnecter</a></li>
        </ul>
    </div>

    <section class="social-section">
        <br>
        <h3>TROUVEZ-NOUS SUR</h3>
        <br>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-snapchat"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </section>

</body>
</html>
