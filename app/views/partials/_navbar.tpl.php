    <!-- NAVBAR -->
    <nav class="navigation">   
        <a href="/" class="logo-link">
            <img src="<?= $assetsBaseUri; ?>images/logo.png" alt="" class="logo-image">
        </a>

        <!-- LINKS NAVIGATION -->
        <div class="links">
            <a href="<?= $this->router->generate('main-home'); ?>" class="nav-links <?= ($currentPage === 'main/home') ? 'act' : '' ?>">Accueil</a>
            <a href="<?= $this->router->generate('product-list') ?>" class="nav-links <?= ($currentPage === 'product/list' || $currentPage === 'product/single') ? 'act' : '' ?>">Annonces</a>
            <a href="#" class="nav-links">Catégories</a>
            <a href="#" class="nav-links">Contact</a>
        </div>

        <!-- PERSONNAL MENU -->
        <aside class="menu">
            
            <!-- If user is connected -->
            <?php if(isset($_SESSION['userId'])) : 
            $currentUser = $_SESSION['userObject'];
            $username = $_SESSION['username']; 
            ?>
            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="<?= $uploadsUri . $currentUser->getPicture() ?>" alt="">
                </div>
                <div class="menu-dropdown">
                    <h3><?= $username; ?> <br><span><?= $currentUser->getRole(); ?></span></h3>
                    <ul>
                        <li>
                            <a href="<?= $this->router->generate('cart-home'); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                Mon Panier <span class="cart-number"> <?= array_sum($_SESSION['cart']) ?> </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="far fa-user-circle"></i>
                                Mon Profil
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->router->generate('product-add') ?>">
                                <i class="far fa-edit"></i>
                                Vendre du matos
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="far fa-envelope"></i>
                                Messagerie
                            </a>
                        </li>
                        <li>
                            <a href="<?= $router->generate('main-logout') ?>">
                                <i class="fas fa-sign-out-alt"></i>
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- If user is a visitor not connected -->
            <?php else : ?>
            <div class="menu-content">
                <a href="#" id="button" class="nav-menu"><i class="fas fa-user"></i> Login</a>
            </div>
            <?php endif; ?>
        </aside>  
    </nav>
