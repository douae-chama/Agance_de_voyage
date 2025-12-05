<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #003366;
        }

        .navbar1 {
            background-color: #003366;
            /* Bleu ciel */
            display: flex;
            justify-content: space-between;
            /* space between: logo يسار، menu يمين */
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
            color: #56ABD9;
        }

        /* Search form inside menu */
        .f {
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

        .f .uu {
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

        .f .uu:focus {
            border-color: #56ABD9;
            background-color: #f9f9f9;
        }

        .f .fa {
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


        .f:hover {
            width: 300px;
            border-color: #003366;
        }

        .f:hover input {
            display: block;
            width: 100%;
            padding: 0 20px;
        }

        .f:hover .fa {
            background-color: #003366;
            transform: rotate(180deg);
        }


        .f .uu::placeholder {
            color: #aaa;
            font-style: italic;
        }

        .social-icons a {
            text-decoration: none;
            color: white;
            font-size: 30px;
            margin: 0 10px;
        }

        .social-section h3 {
            color: white;
        }

        .social-section a :hover {
            color: #56ABD9;
        }

        .social-section {
            text-align: center;
            background-color: #003366;
            height: 150px;
            box-shadow: 0 4px 10px white;
            width: 100%;
            margin-top: 300px;
        }

        /* Centrage du formulaire */
        /* تحريك الفورم إلى المركز العمودي */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #003366;
            display: flex;
            justify-content: center;
            /* توسيط أفقي */
            align-items: center;
            /* توسيط عمودي */
            min-height: 100vh;
            /* لضمان التوسيط الكامل */
            flex-direction: column;
            padding-top: 100px;
            background: linear-gradient(to right, rgb(241,247,246),rgb(10, 10, 114), rgb(17, 18, 94));

            /* المسافة فوق الفورم لتفادي تداخل مع المينيو */
        }

        .for {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            /* تحديد أقصى عرض للفورم */
        }

        /* تنسيق التسمية */
        .for label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        /* تنسيق الحقول داخل الفورم */
        .for input[type="text"],
        .for input[type="tel"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }


        .for input[type="text"]:focus,
        .for input[type="tel"]:focus {
            border-color: #003366;
            outline: none;
        }

        /* زر الإرسال */
        .btn {
            background-color: #003366;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        /* تأثير عند المرور فوق الزر */
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="navbar1">
        <div class="logo">
            <img src="photo et logo/logo3.png" alt="Logo" />
        </div>
        <ul>
            <li>
                <form method="POST" action="search_globale.php" class="f">
                    <input type="search" name="search" placeholder="Rechercher un destination..." class="uu" required>
                    <i class="fa fa-search"></i>
                </form>
            </li>
            <li><a href="home.php">Accueil</a></li>
            <li><a href="loing.php">Espace Client</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
    <div class="for">
        <form action="insertionclient.php" method="POST">
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="nom" maxlength="50" required><br><br>

            <label for="prenom">Prénom:</label><br>
            <input type="text" id="prenom" name="prenom" maxlength="30" required><br><br>

            <label for="telephone">Téléphone:</label><br>
            <input type="tel" id="telephone" name="telephone" maxlength="15" required><br><br>

            <label for="adresse">Adresse:</label><br>
            <input type="text" id="adresse" name="adresse" maxlength="100" required><br><br>


            <input type="submit" value="S'incrire" class="btn"><br><br>
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