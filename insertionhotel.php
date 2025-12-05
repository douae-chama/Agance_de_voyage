<?php
include 'connexion.php';
if(
    !empty($_POST["nom"])&&
    !empty($_POST["adresse"])&&
    !empty($_POST["descriptions"])&&
    !empty($_POST["prix"]) &&
    isset($_FILES["image"]) && $_FILES["image"]["error"] === 0)
{
    $image_name = basename($_FILES["image"]["name"]);
    $image_tmp = $_FILES["image"]["tmp_name"];
    $upload_dir = "uploads/";
    $image_path = $upload_dir . $image_name;
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_exts = ["jpg", "jpeg", "png", "gif"];
    if (in_array($ext, $allowed_exts)) {
        move_uploaded_file($image_tmp, $image_path);
    $query="insert into Hotels(Nom,Adresse,Description, PrixParNuit,image)values(:nom,:adresse,:descriptions,:prix,:image)";
    var_dump($query);
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute([
        "nom"=>$_POST["nom"],
        "adresse"=>$_POST["adresse"],
        "descriptions"=>$_POST["descriptions"],
        "prix"=>$_POST["prix"],
        "image" => $image_name]);
    $pdostmt->closeCursor();
    header("Location:affichagehotels.php");} 
    }
?>