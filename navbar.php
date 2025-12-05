        <header>
        <nav>
            <div class="nav-container">
                <img src="Logo3.png" alt="Logo" class="logo">
                    <ul class="nav-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#hamper">Hampers</a></li>
                        <li><a href="#bouquet">Bouquets</a></li>
                        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true){ ?>
                        <li><a href="admin.php">Admin</a></li>
                        <?php } ?>
                    </ul>
                    <a href="login.php" class="profil">
                        <h3>Login</h3>
                        <img src="profile.png">
                        
                    </a>
                    <div class="hamburger">
                        ☰
                    </div>
            </div>
        </nav>
    </header>