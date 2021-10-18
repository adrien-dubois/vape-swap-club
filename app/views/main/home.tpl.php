<!-- MAIN PART -->
<main class="main">

    <!-- HERO SECTION -->
    <div class="banner">
        <div class="hero">
            <div class="banner-content">
                <span>Be part of the club</span>
                <h1>Rare mods</h1>

                <p>Velit est ea laboris est duis ipsum.Sunt minim cupidatat magna irure esse qui mollit mollit sint dolore anim.Reprehenderit labore proident cillum ut exercitation dolore eu aute sint elit.</p>

                <?php if(!isset($_SESSION['userId'])): ?>
                <a href="#" class="btn-one" id="btn-one">Se connecter</a>
                <a href="#" class="btn-two">S'inscrire</a>
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
                <div class="card">
                    <div class="imgBx">
                        <img src="<?= $assetsBaseUri; ?>uploads/bolt.jpg">
                    </div>
                    <div class="content">
                        <h2>Bolt Mod</h2>
                    <p>Lorem commodo dolore aute dolor eiusmod veniam deserunt cillum nulla esse consequat occaecat.</p>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </div>
            <div class="card">
                <div class="imgBx">
                    <img src="<?= $assetsBaseUri; ?>uploads/cobra-slam.jpg">
                </div>
                <div class="content">
                    <h2>Cobra Slam Piece</h2>
                    <p>Lorem commodo dolore aute dolor eiusmod veniam deserunt cillum nulla esse consequat occaecat.</p>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </div>
            <div class="card">
                <div class="imgBx">
                    <img src="<?= $assetsBaseUri; ?>uploads/reckoning.jpg">
                </div>
                <div class="content">
                    <h2>Reckoning RDA</h2>
                    <p>Lorem commodo dolore aute dolor eiusmod veniam deserunt cillum nulla esse consequat occaecat.</p>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </div>
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
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig">C2MNT RDA</p>
                    <!--model-->
                    <img src="<?= $assetsBaseUri; ?>uploads/d5.png" class="model">
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p>Commodo est anim qui aliqua est Lorem pariatur voluptate excepteur.</p>
                    </div>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </li>
        <!--2------------------------->
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig">Battle Deck CompLyfe</p>
                    <!--model-->
                    <img src="<?= $assetsBaseUri; ?>uploads/cl.png" class="model">
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p>Commodo est anim qui aliqua est Lorem pariatur voluptate excepteur.</p>
                    </div>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </li>
        <!--3------------------------->
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig">Goon 25 RDA</p>
                    <!--model-->
                    <img src="<?= $assetsBaseUri; ?>uploads/go.png" class="model">
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p>Commodo est anim qui aliqua est Lorem pariatur voluptate excepteur.</p>
                    </div>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </li>
        <!--4------------------------->
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig">Gold Hadaly RDA</p>
                    <!--model-->
                    <img src="<?= $assetsBaseUri; ?>uploads/had.png" class="model">
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p>Commodo est anim qui aliqua est Lorem pariatur voluptate excepteur.</p>
                    </div>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </li>
        <!--5------------------------->
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig">Origen V2 MK-II</p>
                    <!--model-->
                    <img src="<?= $assetsBaseUri; ?>uploads/origen.png" class="model">
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p>Commodo est anim qui aliqua est Lorem pariatur voluptate excepteur.</p>
                    </div>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </li>
        <!--6------------------------->
            <li class="item-a">
                 <!--slider-box-->
                <div class="box">
                    <p class="cig">Spade 21700</p>
                    <!--model-->
                    <img src="<?= $assetsBaseUri; ?>uploads/spade.png" class="model">
                    <!--details-->
                    <div class="details">
                        <!--product-details-->
                        <p>Commodo est anim qui aliqua est Lorem pariatur voluptate excepteur.</p>
                    </div>
                    <a href="#" class="btn-cards">Détails</a>
                </div>
            </li>
        </ul>
       
    </div>


</main>