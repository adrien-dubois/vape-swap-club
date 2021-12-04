<div class="glob">

<?php require __DIR__ . '/../partials/_sidebar.tpl.php'; ?>

    <div class="bo-content">
        <div class="bo-title">
            <h3>Accueil</h3>
        </div>
        <main>
            <div class="bo-cards">

                <!-- CARD -->
                <div class="card-single">
                    <div>
                        <h2>50</h2>
                        <small>Utilisateurs</small>
                    </div>
                    <div>
                        <span class="fa fa-user-o"></span>
                    </div>
                </div>

                <!-- CARD -->
                <div class="card-single">
                    <div>
                        <h2>50</h2>
                        <small>Ventes</small>
                    </div>
                    <div>
                        <span class="fas fa-money-bill-wave"></span>
                    </div>
                </div>

                <!-- CARD -->
                <div class="card-single">
                    <div>
                        <h2>50</h2>
                        <small>Articles</small>
                    </div>
                    <div>
                        <span class="fas fa-shopping-cart"></span>
                    </div>
                </div>

                <!-- CARD -->
                <div class="card-single">
                    <div>
                        <h2>50</h2>
                        <small>Catégories</small>
                    </div>
                    <div>
                        <span class="fas fa-tags"></span>
                    </div>
                </div>

            </div>
    
            <div class="composant">
                <div class="ventes">
                    <div class="case">
                        <div class="header-case">
                            <h2>Derniers articles</h2>
                            <button class="bo-button">Voir plus<span class="fa fa-arrow-right"></span></button>
                        </div>
                        <div class="body-case">
                            <div class="tableau">
                                <table width="100%" >
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Nom</td>
                                            <td>Prix</td>
                                            <td>Vendeur</td>
                                            <td>Date ajout</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- PRODUCT -->
                                        <tr>
                                            <td>1</td>
                                            <td>Recoil</td>
                                            <td>30€</td>
                                            <td>Chen Zehn</td>
                                            <td>04 décembre 21</td>
                                        </tr>

                                        <!-- PRODUCT -->
                                        <tr>
                                            <td>1</td>
                                            <td>Recoil</td>
                                            <td>30€</td>
                                            <td>Chen Zehn</td>
                                            <td>04 décembre 21</td>
                                        </tr>

                                        <!-- PRODUCT -->
                                        <tr>
                                            <td>1</td>
                                            <td>Recoil</td>
                                            <td>30€</td>
                                            <td>Chen Zehn</td>
                                            <td>04 décembre 21</td>
                                        </tr>
                                            

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stock">
                    <div class="case">
                        <div class="header-case">
                            <h2>Vendeurs</h2>
                        </div>

                        <div class="body-case">

                            <!-- VENDOR -->
                            <div class="all-users">
                                <div class="infs">
                                    <img src="<?= $uploadsUri ?>id.jpg" width="30" height="30">
                                    <div>
                                        <h4>Omar</h4>
                                        <small>Vendor</small>
                                    </div>
                                </div>

                                <div class="vendor-ctact">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            <!-- VENDOR -->
                            <div class="all-users">
                                <div class="infs">
                                    <img src="<?= $uploadsUri ?>id.jpg" width="30" height="30">
                                    <div>
                                        <h4>Omar</h4>
                                        <small>Vendor</small>
                                    </div>
                                </div>

                                <div class="vendor-ctact">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            <!-- VENDOR -->
                            <div class="all-users">
                                <div class="infs">
                                    <img src="<?= $uploadsUri ?>id.jpg" width="30" height="30">
                                    <div>
                                        <h4>Omar</h4>
                                        <small>Vendor</small>
                                    </div>
                                </div>

                                <div class="vendor-ctact">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>


                        </div>
                        <button class="bo-button">Voir plus<span class="fa fa-arrow-right"></span></button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>