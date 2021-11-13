<?php 
$available = $product->getStatus();
$rating = $product->getRate();
?>
<div class="small-container single-product">
    <div class="row row-2">
        <div class="column-2">
            <img src="<?= $uploadsUri . $product->getPicture() ?>" id="ProductImg">

            <div class="small-img-row">

                <!-- MAIN PICTURE -->
                <div class="small-img-col">
                    <img src="<?= $uploadsUri . $product->getPicture() ?>" width="100%" class="small-img">
                </div>

                <!-- ALL CAROUSEL PICTURES -->
                <?php foreach($carousel as $currentCarousel): ?>
                <div class="small-img-col">
                    <img src="<?= $uploadsUri . $currentCarousel->getName() ?>" width="100%" class="small-img">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="column-2">
            <p><a href="<?= $this->router->generate('product-list') ?>" class="breadcrumb">Annonces</a>  / <?= $category->getName() ?></p>
            <h1><?= $product->getName() ?></h1>
            <p class="italic"><?= $brand->getName() ?></p>
            <?php include_once __DIR__ . '/../partials/_rating.tpl.php';
            ?>
            <h4><?= $product->getPrice() ?> €</h4>
            <h3>Description :</h3>
            <br>
            <p class="description"><?= $product->getDescription() ?></p>
            <br>
            <?php if($available == 1): ?>
                <a href="<?= $this->router->generate('cart-add', ['productId' => $product->getId()]) ?>" class="btn-secondary">AJOUTER <i class="fas fa-shopping-cart"></i></a>
            <?php elseif($available ==2): ?>
                <a class="btn-disable">PLUS DISPO <i class="fas fa-exclamation-triangle"></i></a>
            <?php endif; ?>
            <div class="badges">
                <ul>
                    <?php if($available == 1){ ?>
                    <li><i class="fas fa-check-circle"></i> Disponibilité:<span> En stock</span></li>
                    <?php } else { ?>
                    <li><i class="far fa-times-circle"></i> Disponibilité:<span>  Out of stock</span></li> <?php } ?>
                    <li><i class="fas fa-check-circle"></i> Catégorie:<span> <?= $category->getName() ?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    var ProductImg = document.getElementById("ProductImg");
    var SmallImg = document.getElementsByClassName("small-img");

    SmallImg[0].onclick = function(){
        ProductImg.src = SmallImg[0].src;
    }
    SmallImg[1].onclick = function(){
        ProductImg.src = SmallImg[1].src;
    }
    SmallImg[2].onclick = function(){
        ProductImg.src = SmallImg[2].src;
    }
    SmallImg[3].onclick = function(){
        ProductImg.src = SmallImg[3].src;
    }

</script>