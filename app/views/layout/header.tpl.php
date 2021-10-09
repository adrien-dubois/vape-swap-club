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
    <script src="https://kit.fontawesome.com/989bb3bd5d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" ></script>
</head>

<body>
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
            <div class="menu-content">
                <a href="#" id="button" class="nav-menu"><i class="fas fa-user"></i> Login</a>
            </div>
        </aside>  
    </nav>

    <!-- LOGIN MODAL -->
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <span style="font-size: 64px; color: #2C3E50;">
                <i class="fas fa-user-circle"></i>
            </span>
            <form action="">
                <input type="text" placeholder="E-Mail">
                <input type="password" placeholder="Mot de passe">
                <a href="" class="button">Connexion</a>
            </form>
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

    <main class="main">
        Site web de Vape swap
    </main>