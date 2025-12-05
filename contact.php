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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, rgb(241,247,246),rgb(10, 10, 114), rgb(17, 18, 94));
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

.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc; 
    border-radius: 4px;
}

.contact-form input:focus, .contact-form textarea:focus {
    border-color: #56ABD9; 
    outline: none; 
}

.contact-form button {
    width: 100%;
    padding: 12px;
    background-color:rgb(17, 16, 94); 
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.contact-form button:hover {
    background-color:rgb(1, 98, 150); 
}

       

.navbar1 {
    background-color:  #003366; /* Bleu ciel */
    display: flex;
    justify-content: space-between; /* space between: logo يسار، menu يمين */
    align-items: center;
   
    margin: 0px 0px;
    flex-wrap: wrap;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    
}

.navbar1 .logo img {
    max-width: 120px;
}

.navbar1 ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.navbar1 ul li {
    margin: 0 15px;
}

.navbar1 ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.navbar1 ul li a:hover {
    color:#56ABD9;
}

/* Search form inside menu */
.form {
    position: relative;
    width: 0;
    height: 40px;
    background: transparent;
    box-sizing: border-box;
    border-radius: 30px;
    border: 2px solid transparent;
    padding: 0 15px;
    display: flex;
    align-items: center;
    transition: all 0.5s ease;
    overflow: hidden;
    margin-top: -2px;
}

.form input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0 15px;
    font-size: 1.1rem;
    border-radius: 30px;
    outline: none;
    border: 2px solid #fff;
    background-color: #fff;
    color: #003366;
    display: none;
    transition: width 0.3s ease, padding 0.3s ease;
}

.form input:focus {
    border-color: #56ABD9;
    background-color: #f9f9f9;
}

.form .fa {
    box-sizing: border-box;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 50%;
    background: #003366;
    color: #fff;
    font-size: 1.4em;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 2px;
}


.form:hover {
    width: 300px;
    border-color: #003366;
}

.form:hover input {
    display: block;
    width: 100%;
    padding: 0 20px;
}

.form:hover .fa {
    background-color: #003366;
    transform: rotate(180deg);
}


.form input::placeholder {
    color: #aaa;
    font-style: italic;
}
.btn{
    background-color: #003366;
    color: white;
}
.btn:hover{
    background-color: #56ABD9;
}

    </style>
</head>
<body>
<div class="navbar1">
    <div class="logo">
        <img src="photo et logo/logo3.png" alt="Logo" />
    </div>
    <ul>
        <li> <form class="form" method="POST" action="search_globale.php">
    <input type="search" name="search" placeholder="Rechercher un destination..." required>
    <i class="fa fa-search"></i>
</form></li>
        <li><a href="home.php">Accueil</a></li>
        <li><a href="loing.php">Espace Client</a></li>
        <li><a href="contact.php">Contact</a></li>
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
