<!-- MAIN PART -->
<!-- <main class="main"> -->

    <!-- HERO SECTION -->
    <div class="banner">
        <div class="hero">
            <div class="banner-content">
                <span>Be part of the club</span>
                <h1>Rare mods</h1>

                <p>Bienvenue au Vape Swap Club. Nous sommes des passionnés de beau matériel, rare, qui construit des setups uniques. Mais au vu de la difficulté à trouver certaines pièces, nous avons décidé d'ouvrir le club afin que les aficionados souhaitant faire tourner leur belles pièces puissent en faire profiter d'autres passionnés...</p>

                <?php if(!isset($_SESSION['userId'])): ?>
                <a href="#" class="btn-one" id="btn-one">Se connecter</a>
                <a href="<?= $this->router->generate('main-register'); ?>" class="btn-two">S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </div>


    
    <!-- PICTO BAR -->
    <div class="picto">
        <ul>
            <li>
                <a href="">
                    <div class="icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div class="name">Originaux certifiés</div>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="icon">
                    <i class="far fa-star"></i>
                </div>
                <div class="name">Utilisateurs notés</div>
            </a>
        </li>
        <li>
            <a href="">
                <div class="icon">
                    <i class="far fa-handshake"></i>
                </div>
                <div class="name">Confiance</div>
            </a>
        </li>
        <li>
                <a href="">
                    <div class="icon">
                        <i class="fab fa-paypal"></i>
                    </div>
                    <div class="name">Paiement PayPal</div>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="icon">
                        <i class="far fa-comments"></i>
                    </div>
                    <div class="name">Messagerie Privée</div>
                </a>
            </li>
        </ul>
    </div> 
 
    <!-- CARDS PART -->
    <div class="card-section">    
        <h2 id="title">Brand news</h2>
        <p id="subtitle">Découvrez les dernières rentrées</p>
        <div class="body-card">
            <div class="contain">

            <?php foreach($newsCards as $currentCards): ?>
                <div class="card">
                    <div class="imgBx">
                        <img src="<?= $uploadsUri . $currentCards->getPicture() ?>">
                        <?php if($currentCards->getStatus() == 2) : ?>
                            <img src="<?= $assetsBaseUri ?>images/out.png" style="position: absolute; bottom: 0px; right: 0px;">
                        <?php endif; ?>
                    </div>
                    <div class="content">
                        <h2><?= $currentCards->getName() ?></h2>
                        <p><?= $currentCards->getSubtitle() ?></p>
                        <a href="<?= $this->router->generate('product-single',['productId'=>$currentCards->getId()]) ?>" class="btn-cards">Détails</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>  
</div>

<hr style="height: 2px;border: none;background-color: #5A5D62; color: #5A5D62; margin-bottom: 2rem; ">
<h2 id="trend">Tendances</h2>
<!-- CAROUSEL PART -->
    <div class="carousel">
        <!-- slider ------------------>
        <ul id="autoWidth" class="cs-hidden">
        <!--1------------------------->
        <?php foreach($carousel as $currentCarousel): ?>
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig"><?= $currentCarousel->getName() ?></p>
                    <!--image-->
                    <img src="<?= $uploadsUri . $currentCarousel->getpicture() ?>" class="model">
                    <?php if($currentCarousel->getStatus() == 2) : ?>
                            <img src="<?= $assetsBaseUri ?>images/out.png" width="320px" style="position: absolute; top: 20%; right: 3%;">
                        <?php endif; ?>
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p><?= $currentCarousel->getSubtitle() ?></p>
                    </div>
                    <a href="<?= $this->router->generate('product-single',['productId'=>$currentCarousel->getId()]) ?>" class="btn-cards">Détails</a>
                </div>
            </li>
        <?php endforeach ?>
        </ul>
       
    </div>


<!-- </main> -->

<script>
    document.getElementById('btn-one').addEventListener('click', function(){
    document.querySelector('.bg-modal').style.display = 'flex';
    });

    document.querySelector('.close').addEventListener('click', function(){
        document.querySelector('.bg-modal').style.display = 'none';
    });
</script>