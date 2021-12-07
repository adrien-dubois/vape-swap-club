<div class="glob">
    <?php require __DIR__ . '/../partials/_sidebar.tpl.php'; ?>
    <div class="bo-content">
        <div class="bo-title">
            <h3>Vendeurs</h3>
        </div>
        <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
        <main>
            <div class="composant-full">
                <div class="ventes">
                    <div class="case">
                        <div>
                            <h2 style="text-align: center;">Liste des requêtes de vendeurs</h2>
                        </div>
                        <div class="body-case">
                            <div class="tableau">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Membre N°</td>
                                            <td>Nom</td>
                                            <td>E-Mail</td>
                                            <td>Telephone</td>
                                            <td>Adresse</td>
                                            <td>Date de demande</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($requests as $currentRequest): 
                                        ?>
                                        <tr>
                                            <!-- ID -->
                                            <td>
                                                <?= $currentRequest->getApp_user_id() ?>
                                            </td>

                                            <!-- NAME -->
                                            <td>
                                                <?= $currentRequest->getName() ?>
                                            </td>

                                            <!-- EMAIL -->
                                            <td>
                                                <?= $currentRequest->getEmail() ?>
                                            </td>

                                            <!-- PHONE -->
                                            <td>
                                                <?= $currentRequest->getTelephone() ?>
                                            </td>

                                            <!-- ADRESS -->
                                            <td>
                                                <?= $currentRequest->getAdress() ?>
                                            </td>

                                            <!-- CREATED DATE -->
                                            <td>
                                                <?php setlocale(LC_TIME, "fr_FR.utf8");
                                                    echo strftime("%d %b %Y", strtotime($currentRequest->getCreated_at()))  ?>
                                            </td>

                                            <!-- VALIDATE -->
                                            <td>
                                                <?php if($currentRequest->getAccepted() == 1 ): ?>
                                                <form action="" method="post">

                                                    <input type="hidden" name="user_id" value="<?= $currentRequest->getApp_user_id() ?>">

                                                    <input type="hidden" name="request_id" value="<?= $currentRequest->getId() ?> ">

                                                    <button id="bo-button" type="submit">Valider
                                                        <span class="fas fa-check-circle"></span>
                                                    </button>
                                                </form>
                                                
                                                <?php else : ?>
                                                    Validé <span class="fas fa-check-circle"></span>
                                                <?php endif; ?>
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