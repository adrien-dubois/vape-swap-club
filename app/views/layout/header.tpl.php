<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $viewData['pageTitle'] ?> - Vape Swap Club</title>
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/style.css">
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/product.css">
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/appuser.css">
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/backoffice.css">
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/responsive.css">
    <link rel="stylesheet" href="<?= $assetsBaseUri; ?>css/lightslider.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Roboto:ital,wght@0,900;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?= $assetsBaseUri; ?>js/stripe.js" defer></script>
    <script src="<?= $assetsBaseUri; ?>js/lightslider.js" defer></script>
    <script src="https://kit.fontawesome.com/989bb3bd5d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>

<body>
    <?php 
    require __DIR__ . '/../partials/_navbar.tpl.php'; 
    require __DIR__ . '/../partials/_login-modal.tpl.php';
    require __DIR__ . '/../partials/_flash.tpl.php';
    ?>