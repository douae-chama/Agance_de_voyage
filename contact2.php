<?php
include("connexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];
    $id_client = 1;
    $query = $connexion->prepare("INSERT INTO Contact (IdClient, NOM, Email, Sujet, Message) VALUES (:id_client, :nom, :email, :sujet, :message)");
    $query->bindParam(':id_client', $id_client);
    $query->bindParam(':nom', $nom);
    $query->bindParam(':email', $email);
    $query->bindParam(':sujet', $sujet);
    $query->bindParam(':message', $message);

    if ($query->execute()) {
        echo "<p>Votre message a été envoyé avec succès.</p>";
    } else {
        echo "<p>Une erreur est survenue, veuillez réessayer.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire de Contact</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, rgb(241, 247, 246), rgb(10, 10, 114), rgb(17, 18, 94));
        }

        .contact-form {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #0055a5;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-top: 10%;
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #003366;
        }

        .contact-form label {
            color: #003366;
            font-weight: bold;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #56ABD9;
            outline: none;
        }

        .contact-form button {
            width: 100%;
            padding: 12px;
            background-color: rgb(17, 16, 94);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: rgb(1, 98, 150);
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
    display: flex;              /* <-- هنا */
    justify-content: center;    /* أفقياً */
    align-items: center;        /* عمودياً */
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
    <div class="floating-btn">
  <a href="mesreservation.php" title="Mes reservation">
    <i class="fa fa-calendar-check"></i>
  </a>
</div>
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
    <div class="contact-form">
        <h2>Formulaire de Contact</h2>
        <form method="POST" action="">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="sujet">Sujet:</label>
            <input type="text" id="sujet" name="sujet" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Envoyer</button>
        </form>
    </div>
    <section class="social-section"><BR>
        <h3>TROUVEZ-NOUS SUR</h3><BR>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-snapchat"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
    </section>
</body>

</html>