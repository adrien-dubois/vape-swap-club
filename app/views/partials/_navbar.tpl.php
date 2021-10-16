    <!-- NAVBAR -->
    <nav class="navigation">   
        <a href="/" class="logo-link">
            <img src="<?= $assetsBaseUri; ?>images/logo.png" alt="" class="logo-image">
        </a>
        <div class="links">
            <a href="#" class="nav-links">Accueil</a>
            <a href="#" class="nav-links">Annonces</a>
            <a href="#" class="nav-links">Catégories</a>
            <a href="#" class="nav-links">Contact</a>
        </div>
        <aside class="menu">
            <?php if(isset($_SESSION['userId'])) :  ?>
            <?php $username = $_SESSION['username'] ?>
            <div class="menu-logout">
                <a href=" <?= $router->generate('main-logout') ?> " class="nav-menu"><i class="fas fa-user"></i> <?= $username ?> </a>
            </div>
            <?php else : ?>
            <div class="menu-content">
                <a href="#" id="button" class="nav-menu"><i class="fas fa-user"></i> Login</a>
            </div>
            <?php endif; ?>
        </aside>  
    </nav>