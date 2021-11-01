<div class="small-container cart-page">
    <table>
        <!-- CART TITLES -->
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Sous-Total</th>
        </tr>
        

        <!-- CART PRODUCTS -->

        <!-- IF ARTICLES IN -->

        <?php 
        if(!empty($_SESSION['cart'])) :
        foreach ($cart as $product): ?>
        <tr>
            <td>
                <div class="cart-info">
                   <a href="<?= $this->router->generate('product-single', ['productId'=> $product->getId()]) ?>"> <img src="<?= $uploadsUri . $product->getPicture() ?>"></a>
                    <div>
                        <p><?= $product->getName() ?></p>
                        <small>Prix: <?= $product->getPrice() ?>€</small>
                        <br>
                        <a href="<?= $this->router->generate('cart-remove', ['productId'=>$product->getId()]) ?>"><i class="fas fa-trash-alt"></i> Suppr. </a>
                    </div>
                </div>
            </td>
            <td><p style="margin-left: 25px;"><?= $_SESSION['cart'][$product->getId()] ?></p></td>
            <td><?= $product->getPrice() * $_SESSION['cart'][$product->getId()]  ?>€</td>
        </tr>
        <?php endforeach;
        else :
        ?>

        <!-- IF EMPTY -->

            <tr>
                <td>Votre panier est vide</td>
                <td></td>
                <td></td>
            </tr>
        <?php endif; ?>
    </table>



    <!-- CART PRICES -->

    <div class="total-price">
        <table>
            <tr>
                <td>Sous-Total</td>
                <td><?= $total ?>€</td>
            </tr>
            <tr>
                <td>TVA</td>
                <td>19,6%</td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?= $totalTva = number_format($total * 1.196,2,',',' ') ?>€</td>
            </tr>
        </table>
            
    </div>
    <div>
        <!-- <form action="/cart/pay" method="post">
            <input value="<?= $totalTva ?>" type="hidden" name="price" id="price">
            <button class="btn-primary" style="float: right;">Paiement</button>
        </form> -->
        <form action="/cart/command" method="get">
            <button class="btn-primary" style="float: right;">Paiement</button>
        </form>
        <form action="/cart/del" method="get">
            <button class="btn-delete" style="float: right;">Annuler la commande</button>
        </form>
    </div>



</div>