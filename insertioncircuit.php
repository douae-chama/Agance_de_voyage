<?php
include 'connexion.php';
if(
    !empty($_POST["titre"])&&
    !empty($_POST["description"])&&
    !empty($_POST["prix"])&&
    !empty($_POST["duree"]&&
    !empty($_POST["dateD"])&&
    isset($_FILES["image"]) && $_FILES["image"]["error"] === 0))
   
{
    $image_name = basename($_FILES["image"]["name"]);
    $image_tmp = $_FILES["image"]["tmp_name"];
    $upload_dir = "uploads/";
    $image_path = $upload_dir . $image_name;
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_exts = ["jpg", "jpeg", "png", "gif"];
    if (in_array($ext, $allowed_exts)) {
        move_uploaded_file($image_tmp, $image_path);
    $query="insert into Circuits(Titre,Description,Prix,Duree,DateDepart,image)values(:titre,:description,:prix,:duree,:dateD,:image)";
    var_dump($query);
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute([
        "titre"=>$_POST["titre"],
        "description"=>$_POST["description"],
        "prix"=>$_POST["prix"],
        "duree"=>$_POST["duree"],
        "dateD"=>$_POST["dateD"],
        "image" => $image_name]);
    $pdostmt->closeCursor();
    header("Location:affichagecircuit.php");} 
}
?>
