<?php use App\Models\Brand; ?>
<!-- LITTLE HERO SECTION -->
    <div class="header">
        <div class="container">
            <div class="row row-2">
                <div class="column-2">
                    <span>Last hotest news</span>
                    <h1>Annonces</h1>
                    <p>Voici toutes nos annonces de produits High-End vérifiés, que ce soit du RTA MTL au Dripper pour Cloud Chasers, en passant par des mods mécas custom ou aux boxs BF faites à la mano en bois stab. <br> Tout le monde peut y trouver chaussure à son pied ou même changer de style, qu'importe tant que c'est votre vape et que c'est du lourd !!! 
                    <br>
                    N'oubliez pas la messagerie privé, qui vous permets de rentrer en contact avec les vendeurs en cas de questions subsidiaires. </p>
                    <a href="#prod-section" class="btn-primary">Explorer &#8594; </a>
                </div>
                <div class="column-2">
                    <img src="<?= $assetsBaseUri; ?>images/col.png">
                </div>
            </div>
        </div>
    </div>
    
    <!-- PRODUCTS -->

    <div class="container" id="prod-section">
        <div class="row">
            <h2 class="list-title">Nos produits disponibles</h2>
        </div>
        <div class="row">
            <?php foreach($products as $currentProduct) : ?>
                <div class="column-4">
                    <img src="<?= $uploadsUri . $currentProduct->getPicture() ?>">
                    <?php if($currentProduct->getStatus() == 2): ?>
                        <img src="<?= $assetsBaseUri ?>images/out.png" style="position: absolute; top: 0px; right: 0px;">
                    <?php endif; ?>
                    <p class="sub"><?= $currentProduct->getSubtitle() ?></p>
                    <h4><?= $currentProduct->getName() ?></h4>
                    <?php $brandId = $currentProduct->getBrandId();
                    $brandModel = new Brand();
                    $currentBrand = $brandModel->find($brandId);
                    $brandName = $currentBrand->getName();
                    ?>
                    <p class="brand"><?= $brandName ?></p>
                    <?php $rating = $currentProduct->getRate(); 
                     include __DIR__ . '/../partials/_rating.tpl.php'; ?>
                    <p><?= $currentProduct->getPrice(); ?> €</p>
                    <a href="<?= $this->router->generate('product-single', ['productId'=> $currentProduct->getId()]) ?>" class="btn-secondary">VOIR</a>
                </div>
            <?php endforeach ?>
        </div>


        <!-- PAGINATION -->
        <div class="page-btn">
            <?php for ($page = 1; $page <= $nbPages; $page++): ?>
                <a href="/products?page=<?= $page ?>" class=" "><span><?= $page ?></span></a>
            <?php endfor ?>
            <a href="/products?page=<?= $thisPage + 1 ?>" class=" <?= ($thisPage == $nbPages) ? 'disabled' : '' ?> "><span>&#8594;</span></a>
        </div>

    </div>
