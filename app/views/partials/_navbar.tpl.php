    <!-- NAVBAR -->
    <nav class="navigation">   
        <a href="/" class="logo-link">
            <img src="<?= $assetsBaseUri; ?>images/logo.png" alt="" class="logo-image">
        </a>

        <!-- LINKS NAVIGATION -->
        <div class="links">

            <a href="<?= $this->router->generate('main-home'); ?>" class="nav-links <?= ($currentPage === 'main/home') ? 'act' : '' ?>">Accueil</a>

            <a href="<?= $this->router->generate('product-list') ?>" class="nav-links <?= ($currentPage === 'product/list' || $currentPage === 'product/single') ? 'act' : '' ?>">Annonces</a>

            <a href="<?= $this->router->generate('user-vendor') ?>" class="nav-links <?= ($currentUser === 'user/vendor') ? 'act' : '' ?>">Vendeur</a>

            <a href="<?= $this->router->generate('main-contact') ?>" class="nav-links <?= ($currentPage === 'main/contact') ? 'act' : '' ?>">Contact</a>
        </div>

        <!-- PERSONNAL MENU -->
        <aside class="menu">
            
            <!-- If user is connected -->
            <?php 
            use App\Models\Message;
            
            if(isset($_SESSION['userId'])) : 
            $currentUser = $_SESSION['userObject'];
            $username = $_SESSION['username'];
            $role =  $currentUser->getRole();
            $countMsg = Message::countNotif();

            ?>
            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="<?= $uploadsUri . $currentUser->getPicture() ?>" alt="">
                </div>
                <!-- NOTIFICATION -->
                <?php if($countMsg > 0): ?>
                <div class="notif-msg">
                    <span>
                        <?= $countMsg ?>
                    </span>
                </div>
                <?php endif; ?>

                <!-- MENU & USERS METAS -->
                <div class="menu-dropdown">
                    <h3><?= $username; ?> <br><span><?= $role; ?></span></h3>
                    <ul>

                        <!-- CART -->
                        <li>
                            <a href="<?= $this->router->generate('cart-home'); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                Mon Panier 
                                <span class="cart-number"> 
                                    <?php if(isset($_SESSION['cart'])){
                                        echo array_sum($_SESSION['cart']);
                                    }?> 
                                </span>
                            </a>
                        </li>

                        <!-- USER PROFILE -->
                        <li>
                            <a href="<?= $this->router->generate('user-show') ?>">
                                <i class="far fa-user-circle"></i>
                                Mon Profil
                            </a>
                        </li>

                        <!-- ADD A PRODUCT -->
                        <?php if($role == 'Admin' || $role == 'Vendor'): ?>
                        
                        <li>
                            <a href="<?= $this->router->generate('product-add') ?>">
                                <i class="far fa-edit"></i>
                                Vendre du matos
                            </a>
                        </li>
                        <?php endif; ?>

                        <!-- MESSENGER -->
                        <li>
                            <a href="<?= $this->router->generate('msg-home') ?>">
                                <i class="far fa-envelope"></i>
                                Messagerie <?php if($countMsg > 0){
                                    echo $countMsg;
                                } ?>
                            </a>
                        </li>

                        <!-- BACKOFFICE -->
                        <?php if($role == 'Admin'): ?>
                        <li>
                            <a href="#">
                                <i class="fas fa-laptop-code"></i>
                                Backoffice
                            </a>
                        </li>
                        <?php endif; ?>

                        <!-- LOGOUT -->
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
