<?php
require 'koneksi.php';

$stmt = $conn->prepare("SELECT id, jenis, harga, gambar FROM ramadhan");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eternal Bloom</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>

<header>
<nav>
    <div class="nav-container">
        <img src="Logo3.png" alt="Logo" class="logo">
        <ul class="nav-links">
            <li><a href="#menu" style="text-decoration: double gold;">Menu</a></li>
            <li><a href="index.html">Home</a></li>
            <li><a href="#hamper">Hampers</a></li>
            <li><a href="#bouquet">Bouquets</a></li>
        </ul>
        <a href="login.html" class="profil">
            <img src="profile.png" class="pro-icon">
        </a>
    </div>
</nav>
</header>

<div class="v-cont">

    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="v-card">
            <img src="<?php echo htmlspecialchars($row['gambar']); ?>">

            <div class="v-info">
                <div class="infos">
                    <h4><?php echo htmlspecialchars($row['jenis']); ?></h4>
                    <p>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                </div>

                <div class="buttons">
                
                    <a class="info-btn" href="checkout_ram.php?id=<?php echo $row['id']; ?>">Buy</a>
                    <a class="info-btn" href="checkout.php?id=<?php echo $row['id']; ?>">Add to Cart</a>
                </div>

            </div>
        </div>
    <?php endwhile; ?>

</div>

</body>
</html>
