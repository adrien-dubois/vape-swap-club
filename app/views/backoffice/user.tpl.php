<div class="glob">

    <?php require __DIR__ . '/../partials/_sidebar.tpl.php'; ?>

    <div class="bo-content">
        <div class="bo-title">
            <h3>Utilisateurs</h3>
        </div>
        <main>
            <div class="composant-full">
                <div class="ventes">
                    <div class="case">
                        <div>
                            <h2 style="text-align: center;">Liste des inscrits</h2>
                        </div>
                        <div class="body-case">
                            <div class="tableau">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Nom</td>
                                            <td>Email</td>
                                            <td>Avatar</td>
                                            <td>Role</td>
                                            <td>Status</td>
                                            <td>Date ajout</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- USERS -->
                                        <?php
                                        foreach ($users as $currentUser) :
                                        ?>
                                            <tr>
                                                <!-- ID -->
                                                <td>
                                                    <?= $currentUser->getId() ?>
                                                </td>

                                                <!-- NAME -->
                                                <td>
                                                    <?= $currentUser->getFirstname() .' '. $currentUser->getLastname() ?>
                                                </td>

                                                <!-- EMAIL -->
                                                <td>
                                                    <?= $currentUser->getEmail() ?>
                                                </td>

                                                <!-- PICTURE -->
                                                <td>
                                                    <img src="<?= $uploadsUri . $currentUser->getPicture() ?>" style="border-radius: 50%; width:40px; height: 40px;">
                                                </td>

                                                <!-- ROLE -->
                                                <td>
                                                    <?= $currentUser->getRole() ?>
                                                </td>

                                                <!-- STATUS -->
                                                <td>
                                                    <span class="status-element 
                                                    <?= ($currentUser->getStatus() == 'verified') ? 'color-ok' :
                                                    (($currentUser->getStatus() == 'not verified') ? 'color-no' :'')
                                                    ?>"></span>
                                                </td>

                                                <!-- CREATED DATE -->
                                                <td>
                                                    <?php setlocale(LC_TIME, "fr_FR.utf8");
                                                    echo strftime("%d %b %Y", strtotime($currentUser->getCreated_at()))  ?>
                                                </td>

                                                <!-- ACTIONS -->
                                                <td style="justify-content: space-between;">

                                                    <!-- DELETE -->
                                                    <a href="<?= $this->router->generate('user-delete', ['userId' => $currentUser->getId()]) ?>" onclick="return confirm('Supprimer l\'utilisateur n° <?= $currentUser->getId() ?> ?')"><span class="fas fa-trash-alt"></span></a>

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