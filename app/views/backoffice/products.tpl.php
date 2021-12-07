<div class="glob">

    <?php require __DIR__ . '/../partials/_sidebar.tpl.php'; ?>

    <div class="bo-content">
        <div class="bo-title">
            <h3>Produits</h3>
        </div>
        <main>
            <div class="composant-full">
                <div class="ventes">
                    <div class="case">
                        <div>
                            <h2 style="text-align: center;">Liste des articles</h2>
                        </div>
                        <div class="body-case">
                            <div class="tableau">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Nom</td>
                                            <td>Prix</td>
                                            <td>Catégorie</td>
                                            <td>Vendeur</td>
                                            <td>Status</td>
                                            <td>Date ajout</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- USERS -->
                                        <?php
                                        foreach ($products as $currentProduct) :
                                        ?>
                                            <tr>
                                                <!-- ID -->
                                                <td>
                                                    <?= $currentProduct->getId() ?>
                                                </td>

                                                <!-- NAME -->
                                                <td>
                                                    <?= $currentProduct->getName() ?>
                                                </td>

                                                <!-- PRICE -->
                                                <td>
                                                    <?= $currentProduct->getPrice() ?>€
                                                </td>

                                                <!-- CATEGORY -->
                                                <td>
                                                    <?= $currentProduct->cat_name ?>
                                                </td>

                                                <!-- VENDOR -->
                                                <td>
                                                    <?= $currentProduct->firstname . ' ' . $currentProduct->lastname ?>
                                                </td>

                                                <!-- STATUS -->
                                                <td>
                                                    <span class="status-element
                                                    <?=
                                                    ($currentProduct->getStatus() == 1) ? 'color-ok' :
                                                    (($currentProduct->getStatus() == 2 ) ? 'color-no': '')
                                                    ?>">

                                                    </span>
                                                    
                                                    
                                                </td>

                                                <!-- CREATED DATE -->
                                                <td>
                                                    <?php setlocale(LC_TIME, "fr_FR.utf8");
                                                    echo strftime("%d %b %Y", strtotime($currentProduct->getCreated_at()))  ?>
                                                </td>

                                                <!-- ACTIONS -->
                                                <td style="justify-content: space-between;">

                                                    <!-- DELETE -->
                                                    <a href="<?= $this->router->generate('user-delete', ['userId' => $currentProduct->getId()]) ?>" onclick="return confirm('Supprimer l\'utilisateur n° <?= $currentProduct->getId() ?> ?')"><span class="fas fa-trash-alt"></span></a>

                                                    <!-- EDIT -->
                                                    <a href="<?= $this->router->generate('backoffice-edit-product', ['productId' => $currentProduct->getId()]) ?>"><span class="fas fa-edit"></span></a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</div>