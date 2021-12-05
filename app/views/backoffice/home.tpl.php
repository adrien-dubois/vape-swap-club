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
                        <h2><?=$nbUsers; ?></h2>
                        <small>Utilisateurs</small>
                    </div>
                    <div>
                        <span class="fa fa-user-o"></span>
                    </div>
                </div>

                <!-- CARD -->
                <div class="card-single">
                    <div>
                        <h2><?= $nbOrders; ?></h2>
                        <small>Ventes</small>
                    </div>
                    <div>
                        <span class="fas fa-money-bill-wave"></span>
                    </div>
                </div>

                <!-- CARD -->
                <div class="card-single">
                    <div>
                        <h2><?= $nbProducts ?></h2>
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

                                    <?php 
                                        foreach($articles as $currentArticle):
                                    ?>
                                        <!-- PRODUCT -->
                                        <tr>
                                            <td><?= $currentArticle->getId() ?></td>
                                            <td><?= $currentArticle->getName() ?></td>
                                            <td><?= $currentArticle->getPrice() ?>€</td>
                                            <td><?= $currentArticle->firstname . ' ' . $currentArticle->lastname ?></td>
                                            <td><?php setlocale(LC_TIME, "fr_FR.utf8");
                                        echo strftime("%d %b %Y", strtotime($currentArticle->getCreated_at()))  ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                            
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

                        <?php foreach($vendors as $currentVendor): ?>
                            <!-- VENDOR -->
                            <div class="all-users">
                                <div class="infs">
                                    <img src="<?= $uploadsUri . $currentVendor->getPicture() ?>" width="30" height="30">
                                    <div>
                                        <h4><?= $currentVendor->getFirstname() . ' ' .$currentVendor->getLastname() ?></h4>
                                        <small><?= $currentVendor->getRole() ?></small>
                                    </div>
                                </div>

                                <div class="vendor-ctact">
                                    <a href="mailto: <?= $currentVendor->getEmail() ?>"><span class="fas fa-envelope"></span></a>
                                    <a href="<?= $this->router->generate('msg-read', ['recipientId'=>$currentVendor->getId()]) ?>"><span class="fas fa-comments"></span></a>
                                </div>
                            </div>
                        <?php endforeach;  ?>

                        </div>
                        <button class="bo-button" style="margin: 1rem;">Voir plus<span class="fa fa-arrow-right"></span></button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>