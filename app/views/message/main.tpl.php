<div class="container">
    <div class="row">
        <div class="mailbox">
            <h2 >Boîte de réception <i class="fas fa-inbox"></i></h2>

            <table>
                <thead>
                    <tr>
                        <th class="pict">Lu / Non lu</th>
                        <th>De</th>
                        <th>Sujet</th>
                        <th>Date</th>
                        <th class="pict">Supprimer</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <!-- gérer si pas de messages -->
                        <?php
                        // Check if have any message
                        if(!empty($receivedMessages)):
                        // For each message
                        foreach($receivedMessages as $currentMessage):
                        ?>
                    <tr>
                        <!-- CHECK IF MESSAGE IS READ -->
                        <?php if($currentMessage->getIs_read() ==  0): ?>
                            <td class="pict"><i class="far fa-envelope"></i></td>
                        <?php else: ?>
                            <td class="pict"><i class="far fa-envelope-open"></i></td>
                        <?php endif; ?>

                        <td><?= $currentMessage->firstname . ' ' . $currentMessage->lastname ?></td>
                        <td><a style="font-size: 18px; color: white;" href="<?= $this->router->generate('msg-read', ['recipientId'=>$currentMessage->getSender_id()]) ?>"><?= $currentMessage->getTitle() ?></a></td>
                        <td><?= date('d/m/Y', strtotime($currentMessage->getCreated_at())) ?></td>
                        <td class="pict"><i class="fas fa-trash-alt"></i></td>
                        <td></td>
                    </tr>
                    <?php 
                    endforeach;
                    else :?>
                    <tr>
                        <td>Vous n'avez pas de messages</td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>

            <div class="new-mess">
                <div class="return-back">
                    <a href="<?= $this->router->generate('main-home') ?>">
                        <i class="fas fa-reply"></i>
                        <p>Retour à l'accueil</p>
                    </a>
                </div>
                <div class="mess-elements">
                    <a href="<?= $this->router->generate('msg-new') ?>">
                        <i class="far fa-comments"></i>
                        <p>Nouvelle discussion</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>