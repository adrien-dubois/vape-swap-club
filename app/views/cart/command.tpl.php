<div class="container">
    <div class="row ">
        
            <!-- CART PART -->
            <div class="column-20 cart-page">
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

            <div class="column-20 a-form" style="margin-left: 20px;">
                <div class="cont">
                    <div class="titling">
                        <h3 >Adresse de livraison</h3 >
                    </div>
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
    
                    <!-- FORM -->
                    <form action="" method="POST" autocomplete="off">
    
                        <div class="user-details">
                            <div class="input-box">
                                <span class="detail">Nom complet</span>
                                <input name="name" type="text" placeholder="Entrez nom / prénom" required>
                            </div>
                            <div class="input-box">
                                <span class="detail">Tél. <i>(facultatif)</i> </span>
                                <input name="phone" type="tel" placeholder="Entrez votre numéro" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" >
                            </div>
                            <div class="input-box">
                                <span class="detail">Numéro de rue</span>
                                <input id="street" type="number" name="number" required>
                            </div>
                            <div class="input-box">
                                <span class="detail">Adresse</span>
                                <textarea type="text" name="adress" required> </textarea>
                            </div>
                            <div class="input-box">
                                <span class="detail">Code Postal</span>
                                <input id="zip" type="number" name="zip" required>
                            </div>
                            <div class="input-box">
                                <span class="detail">Ville</span>
                                <input type="text" name="city" placeholder="Entrez votre ville" required>
                            </div>
                            <div class="input-box">
                                <span class="detail">Message complémentaire</span>
                                <textarea type="text" name="message" > </textarea>
                            </div>
                        </div>
    
                        <div class="btn-adress">
                            <input class="btn-register" type="submit" value="Commander">
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>