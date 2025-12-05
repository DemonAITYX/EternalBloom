<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit;
}

$con = mysqli_connect("localhost", "root", "", "eternal");

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php#hamper");
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($con, "SELECT * FROM hampers WHERE id = $id LIMIT 1");

if (mysqli_num_rows($query) == 0) {
    echo "<h3 style='color:white; text-align:center;'>Produk tidak ditemukan.</h3>";
    exit;
}

$product = mysqli_fetch_assoc($query);

$namaProduk = $product['jenis'];
$gambarProduk = $product['gambar'];
$hargaProduk = $product['harga'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.3.8-dist/css/bootstrap.css">
    <title>Buy Flowers</title>
</head>
<style>

    * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
}

    body {
    margin: 0;
    padding: 0;
    background: #0b1b38;
    height: 100%;
    overflow-x: hidden;
    }

    .back-btn {
        color: white;
        font-weight: bolder;
        font-size: 20px;
        text-decoration: none;
        align-items: center;
        border-radius: 10px;
        background: red;
        padding: 10px 15px;
        cursor: pointer;
        transform: .2s ease;
    }

    .e-card{
        height: auto;
    }

    img {
    padding: 100px 20px;
    text-align: center;
    color: #f9f9f9;
    font-weight: bold;
    height: 600px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

    .container{
        font-family: cinzel;
        margin-block: 70px;
        padding-top: 15px;
        padding-bottom: 35px;
        border-radius: 20px;
        background: #f5f5f5;
    }

    #total-price-display{
        font-weight: bold;
        font-size: 40px;
        display: flex;
        align-items: center;
        margin-inline: auto;
        margin-bottom: 20px;
        width: fit-content;
    }

    .breadcrumb {
    font-size: 0.8em;
    color: #888;
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.product-container {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
}

.product-image {
    flex: 1;
    min-width: 300px;
    margin-top: 35px;
}

.image-placeholder {
    padding: 100px 20px;
    text-align: center;
    font-weight: bold;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-details {
    flex: 2;
    min-width: 300px;
}

.product-details h1 {
    margin-bottom: 10px;
    color: #9f8429d2;
}

.price {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

#buy p {
    margin-bottom: 10px;
}

.designer-rec {
    font-style: italic;
    color: #555;
}

.delivery-info {
    font-weight: bold;
    margin-top: 15px;
    margin-bottom: 20px;
}

.form-section {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
}

.qty-selector {
    display: flex;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.qty-selector button {
    background: none;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    font-size: 1.2em;
}

.qty-selector input {
    width: 40px;
    text-align: center;
    border: none;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 5px 0;
}

.add-to-cart {
    background-color: #D4AF37;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    text-transform: uppercase;
}

.add-to-cart:hover {
    background-color: #87712a;
}

.pickup-info {
    margin-top: 20px;
    font-size: 0.9em;
    color: #333;
}

.checkmark {
    color: green;
    margin-right: 5px;
    font-weight: bold;
}

.pickup-info a {
    color: #007bff;
    text-decoration: none;
    display: block;
    margin-top: 5px;
}

.logout{
    background: red;
    width: 80px;
    border-radius: 8px;
    text-decoration: none;
}

.logout a{
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-family: cinzel;
}

@media (max-width: 768px) {
    .product-container {
        flex-direction: column;
    }

    .form-section {
        flex-wrap: wrap;
    }
}

</style>
<body>
    <header>

    </header>
    <div class="container">
        <a class="back-btn" href="index.php#hamper"><</a>
        <div class="product-container">
            <div class="product-image">
                <div class="image-placeholder">
                    <img src="<?= $gambarProduk ?>" alt="<?= $namaProduk ?>">
                </div>
            </div>
            <div class="product-details">
                <h1><?= $namaProduk ?></h1>
                <h3>IDR:</h3>
                <span id="total-price-display">
                    <?= number_format($hargaProduk, 0, ',', '.') ?>
                </span>
                
                <p>Add a touch of texture to your Thanksgiving table with our Center Of Attentionbud vase collection! Perfect for a playful and unique Thanksgiving celebration.</p>
                
                <p>Priced individually.</p>
                
                <p class="designer-rec">Designer Recommendation: can design your own greeting card.</p>
                
                <p class="delivery-info">***Rp. 300.000 minimum is required for delivery.***</p>

                <div class="form-section">
                    <label for="qty">Qty</label>
                    <div class="qty-selector">
                        <button class="minus" onclick="updateQuantity(-1)">-</button>
                        <input type="number" id="qty" value="1" min="1" max="20">
                        <button class="plus" onclick="updateQuantity(+1)">+</button>
                    </div>
                    <a class="add-to-cart" id="checkoutBtn" href="#">ADD TO CART</a>
                </div>

                <div class="pickup-info">
                    <span class="checkmark">✔</span>
                    Pickup available at **Eternal Bloom Vanue**
                    <a href="index.php">View store information.</a>
                </div>
            </div>
        </div>
    </div>
    <div class="logout">
     <a class= "logout-btn" href="logout.php">Logout</a>
     </div>
     <script>
    const BASE_PRICE = <?= (int)$hargaProduk ?>;

function calculateTotal() {
    const qty = Number(document.getElementById('qty').value) || 1;
    const total = qty * BASE_PRICE;

    document.getElementById('total-price-display').textContent =
        total.toLocaleString('id-ID');

    const checkoutBtn = document.getElementById('checkoutBtn');

    const nameEnc = encodeURIComponent("<?= addslashes($namaProduk) ?>");
    const imgEnc  = encodeURIComponent("<?= addslashes($gambarProduk) ?>");

    if (checkoutBtn) {
        checkoutBtn.href =
            "checkout.php?id=<?= $id ?>" +
            "&name=" + nameEnc +
            "&img=" + imgEnc +
            "&price=<?= (int)$hargaProduk ?>" +
            "&qty=" + qty +
            "&subtotal=" + total;
    }
}

function updateQuantity(change) {
    const qtyInput = document.getElementById('qty');
    let value = Number(qtyInput.value) + change;

    if (value < 1) value = 1;
    if (value > 20) value = 20;

    qtyInput.value = value;
    calculateTotal();
}

document.addEventListener('DOMContentLoaded', calculateTotal);
</script>
</body>
</html>


<script href="Bootstrap/bootstrap-5.3.8-dist/js/bootstrap.bundle.js"></script>