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
        <div class="category-btns">
            <button type="button" id="dripper" class="cat-btn active-btn">Dripper</button>
            <button type="button" id="atos" class="cat-btn">Atomiseurs</button>
            <button type="button" id="mech" class="cat-btn">Mod mech</button>
            <button type="button" id="bf" class="cat-btn">Bottom Feeder</button>
        </div>
    </div>

        <div class="row">
            <?php foreach($products as $currentProduct) : 
                // Stock category ID in var to add category's class for btns
                $category = $currentProduct -> getCategory_id();
            ?>

                <!-- ADDING RIGHT CATEGORIES IN DIV'S CLASS TO ORDER BY CATS -->
                <div class="column-4 <?= ($category == 1 || $category == 2) ? 'dripper' : 
                (($category ==  4 || $category == 3 || $category == 7) ? 'atos' : 
                (($category == 6 || $category == 9 || $category == 10) ? 'mech'
                :
                (($category == 5) ? 'bf'
                : ''))) 
                ?>">
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

    
