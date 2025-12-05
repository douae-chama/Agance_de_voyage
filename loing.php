<?php
session_start();
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $stmt = $connexion->prepare("SELECT * FROM Utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        
        if ($password === $user['password']) {  
          
            $_SESSION['id'] = $user['id'];
            $_SESSION['nom'] = isset($user['nom']) ? $user['nom'] : ''; 
            $_SESSION['type_user'] = $user['type_user'];

           
            $stmtClient = $connexion->prepare("SELECT IdClient FROM Clients WHERE id_utilisateur = ?");
            $stmtClient->execute([$user['id']]);
            $client = $stmtClient->fetch();

            if ($client) {
                $_SESSION['IdClient'] = $client['IdClient'];
            }

       
            if ($user['type_user'] == 'admin') {
                header("Location: menu.php");
            } else {
                header("Location: services.php");
            }
            exit();
        } else {
            $erreur = "L'email ou le mot de passe est incorrect.";
        }
    } else {
        $erreur = "L'email ou le mot de passe est incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet"  href="reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, rgb(241,247,246),rgb(10, 10, 114), rgb(17, 18, 94));
            
        }

        h2 {
            color:rgb(70, 139, 208);
            text-align: center;
            margin-top: 9%;
        margin-right: 85px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border: 2px solid #0055a5;
            border-radius: 8px;
            width: 300px;
            margin-left: 430px;

        }

        label {
            color: #003366;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input:hover{
            border: 2px solid  #003366;
        }

        button {
            background-color: #0055a5;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
        }

        button:hover {
            background-color:  #56ABD9;
        }
        
.signup-button1 {
    display: inline-block;
    background-color: #56ABD9;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}


.signup-button1:hover {
    background-color: #0055a5;
}
     body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #003366;
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
    <h2>Connexion</h2>
    <?php if (isset($erreur)) echo '<p style="color:red; text-align: center;">' . $erreur . '</p>'; ?>
    <form method="post">
        <label for="email">Email :</label><br>
        <input type="email" name="email" placeholder="Email" required><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Connexion</button><br>
        <a href="inscriptionClient.php" class="signup-button1">S'inscrire</a>
    </form>
    
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
