<?php
session_start();
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
        <?php include 'navbar.php'; ?>
        <section id="home" class="hero">
            <div class="hero-content">
                <video autoplay muted loop class="video-bg">
                    <source src="flower.mp4" type="video/mp4">
                </video>
                <div class="hero-content">
                    <div class="hero-info">
                        <h1> Bunga Berbicara saat<br>Kata Tak Mampu</h1>
                        <p>"Kami menghadirkan berbagai pilihan bunga segar <br>yang penuh makna untuk setiap momen spesial Anda. <br>Dari hadiah romantis, ucapan selamat, hingga dekorasi <br>elegan, setiap bunga kami dipilih dengan penuh cinta <br>untuk menyampaikan pesan hati Anda. Mari temukan<br> keindahan dan kebahagiaan dalam setiap kelopak bunga."</p></p>
                    </div>
                </div>
        </section>

        <section>
            <div class="e-container">
                <div class="e-card">
                    <div class="e-imgs">
                        <img src="val (1).jpg">
                        <img src="val (2).jpg">
                        <img src="val (3).jpg">
                        <img src="val (4).jpg">
                    </div>
                    <h1 class="pro-name">Valentine</h1>
                    <div class="view">
                    <a href="valentine.php" target="_blank" class="view-btn">View all</a>
                    </div>
                </div>
                <div class="e-card">
                    <div class="e-imgs">
                        <img src="christmas (4).jpg">
                        <img src="christmas (3).jpg">
                        <img src="christmas (2).jpg">
                        <img src="christmas (1).jpg">
                    </div>
                    <h1 class="pro-name">Christmas</h1>
                    <a href="christmas.php" target="_blank" class="view-btn">View all</a>
                </div>
                <div class="e-card">
                    <div class="e-imgs">
                        <img src="ram1 (4).jpg">
                        <img src="ram1 (3).jpg">
                        <img src="ram1 (2).jpg">
                        <img src="ram1 (1).jpg">
                    </div>
                    <h1 class="pro-name">Ramadhan</h1>
                    <a href="ramadhan.php" target="_blank" class="view-btn">View all</a>
                </div>
                <div class="e-card">
                    <div class="e-imgs">
                        <img src="cny (1).jpg">
                        <img src="cny (2).jpg">
                        <img src="cny (3).jpg">
                        <img src="cny (4).jpg">
                    </div>
                    <h1 class="pro-name">Chinese New Year</h1>
                    <a href="chinesenewyear.php" target="_blank" class="view-btn">View all</a>
                </div>
                <div class="e-card">
                    <div class="e-imgs">
                        <img src="teacher (1).jpg">
                        <img src="teacher (2).jpg">
                        <img src="teacher (3).jpg">
                        <img src="teacher (4).avif">
                    </div>
                    <h1 class="pro-name">Teacher's Day</h1>
                    <a href="teachersday.php" target="_blank" class="view-btn">View all</a>
                </div>           
            </div>
        </section>

        <section id="hamper">
                <h1 class="hamper-title">Hampers</h1>
                <div class="slider-container">
                <button class="arrow left" id="prevBtn">❮</button>
                <div class="container-c" id="slider">
                        <div class="card">
                            <a href="buy.php?id=1" target="_blank" class="cart-btn">
                                <img src="cart (2).png" class="cart">  
                            </a>
                            <span class="sale-tag">Sale</span>
                            <img src="makeup.jpg" alt="Hampers 1">
                        <div class="intro">
                            <h1>Makeup Set</h1>
                            <p class="price">Rp. 1.250.000</p>
                            <a href="checkout.php?id=1" target="_blank" class="buy-btn">Buy</a>
                        </div>
                    </div>

                    <div class="card">
                        <a href="buy.php?id=2" target="_blank" class="cart-btn">
                                <img src="cart (2).png" class="cart">
                            </a>
                            <span class="sale-tag">Sale</span>
                            <img src="chocolate.jpg" alt="Hampers 1">
                        <div class="intro">
                            <h1>Chocolate Box</h1>
                            <p class="price">Rp. 1.000.000</p>
                            <a href="checkout.php?id=2" target="_blank" class="buy-btn">Buy</a>
                        </div>
                    </div>

                    <div class="card">
                        <a href="buy.php?id=3" target="_blank" class="cart-btn">
                                <img src="cart (2).png" class="cart">
                            </a>
                            <span class="sale-tag">Sale</span>
                            <img src="weddings.jpg" alt="Hampers 1">
                        <div class="intro">
                            <h1>Wedding Souvenir</h1>
                            <p class="price">Rp. 1.500.000</p>
                            <a href="checkout.php?id=3" target="_blank" class="buy-btn">Buy</a>
                        </div>
                    </div>
                    <div class="card">
                        <a href="buy.php?id=4" target="_blank" class="cart-btn">
                                <img src="cart (2).png" class="cart">
                            </a>
                            <span class="sale-tag">Sale</span>
                            <img src="skincare.jpg" alt="Hampers 1">
                        <div class="intro">
                            <h1>Skincare Set</h1>
                            <p class="price">Rp. 1.550.000</p>
                            <a href="checkout.php?id=4" target="_blank" class="buy-btn">Buy</a>
                        </div>
                    </div>
                    <div class="card">
                        <a href="buy.php?id=5" target="_blank" class="cart-btn">
                                <img src="cart (2).png" class="cart">
                            </a>
                            <span class="sale-tag">Sale</span>
                            <img src="fruits.jpg" alt="Hampers 1">
                        <div class="intro">
                            <h1>Fruitty Box</h1>
                            <p class="price">Rp. 1.200.000</p>
                            <a href="checkout.php?id=5" target="_blank" class="buy-btn">Buy</a>
                        </div>
                    </div>          
                    <button class="arrow right" id="nextBtn">❯</button>
                </div>
            </div>
        </section>

        <section id="bouquet">
            <div class="cont-bou">
            <h1 class="bou-title">Bouquets</h1>
            <div class="bou-container">
                    <div class="bou-card">
                        <img src="azurehydrangea.jpeg">
                        <div class="intro-b">
                        <h3>Azure Hydrangea</h3>
                        <p class="new-price">Rp 355.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=1" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="sagebloom.jpeg">
                    <div class="intro-b">
                        <h3>Sage Bloom</h3>
                        <p class="new-price">Rp 220.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=2" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="goldenmarigold.jpeg">
                    <div class="intro-b">
                        <h3>Golden Marigold</h3>
                        <p class="new-price">Rp 250.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=3" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="scarletpoeny.jpeg" style="padding-left: 2rem;">
                    <div class="intro-b">
                        <h3>Scarlet Poeny</h3>
                        <p class="new-price">Rp 450.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=4" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="amberdaisy.jpeg" style="padding-left: 35px;">
                    <div class="intro-b">
                        <h3>Amber Daisy</h3>
                        <p class="new-price">Rp 375.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=5" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="blushpoeny.jpeg">
                    <div class="intro-b">
                        <h3>Blushsy Poeny</h3>
                        <p class="new-price">Rp 300.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=6" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="sun flower.jpg">
                    <div class="intro-b">
                        <h3>Premium Sun Flower</h3>
                        <p class="new-price">Rp 325.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=7" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="blue.jpg">
                    <div class="intro-b">
                        <h3 style="font-size: 27px;">Premium Flare Floral</h3>
                        <p class="new-price">Rp 280.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=8" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="bou-card">
                    <img src="red pink.jpg">
                    <div class="intro-b">
                        <h3 style>Cherry Blossom</h3>
                        <p class="new-price">Rp 370.000.00</p>
                        <div class="bou-button">
                        <a class="bou-buy" href="checkout_bou.php?id=9" target="_blank">Buy</a>
                        <a class="bou-cart" href="#keranjang" target="_blank">Add to Cart</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-dark text-light py-4">
        <div class="container px-4">
            <div class="row">
                <div class="col-6 col-lg-4">
                    <h3>About Us</h3>
                    <p>Know more about us!</p>
                    <p>0812-3456-7890</p> 
                    <p class="mb-0">Kelompok 7</p>
                </div>
                <div class="col">
                    <h4  class="pt-3 fw-bold">Menu</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light">Home</a></li>
                        <li><a href="#" class="text-decoration-none text-light">About</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Services</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Contact</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Blog</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="pt-3 fw-bold">More</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light">FAQ</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Feedback</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4  class="pt-3 fw-bold">Categories</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light">Fresh Flowers</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Gift Hampers</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Special Occasions</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Flowers Bouqet</a></li>
                </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h4  class="pt-3 fw-bold" >Social Media</h4>
                    <a href="https://www.instagram.com/" class="text-decoration-none text-light"><i class="bi bi-instagram fs-3 px-1"></i></a>
                    <a href="https://www.instagram.com/" class="text-decoration-none text-light"><i class="bi bi-facebook fs-3 px-1"></i></i></a>
                    <a href="https://www.instagram.com/" class="text-decoration-none text-light"><i class="bi bi-envelope fs-3 px-1"></i></a>
                    <a href="https://www.instagram.com/" class="text-decoration-none text-light"><i class="bi bi-telephone fs-3 px-1"></i></a>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p>2025 © Kelompok 7. All Rights Reserved.</p>
                <div>
                  <a href="#" class="text-decoration-none text-light me-4">Terms of use</a>
                  <a href="#" class="text-decoration-none text-light">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
    </body>
    <script>
        document.querySelector(".hamburger").onclick = () => {
    document.querySelector(".nav-links").classList.toggle("show");
};

        const slider = document.getElementById("slider");
        const next = document.getElementById("nextBtn");
        const prev = document.getElementById("prevBtn");

        const cardWidth = 400;
        next.addEventListener("click", () => {
            slider.scrollBy({ left: cardWidth, behavior: "smooth" });
        });
        prev.addEventListener("click", () => {
            slider.scrollBy({ left: -cardWidth, behavior: "smooth" });
        });

        document.querySelector("cart-btn").addEventListener("click", function() {
            alert("Ditambahkan ke keranjang!");
        });

    </script>
</html>