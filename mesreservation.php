<?php
session_start();
include("connexion.php");

if (!isset($_SESSION['IdClient'])) {
    header("Location: loing.php");
    exit();
}

$idClient = $_SESSION['IdClient'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['annuler_reservation'])) {
    $idReservation = $_POST['id_reservation'] ?? null;

    if ($idReservation) {
        $stmtCheck = $connexion->prepare("SELECT * FROM Reservations WHERE IdReservation = ? AND IdClient = ?");
        $stmtCheck->execute([$idReservation, $idClient]);
        $reservation = $stmtCheck->fetch();

        if ($reservation) {
            $stmtDelete = $connexion->prepare("UPDATE Reservations SET Statut = 'Annulée' WHERE IdReservation = ?");
            $stmtDelete->execute([$idReservation]);
        } else {
            $message = "Impossible d'annuler cette réservation.";
        }
    } else {
        $message = "ID de réservation invalide.";
    }
}

$stmt = $connexion->prepare("
    SELECT R.*, 
           V.Titre AS VoyageTitre, V.image AS VoyageImage,
           H.Nom AS HotelNom, H.image AS HotelImage,
           C.Titre AS CircuitTitre, C.image AS CircuitImage,
           Vo.NumVol AS VolNumero, Vo.Compagnie AS VolCompagnie, Vo.image AS VolImage,
           B.NumBateau AS BateauNumero, B.Compagnie AS BateauCompagnie, B.image AS BateauImage
    FROM Reservations R
    LEFT JOIN Voyages V ON R.IdVoyage = V.IdVoyage
    LEFT JOIN Hotels H ON R.IdHotel = H.IdHotel
    LEFT JOIN Circuits C ON R.IdCircuit = C.IdCircuit
    LEFT JOIN Vols Vo ON R.IdVol = Vo.IdVol
    LEFT JOIN Bateaux B ON R.IdBateau = B.IdBateau
    WHERE R.IdClient = ?
");
$stmt->execute([$idClient]);
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #eef2f3;
            padding: 30px;
        }
        h2 {
            color: #003366;
            margin-bottom: 20px;
        }
        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-content h3 {
            margin-top: 0;
            color: #003366;
        }
        .card-content p {
            margin: 6px 0;
        }
        .annuler-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background-color: #002244;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .annuler-btn:hover {
            background-color: #003366;
        }
        .retour-btn {
    display: inline-block;
    margin-bottom: 20px;
    background-color: #003366;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s;
}
.retour-btn:hover {
    background-color: #002244;
}

    </style>
</head>
<body>

<a href="services.php" class="retour-btn">← Routeur a l'Accueil</a>
<h2>Mes Réservations</h2>

<?php if (isset($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (count($reservations) > 0): ?>
    <div class="card-container">
        <?php foreach ($reservations as $res): ?>
            <div class="card">
                <?php
                $image = '';
                $titre = '';
                if ($res['IdVoyage']) {
                    $image ="photo et logo/" . $res['VoyageImage'];
                    $titre = "Voyage: " . $res['VoyageTitre'];
                } elseif ($res['IdHotel']) {
                    $image = "photo et logo/" . $res['HotelImage'];
                    $titre = "Hôtel: " . $res['HotelNom'];
                } elseif ($res['IdCircuit']) {
                    $image ="photo et logo/" . $res['CircuitImage'];
                    $titre = "Circuit: " . $res['CircuitTitre'];
                } elseif ($res['IdVol']) {
                    $image = "photo et logo/" . $res['VolImage'];
                    $titre = "Vol: " . $res['VolCompagnie'] . " - " . $res['VolNumero'];
                } elseif ($res['IdBateau']) {
                    $image = "photo et logo/" .$res['BateauImage'];
                    $titre = "Bateau: " . $res['BateauCompagnie'] . " - " . $res['BateauNumero'];
                } else {
                    $titre = "Service inconnu";
                }
                ?>
                <img src="<?= htmlspecialchars($image) ?>" alt="Image">
                <div class="card-content">
                    <h3><?= htmlspecialchars($titre) ?></h3>
                    <p><strong>Date:</strong> <?= htmlspecialchars($res['DateReservation']) ?></p>
                    <p><strong>Nom et Prenom:</strong> <?= htmlspecialchars($res['Nom'] . ' ' . $res['Prenom']) ?></p>
                    <p><strong>Téléphone:</strong> <?= htmlspecialchars($res['telephone']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($res['email']) ?></p>
                    <p><strong>Adresse:</strong> <?= htmlspecialchars($res['Adresse']) ?></p>
                    <p><strong>Nombre de personnes:</strong> <?= htmlspecialchars($res['NombrePersonnes']) ?></p>
                    <p><strong>Prix total:</strong> <?= htmlspecialchars($res['prixtotal']) ?> DH</p>
                    <p><strong>Statut:</strong> <?= htmlspecialchars($res['Statut']) ?></p>

                    <form method="post" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">
                        <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($res['IdReservation']) ?>">
                        <button type="submit" name="annuler_reservation" class="annuler-btn">Annuler</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune réservation trouvée.</p>
<?php endif; ?>
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
