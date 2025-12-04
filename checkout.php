<?php
require 'koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID produk tidak valid.");
}
$product_id = intval($_GET['id']);
$qty = isset($_GET['qty']) && is_numeric($_GET['qty']) && $_GET['qty'] > 0 
        ? intval($_GET['qty']) 
        : 1;

$stmt = $conn->prepare("SELECT jenis, harga, gambar FROM hampers WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Produk tidak ditemukan.");
}
$product = $result->fetch_assoc();
$stmt->close();

$base_price = $product['harga'];
$subtotal = $base_price * $qty;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.3.8-dist/css/bootstrap.css">
    <link rel="stylesheet" href="check.css">
</head>
<body>
    <header>
        
    </header>

    <div class="container">

        <div class="left">
           <div class="header-cart">
            <a class="btn-info" href="buy.php">❮</a>
            <h2 class="shop"><?php echo htmlspecialchars($product['jenis']); ?></h2>
            </div>
            <div class="cart-item">
                <img src="<?php echo htmlspecialchars($product['gambar']); ?>" alt="Bouquet">
            </div>
        </div>

    
        <div class="right">

            <h2>Subtotal: Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></h2>
            <p class="note-info">Orders will be processed in Rp.</p>

            <p class="delivery-label">Select local delivery OR in-store pickup:</p>

            <div class="delivery-options">
                <button class="delivery active">Local Delivery</button>
                <button class="pickup">In-Store Pickup</button>
            </div>

        
            <label class="title" style="margin-top: 25px;">DELIVERY DATE</label>

            <div class="delivery-date-container">
              
            </div>

            
            <h4 style="margin-top: 25px;">Recipient Information</h4>

            <label class="title" style="margin-top: 25px;">NAMA PENERIMA</label>
            <input type="text" id="penerima" class="form-control">

        <label class="title" style="margin-top: 25px;">NAMA PENGIRIM</label>
            <input type="text" id="pengirim" class="form-control">

            <br>

        
            <label class="title" style="margin-top: 25px;">ADD A CARD MESSAGE / ORDER NOTES</label>

            <div style="display:flex;align-items:center;gap:7px;margin-bottom:5px;">
                <input type="checkbox" id="skipNotes">
                <label for="skipNotes" style="margin:0;font-size:14px;cursor:pointer;">Leave notes blank</label>
            </div>

            <textarea id="notes" class="notes-box"></textarea>

             <div id="payment">

                <label class="title">PAYMENT METHOD</label>
                <select class="form-select payment-select">
                    <option value="">Choose payment method </option>
                    <option value="cash">cash</option>
                    <option value="debit">debit card</option>
                    <option value="credit">credit card</option>
                    <option value="mobile">mobile banking</option>

                </select>

            </div>

             <div id="alamat-section">
           <label class="title" style="margin-top: 25px;">ALAMAT</label>
            <input type="text" id="alamat" class="form-control">
            </div>

            
            <div id="delivery-section">

                <label class="title">DELIVERY CITY</label>
                <select class="form-select city-select">
                    <option>Choose Delivery City</option>
                    <option>Medan Amplas</option>
                    <option>Medan Area</option>
                    <option>Medan Barat</option>
                    <option>Medan Baru</option>
                    <option>Medan Belawan</option>
                    <option>Medan Deli</option>
                    <option>Medan Denai</option>
                    <option>Medan Helvetia</option>
                    <option>Medan Johor</option>
                    <option>Medan Kota</option>
                    <option>Medan Labuhan</option>
                    <option>Medan Maimun</option>
                    <option>Medan Marelan</option>
                    <option>Medan Perjuangan</option>
                    <option>Medan Petisah</option>
                    <option>Medan Polonia</option>
                    <option>Medan Sunggal</option>
                    <option>Medan Tembung</option>
                    <option>Medan Timur</option>
                    <option>Medan Tuntungan</option>
                    <option>Medan  Selayang</option>

                </select>

                <label class="title" style="margin-top: 25px;">DELIVERY TIME</label>

                <div class="delivery-time-container">
                    <div class="time-item selected">Morning (8AM - 11AM)</div>
                    <div class="time-item">Afternoon (1PM - 4PM)</div>
                    <div class="time-item">Evening (6PM - 9PM)</div>
                </div>

            </div>

        
            <button type="button" class="checkout" id="checkoutBtn">Checkout</button>
            <a href="index.php" class="continue">CONTINUE SHOPPING</a>

        </div>
    </div>


<script>

const calendarInput = document.getElementById("calendarInput");

document.querySelectorAll('.date-item').forEach(item => {
    item.addEventListener('click', () => {
        let day = item.textContent.trim();
        let today = new Date();
        let month = today.getMonth() + 1;
        let year = today.getFullYear();

        
        let formatted = `${day.padStart(2,'0')}/${String(month).padStart(2,'0')}/${year}`;

        
        calendarInput.value = `${year}-${String(month).padStart(2,'0')}-${day.padStart(2,'0')}`;
    });
});


document.querySelectorAll('select').forEach(sel => {
    let first = sel.querySelector('option');
    if (first) first.disabled = true;
});


const paymentSelect = document.querySelector('.payment-select');

paymentSelect.addEventListener('change', validateForm);


const oldValidate = validateForm;
validateForm = function(){
    oldValidate(); 

    
    if (paymentSelect.selectedIndex === 0) {
        disableCheckout();
    }
};
</script>
</body>
</html>


<script>
document.addEventListener('DOMContentLoaded', function() {
   
    let price = <?php echo $base_price ?>;
    let qty   = <?php echo $qty ?>;

    const qtyContainer = document.querySelector('.quantity');
    const qtyText = qtyContainer ? qtyContainer.querySelector('span') : null;
    const plusBtn = qtyContainer ? qtyContainer.querySelector('.qty-plus') : null;
    const minusBtn = qtyContainer ? qtyContainer.querySelector('.qty-minus') : null;
    const subtotalText = document.querySelector('.right h2');

    function updateAll() {
        if (qtyText) qtyText.textContent = qty;
        let subtotal = price * qty;
        if (subtotalText) subtotalText.innerHTML = 'Subtotal: Rp. ' + subtotal.toLocaleString('id-ID');
    }

    if (plusBtn) plusBtn.addEventListener('click', () => { qty++; updateAll(); });
    if (minusBtn) minusBtn.addEventListener('click', () => { qty--; if (qty < 1) qty = 1; updateAll(); });

    updateAll(); // initial

    
    const checkoutBtn = document.querySelector('.checkout');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            if (checkoutBtn.disabled) return; // do nothing when disabled
            window.location.href = 'ordersuccess.html';
        });
    }

   
    const penerima = document.getElementById('penerima');
    const pengirim = document.getElementById('pengirim');
    const alamat = document.getElementById('alamat');
    const notes = document.getElementById('notes');
    const skipNotes = document.getElementById('skipNotes');

    const deliveryBtn = document.querySelector('.delivery');
    const pickupBtn = document.querySelector('.pickup');
    const alamatSection = document.getElementById('alamat-section');
    const deliverySection = document.getElementById('delivery-section');

    function enableCheckout() {
        if (!checkoutBtn) return;
        checkoutBtn.disabled = false;
        checkoutBtn.style.opacity = '1';
        checkoutBtn.style.cursor = 'pointer';
    }

    function disableCheckout() {
        if (!checkoutBtn) return;
        checkoutBtn.disabled = true;
        checkoutBtn.style.opacity = '0.5';
        checkoutBtn.style.cursor = 'not-allowed';
    }

    function validateForm() {
        let isDelivery = deliveryBtn && deliveryBtn.classList.contains('active');

        if (isDelivery) {
            if (
                penerima && penerima.value.trim() !== '' &&
                pengirim && pengirim.value.trim() !== '' &&
                alamat && alamat.value.trim() !== ''
            ) {
                enableCheckout();
            } else {
                disableCheckout();
            }
        } else {
            if (
                penerima && penerima.value.trim() !== '' &&
                pengirim && pengirim.value.trim() !== ''
            ) {
                enableCheckout();
            } else {
                disableCheckout();
            }
        }
    }

    
    if (penerima) penerima.addEventListener('input', validateForm);
    if (pengirim) pengirim.addEventListener('input', validateForm);
    if (alamat) alamat.addEventListener('input', validateForm);
    if (notes) notes.addEventListener('input', validateForm);

    if (skipNotes) {
        skipNotes.addEventListener('change', () => {
            if (skipNotes.checked) {
                if (notes) { notes.disabled = true; notes.value = ''; }
            } else {
                if (notes) notes.disabled = false;
            }
            validateForm();
        });
    }

    
    if (deliveryBtn && pickupBtn) {
        deliveryBtn.addEventListener('click', () => {
            deliveryBtn.classList.add('active');
            pickupBtn.classList.remove('active');
            if (alamatSection) alamatSection.style.display = 'block';
            if (deliverySection) deliverySection.style.display = 'block';
            validateForm();
        });

        pickupBtn.addEventListener('click', () => {
            pickupBtn.classList.add('active');
            deliveryBtn.classList.remove('active');
            if (alamatSection) alamatSection.style.display = 'none';
            if (deliverySection) deliverySection.style.display = 'none';
            validateForm();
        });
    }

    
    if (alamatSection) alamatSection.style.display = 'block';
    if (deliverySection) deliverySection.style.display = 'block';

    
    const dateContainer = document.querySelector('.delivery-date-container');
    if (dateContainer) {
        dateContainer.innerHTML = '';

        let today = new Date();
        let todayDate = today.getDate();
        let todayMonth = today.getMonth();
        let todayYear = today.getFullYear();

        for (let i = 0; i < 7; i++) {
            let newDate = new Date(todayYear, todayMonth, todayDate + i);
            let day = newDate.getDate();

            let div = document.createElement('div');
            div.classList.add('date-item');
            div.textContent = day;

            if (i === 0) div.classList.add('selected');

            div.addEventListener('click', () => {
                document.querySelectorAll('.date-item').forEach(e => e.classList.remove('selected'));
                div.classList.add('selected');
            });

            dateContainer.appendChild(div);
        }

        let calendarInput = document.createElement('input');
        calendarInput.type = 'date';
        calendarInput.min = today.toISOString().split('T')[0];
        calendarInput.classList.add('form-control');
        dateContainer.insertAdjacentElement('afterend', calendarInput);

        calendarInput.addEventListener('change', () => {
            let chosenDate = new Date(calendarInput.value).getDate();
            document.querySelectorAll('.date-item').forEach(e => e.classList.remove('selected'));
            document.querySelectorAll('.date-item').forEach(e => {
                if (parseInt(e.textContent) === chosenDate) e.classList.add('selected');
            });
        });
    }

    
    document.querySelectorAll('.time-item').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.time-item').forEach(el => el.classList.remove('selected'));
            item.classList.add('selected');
        });
    });

    
    validateForm();
});
</script>

<script src="Bootstrap/bootstrap-5.3.8-dist/js/bootstrap.js"></script>