<?php
include 'connexion.php';



    if (
        !empty($_POST["titre"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["prix"]) &&
        !empty($_POST["datedepart"]) &&
        !empty($_POST["dateretour"]) &&
        !empty($_POST["destination"]) &&
        isset($_FILES["image"]) && $_FILES["image"]["error"] === 0
    ) {
        
        $titre = $_POST["titre"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $datedepart = $_POST["datedepart"];
        $dateretour = $_POST["dateretour"];
        $destination = $_POST["destination"];

      
        $image_name = basename($_FILES["image"]["name"]);
        $image_tmp = $_FILES["image"]["tmp_name"];
        $upload_dir = "photo et logo/";
        $image_path = $upload_dir . $image_name;

       
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_exts = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($ext, $allowed_exts)) {
            echo "Format de fichier non autorisé.";
            exit;
        }
        if (!move_uploaded_file($image_tmp, $image_path)) {
            echo "Échec du téléchargement de l'image.";
            exit;
        }

       
            $query = "
                INSERT INTO Voyages (Titre, Description, Prix, DateDepart, DateRetour, Destination, image)
                VALUES (:titre, :description, :prix, :datedepart, :dateretour, :destination, :image)
            ";
            $pdostmt = $connexion->prepare($query);
            $pdostmt->execute([
                "titre"        => $titre,
                "description"  => $description,
                "prix"         => $prix,
                "datedepart"   => $datedepart,
                "dateretour"   => $dateretour,
                "destination"  => $destination,
                "image"        => $image_name
            ]);

            header("Location: affichagevoyage.php");
            exit();
        }
   


?>
