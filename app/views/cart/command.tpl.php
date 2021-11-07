<div class="container">
    <div class="row ">
        
            <!-- CART PART -->
            <div class="column-20">
                <div class="titling">
                            <h3 style="top: -70px;">Récapitulatif commande</h3 >
                </div>
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
                                <div>
                                    <p><?= $product->getName() ?></p>
                                    <br>
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
                            <td><?= $totalTva ?>€</td>
                        </tr>
                    </table>
                        
                </div>
            
            </div>

            <!-- ADRESS PART -->

            <?php if(empty($findAdress)): ?>

            <div class="column-20 a-form" style="margin-left: 20px;">
                <div class="cont">
                    <div class="titling">
                        <h3 >Adresse de livraison</h3 >
                    </div>
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
    
                    <!-- FORM -->
                    <form action="" method="POST" autocomplete="off">
    
                        <div class="user-details">

                            <!-- NAME -->
                            <div class="input-box">
                                <span class="detail">Nom complet</span>
                                <input name="name" type="text" placeholder="Entrez nom / prénom" value="<?= $adress->getName(); ?>" required>
                            </div>

                            <!-- PHONE -->
                            <div class="input-box">
                                <span class="detail">Tél. <i>(facultatif)</i> </span>
                                <input name="phone" type="tel" placeholder="Entrez votre numéro" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?= $adress->getPhone(); ?>" >
                            </div>

                            <!-- STREET NUMBER -->
                            <div class="input-box">
                                <span class="detail">Numéro de rue</span>
                                <input id="street" type="number" name="number" value="<?= $adress->getNumber(); ?>" required>
                            </div>

                            <!-- ADRESS -->
                            <div class="input-box">
                                <span class="detail">Adresse</span>
                                <textarea type="text" name="adress" value="<?= $adress->getAdress(); ?>" required> </textarea>
                            </div>

                            <!-- ZIP -->
                            <div class="input-box">
                                <span class="detail">Code Postal</span>
                                <input id="zip" type="number" name="zip" value="<?= $adress->getZip(); ?>" required>
                            </div>

                            <!-- CITY -->
                            <div class="input-box">
                                <span class="detail">Ville</span>
                                <input type="text" name="city" placeholder="Entrez votre ville" value="<?= $adress->getCity(); ?>" required>
                            </div>

                            <!-- MESSAGE -->
                            <div class="input-box">
                                <span class="detail">Message <i>(facultatif)</i> </span>
                                <textarea type="text" name="message" value="<?= $adress->getMessage(); ?>" > </textarea>
                            </div>
                        </div>

                        <!-- TOTAL PRICE -->
                        <input value="<?= $totalTva ?>" type="hidden" name="price" id="price">
    
                        <!-- SUBMIT -->
                        <div class="btn-adress">
                            <input class="btn-register" type="submit" value="Commander">
                        </div>
                    </form>
                </div>
            </div>


            <?php else: ?>

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
                            <p><?= $findAdress->getName() ?></p>
                            <p><?= $findAdress->getNumber() . ' '. $findAdress->getAdress() ?></p>
                            <p><?= $findAdress->getZip() . ' ' . $findAdress->getCity() ?></p>
                            <?php if(!empty($findAdress->getPhone())) : ?>
                            <p>Téléphone : <?= $findAdress->getPhone() ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <p>Vous avez déjà utilisé cette adresse de livraison, souhaitez vous la conserver?</p>
                <div class="choose">
                    <form action="" method="post">
                        <input value="no" type="hidden" name="confirm">
                        <button class="btn-delete" style="top: 10px;">Nouvelle adresse</button>
                    </form>
                    <form action="" method="post">
                        <input value="yes" type="hidden" name="confirm">
                        <button class="btn-primary" style="top: 10px;">Utiliser</button>
                    </form>
                </div>
               
            </div>

            <?php endif; ?>
        
    </div>
</div>