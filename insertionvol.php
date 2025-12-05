<?php
include 'connexion.php';

if (
    !empty($_POST["destination"]) &&
    !empty($_POST["compagnie"]) &&
    !empty($_POST["numvol"]) &&
    !empty($_POST["dateD"]) &&
    !empty($_POST["heureD"]) &&
    !empty($_POST["dateA"]) &&
    !empty($_POST["heureA"]) &&
    !empty($_POST["prixE"]) &&
    !empty($_POST["prixB"]) &&
    !empty($_POST["prixP"]) &&
    isset($_FILES["image"]) && $_FILES["image"]["error"] === 0
) {
    $image_name = basename($_FILES["image"]["name"]);
    $image_tmp = $_FILES["image"]["tmp_name"];
    $upload_dir = "photo et logo/";
    $image_path = $upload_dir . $image_name;
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_exts = ["jpg", "jpeg", "png", "gif"];

    if (in_array($ext, $allowed_exts)) {
        move_uploaded_file($image_tmp, $image_path);
        $query = "INSERT INTO Vols(Destination, Compagnie, NumVol, DateDepart, HeureDepart, DateArrivee, HeureArrivee, PrixEconomique,PrixBusiness,PrixPremiere, image)
                  VALUES (:destination, :compagnie, :numvol, :dateD, :heureD, :dateA, :heureA, :prixE,:prixB,:prixP ,:image)";
        
        $pdostmt = $connexion->prepare($query);
        $pdostmt->execute([
            "destination" => $_POST["destination"],
            "compagnie" => $_POST["compagnie"],
            "numvol" => $_POST["numvol"],
            "dateD" => $_POST["dateD"],
            "heureD" => $_POST["heureD"],
            "dateA" => $_POST["dateA"],
            "heureA" => $_POST["heureA"],
            "prixE" => $_POST["prixE"],
            "prixB" => $_POST["prixB"],
            "prixP" => $_POST["prixP"],
            "image" => $image_name 
        ]);
        $pdostmt->closeCursor();

        header("Location: affuchagevols.php");
        exit;
    } 
} 

?>
