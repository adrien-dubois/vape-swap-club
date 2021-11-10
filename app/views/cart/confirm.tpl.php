<div class="container">
    <div class="row ">

        <!-- CART PART -->
        <div class="column-20 cart-page">
            <div class="titling">
                <h3 style="top: -70px;">Récapitulatif complet</h3>
            </div>
            <div class="heading">
                <h3 style="margin-left: -19rem;">Commande N° <?= $order->getId() ?></h3>
            </div>
            <table>
                <!-- CART TITLES -->
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Sous-Total</th>
                </tr>

                <!-- CART PRODUCTS -->
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td>
                            <div class="cart-info">
                                <div>
                                    <p><?= $product->getName() ?></p>
                                    <br>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p style="margin-left: 25px;">1</p>
                        </td>
                        <td><?= $product->getPrice() ?>€</td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- CART PRICES -->
            <div class="total-price">
                <table>
                    <tr>
                        <td>Total TTC</td>
                        <td><?= $order->getPrice() ?>€</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- ADRESS PART -->

        <div class="column-20" style="margin-left: 20px;">

            <div class="containeur">
                <div class="card-member">
                    <div class="left-column background1-left-column">
                        <h6>Carte de membre</h6>
                        <h2>Vape Swap Club</h2>
                        <img src="<?= $assetsBaseUri; ?>images/logo.png" width="120px">
                    </div>

                    <div class="right-column">
                        <div>
                            <h4>Membre n°<?= $_SESSION['userId'] ?></h4>
                            <h6><?= $_SESSION['username'] ?></h6>
                        </div>

                        <h2>Adresse de livraison</h2>
                        <p><?= $adress->getName() ?></p>
                        <p><?= $adress->getNumber() . ' '. $adress->getAdress() ?></p>
                        <p><?= $adress->getZip() . ' ' . $adress->getCity() ?></p>
                        <?php if(!empty($adress->getPhone())) : ?>
                        <p>Téléphone : <?= $adress->getPhone() ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($order->getStatus() == 1 ) : ?>
            <div class="choose">
                <a href="<?= $this->router->generate('adress-edit',['adressId' => $adress->getId()]) ?>"><button class="btn-modify">Modifier l'adresse</button></a>
    
                <form action="/cart/pay" method="post">
                    <input value="<?= $order->getPrice() ?>" type="hidden" name="price" id="price">
                    <button class="btn-register" style="top: 10px; margin-right: inherit;">Payer</button>
                </form>
            </div>
            <?php else : ?>
                <h3 style="color: #FC833C; text-transform: uppercase; ">Commande payée</h3>
            <?php endif; ?>
        </div>
    </div>
</div>