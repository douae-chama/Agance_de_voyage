<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="insertionadmin.php" method="POST">
  <label for="nom">Nom:</label><br>
  <input type="text" id="nom" name="nom" maxlength="50" required><br><br>

  <label for="prenom">Prénom:</label><br>
  <input type="text" id="prenom" name="prenom" maxlength="30" required><br><br>

  <label for="telephone">Téléphone:</label><br>
  <input type="tel" id="telephone" name="telephone" maxlength="15" required><br><br>

  <label for="adresse">Adresse:</label><br>
  <input type="text" id="adresse" name="adresse" maxlength="100" required><br><br>

 

  <input type="submit" value="Envoyer">
</form>
</body>
</html>