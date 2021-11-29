<div class="mailbox-body">
    <div class="mailbox-wrapper">
        <section class="mailbox-users">
            <h2 class="mailbox-title">Messagerie <i class="fas fa-comment"></i></h2>
            <header>

                <!-- FOR CURRENT USER -->
                <div class="mailbox-content">

                    <!-- PICTURE -->
                    <img src="<?= $uploadsUri . $currentUser->getPicture() ?>" alt="">
                    <div class="mailbox-details">

                        <!-- NAME -->
                        <span><?= $currentUser->getFirstname() . ' ' . $currentUser->getLastname() ?></span>

                        <!-- ROLE -->
                        <p><?= $currentUser->getRole() ?></p>
                    </div>
                </div>

                <!-- LOGOUT BUTTON -->
                <a href="<?= $this->router->generate('main-logout') ?>" class="mailbox-logout">Logout</a>
            </header>

            <!-- SELECT VENDOR TO DISCUSS -->
            <form action="" method="post">
                <div class="mailbox-search">
                    <span class="mailbox-text">Sélectionnez un vendeur </span>
                    <select name="recipientId">
                        <option disabled selected>Sélectionnez un vendeur pour discuter ...</option>
                        <?php foreach ($contacts as $currentContact) : ?>
                            <option value="<?= $currentContact->getId() ?>"> <?= $currentContact->getFirstname() . ' ' . $currentContact->getLastname() ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit"><i class="fas fa-envelope"></i></button>
                </div>
            </form>

            <!-- CONVERSATION LIST -->
            <div class="mailbox-users-list">

                <?php
                // Check if have any message
                if (!empty($receivedMessages)) :
                    // For each message
                    foreach ($receivedMessages as $currentMessage) :
                ?>
                        <!-- FOREACH CONVERSATION-->
                        <a href="<?= $this->router->generate('msg-read', ['recipientId'=>$currentMessage->getSender_id()]) ?>">
                            <div class="mailbox-content">

                                <!-- PICTURE -->
                                <img src="<?= $uploadsUri . $currentMessage->picture ?>">
                                <div class="mailbox-details">

                                    <!-- NAME -->
                                    <span><?= $currentMessage->firstname . ' ' . $currentMessage->lastname ?></span>

                                    <!-- DATE & TIME -->
                                    <p><?php setlocale(LC_TIME, "fr_FR.utf8");
                                        echo strftime("Le %d %b %Y à %R", strtotime($currentMessage->getCreated_at())) ?></p>
                                </div>
                            </div>
                            
                            <!-- IF IS READ -->
                            <?php if ($currentMessage->getIs_read() ==  0) : ?>
                                <div class="status-dot"><i class="fas fa-circle"></i></div>

                                <!-- IF IS NOT READ -->
                            <?php else : ?>
                                <div class="status-dot nomessage"><i class="fas fa-circle"></i></div>
                            <?php endif; ?>

                        </a>
                        <!-- ENDFOREACH -->

                    <?php
                    endforeach;
                else : ?>

                    <!-- IF NO CONVERSATION  -->
                    <div class="mailbox-content">
                        <p>Vous n'avez pas encore de conversation</p>
                    </div>

                <?php endif; ?>

            </div>
        </section>
    </div>
</div>