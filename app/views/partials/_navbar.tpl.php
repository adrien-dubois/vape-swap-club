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
            <?php 
            $username = $_SESSION['username']; 
            $role = $_SESSION['userObject']->getRole();
            ?>
            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="<?= $assetsBaseUri; ?>uploads/id.jpg" alt="">
                </div>
                <div class="menu-dropdown">
                    <h3><?= $username; ?> <br><span><?= $role; ?></span></h3>
                    <ul>
                        <li><a href="#"><i class="fas fa-shopping-cart"></i>Mon Panier</a></li>
                        <li><a href="#"><i class="far fa-user-circle"></i>Mon Profil</a></li>
                        <li><a href="#"><i class="far fa-edit"></i>Éditer Profil</a></li>
                        <li><a href="#"><i class="far fa-envelope"></i>Messagerie</a></li>
                        <li><a href="<?= $router->generate('main-logout') ?>"><i class="fas fa-sign-out-alt"></i>Se déconnecter</a></li>
                    </ul>
                </div>
            </div>
            <script>
                function menuToggle(){
                    const toggleMenu = document.querySelector('.menu-dropdown');
                    toggleMenu.classList.toggle('active')
                }
            </script>
            <?php else : ?>
            <div class="menu-content">
                <a href="#" id="button" class="nav-menu"><i class="fas fa-user"></i> Login</a>
            </div>
            <?php endif; ?>
        </aside>  
    </nav>