<?php
require 'koneksi.php';

$stmt = $conn->prepare("SELECT id, jenis, harga, gambar FROM bouquets ORDER BY id ASC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.3.8-dist/css/bootstrap.css">
    <title>Add to Cart Hampers</title>
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
            min-height: 100vh;
            color: #333;
        }
        .back-btn {
            color: white;
            font-weight: bolder;
            font-size: 20px;
            text-decoration: none;
            border-radius: 10px;
            background: red;
            padding: 10px 15px;
            cursor: pointer;
            display: inline-block;
            margin: 20px;
        }
        .container {
            font-family: cinzel, sans-serif;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            padding: 30px;
            border-bottom: 1px solid #ccc;
        }
        .product-image {
            flex: 1;
            min-width: 300px;
        }
        .product-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 20px;
        }
        .product-details {
            flex: 2;
            min-width: 300px;
        }
        .product-details h1 {
            color: #9f8429d2;
            margin-bottom: 10px;
        }
        .price {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .qty-selector {
            display: flex;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
        }
        .qty-selector input {
            width: 50px;
            text-align: center;
            border: none;
            padding: 5px 0;
        }
        .qty-selector button {
            padding: 5px 10px;
            border: none;
            background: none;
            font-size: 20px;
            cursor: pointer;
        }
        .add-to-cart {
            background-color: #D4AF37;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
        }
        .add-to-cart:hover {
            background-color: #87712a;
        }
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <a class="back-btn" href="index.php">&lt; Back</a>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="product-container">

            <div class="product-image">
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['jenis']); ?>">
            </div>

            <div class="product-details">
                <h1><?php echo htmlspecialchars($row['jenis']); ?></h1>

                <h3>IDR:</h3>
                <div class="price">
                    <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                </div>

                <p>Add a touch of texture to your table with this exclusive design. Perfect for a playful and unique celebration.</p>
                <p>Priced individually.</p>

                <p><i>Designer Recommendation: You can design your own greeting card.</i></p>

                <p><b>***Rp. 100.000 minimum is required for delivery.***</b></p>

                <div class="form-section">
                    <label>Qty</label>
                    <div class="qty-selector">
                        <button class="minus">-</button>
                        <input type="number" value="1" min="1" max="20">
                        <button class="plus">+</button>
                    </div>
                    <a class="add-to-cart" href="checkout_bou.php?id=<?php echo $row['id']; ?>&qty=" onclick="this.href += this.parentElement.querySelector('input[type=number]').value;">ADD TO CART</a>
                </div>
            </div>

        </div>
    <?php } ?>
</div>

<script>
document.querySelectorAll('.product-container').forEach(container => {
    const priceElement = container.querySelector('.price');
    const qtyInput = container.querySelector('input[type="number"]');

    let basePrice = parseInt(priceElement.textContent.replace(/\./g, ''));
    if (isNaN(basePrice)) basePrice = 0;

    function updateTotal() {
        let qty = parseInt(qtyInput.value);
        if (isNaN(qty) || qty < 1) qty = 1;
        const total = basePrice * qty;
        priceElement.textContent = total.toLocaleString('id-ID');
    }

    const btnMinus = container.querySelector('.qty-selector .minus');
    const btnPlus = container.querySelector('.qty-selector .plus');

    btnMinus.addEventListener('click', () => {
        let v = parseInt(qtyInput.value) || 1;
        if (v > 1) qtyInput.value = v - 1;
        updateTotal();
    });
    btnPlus.addEventListener('click', () => {
        let v = parseInt(qtyInput.value) || 1;
        qtyInput.value = v + 1;
        updateTotal();
    });

    qtyInput.addEventListener('input', updateTotal);
});
</script>
<script src="Bootstrap/bootstrap-5.3.8-dist/css/bootstrap.j"></script>
</body>
</html>
