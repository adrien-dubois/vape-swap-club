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
                    <tr>
                        <!-- gérer ouvert/non ouvert -->
                        <td class="pict"><i class="far fa-envelope"></i></td>
                        <td>Jean Claude</td>
                        <td>Bonjour</td>
                        <td>Date du jour</td>
                        <td class="pict"><i class="fas fa-trash-alt"></i></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="new-mess">
                <div class="return-back">
                    <i class="fas fa-reply"></i>
                    <p>Retour à l'accueil</p>
                </div>
                <div class="mess-elements">
                    <i class="far fa-comments"></i>
                    <a href="<?= $this->router->generate('msg-new') ?>"><p>Nouveau message</p></a>
                </div>
            </div>
        </div>
    </div>
</div>