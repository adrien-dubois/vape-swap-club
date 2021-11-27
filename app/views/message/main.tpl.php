<!-- <h2 >Boîte de réception <i class="fas fa-inbox"></i></h2> -->
<div class="mailbox-body">
    <div class="mailbox-wrapper">
        <section class="mailbox-users">
            <header>
                <div class="mailbox-content">
                    <img src="<?= $uploadsUri ?>id.jpg" alt="">
                    <div class="mailbox-details">
                        <span>Jean Claude Dusse</span>
                        <p>Online</p>
                    </div>
                </div>
                <a href="<?= $this->router->generate('main-logout') ?>" class="mailbox-logout">Logout</a>
            </header>
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
            <div class="mailbox-users-list">

                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot nomessage"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot nomessage"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>
                <!-- FOREACH -->
                <a href="#">
                    <div class="mailbox-content">
                        <img src="<?= $uploadsUri ?>id.jpg" alt="">
                        <div class="mailbox-details">
                            <span>Jean Claude Dusse</span>
                            <p>Test message</p>
                        </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>


            </div>
        </section>
    </div>
</div>