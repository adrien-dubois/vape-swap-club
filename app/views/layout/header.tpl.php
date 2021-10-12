<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $viewData['pageTitle'] ?> - Ecommerce</title>
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Roboto:ital,wght@0,900;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/989bb3bd5d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" ></script>
</head>

<body>
    <!-- NAVBAR -->
<header>
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
            <div class="menu-content">
                <a href="#" id="button" class="nav-menu"><i class="fas fa-user"></i> Login</a>
            </div>
        </aside>  
    </nav>

    <!-- LOGIN MODAL -->
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <span style="font-size: 64px; color: #FC833C;">
                <i class="fas fa-user-circle"></i>
            </span>

            <div class="l-form">
                <form action="" class="form">
                    <h1 class="form__title">Connexion</h1>

                    <div class="form__div">
                        <input type="text" placeholder=" " class="form__input">
                        <label for="" class="form__label">Email</label>
                    </div>

                    <div class="form__div">
                        <input type="password" placeholder=" " class="form__input">
                        <label for="" class="form__label">Mot de passe</label>
                    </div>

                    <input type="submit" class="form__button" value="Connexion">
                    
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT FOR THE MODAL -->
    <script type="text/javascript">
        document.getElementById('button').addEventListener('click', function(){
            document.querySelector('.bg-modal').style.display = 'flex';
        });
        
        document.querySelector('.close').addEventListener('click', function(){
            document.querySelector('.bg-modal').style.display = 'none';
        });
    </script>

</header>

<!-- MAIN PART -->
<main class="main">

    <!-- HERO SECTION -->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <span>Be part of the club</span>
                <h1>Rare mods</h1>

                <p>Velit est ea laboris est duis ipsum.Sunt minim cupidatat magna irure esse qui mollit mollit sint dolore anim.Reprehenderit labore proident cillum ut exercitation dolore eu aute sint elit.</p>

                <a href="#" class="btn-one" id="btn-one">Se connecter</a>
                <a href="#" class="btn-two">S'inscrire</a>
            </div>
        </div>
    </div>

            <!-- SCRIPT FOR THE MODAL -->
            <script type="text/javascript">
            document.getElementById('btn-one').addEventListener('click', function(){
                document.querySelector('.bg-modal').style.display = 'flex';
            });
            
            document.querySelector('.close').addEventListener('click', function(){
                document.querySelector('.bg-modal').style.display = 'none';
            });
        </script>
    
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
        <h2 id="title">Last trending</h2>
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
</main>
    
<!-- FOOTER -->
<footer class="footer-distributed">
    <div class="footer-left">
        <img src="<?= $assetsBaseUri; ?>images/logo-simple.png" alt="logo" style="width: 120px; margin-left: 55px;">
        <h3>Vape <span>Swap Club</span> </h3>
        <p class="footer-links">
            <a href="#">Accueil</a>
            <a href="#">Annonces</a>
            <a href="#">Catégories</a>
            <a href="#">Contact</a>
        </p>
        <p class="footer-comp-name">&copy;2021 Adrien Dubois Dev</p>
    </div>
    
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Vape Swap Club</span>Vape World, France</p>
        </div>
        <div>
            <i class="fa fa-phone"></i>
                <p>+33 240 506 070</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto: dubois.adrien.dev@gmail.com">Webmaster Contact</a></p>
            </div>
        </div>
        
        <div class="footer-right">
            <p class="footer-comp-about">
                <span>Réseaux Sociaux</span>
                Officia aute est ipsum duis laborum occaecat ut incididunt dolore. Aliquip culpa minim reprehenderit do. Laborum Lorem est exercitation elit do ut incididunt adipisicing consequat nulla sit adipisicing. Laboris do velit laboris qui exercitation aute et ad. Incididunt nostrud cillum quis non et incididunt cupidatat eu cupidatat pariatur voluptate.
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
            </div>
        </div>
            
    </footer>