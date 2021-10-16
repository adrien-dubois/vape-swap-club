<?php 
    if (isset($_SESSION['flashMessage'])) : 
        foreach($_SESSION['flashMessage'] as $messageType => $messageList) : 
            foreach ($messageList as $currentMessage) : ?>

                    <!-- <p style="color: green;"> . $currentMessage . </p> -->

                    <div class="alert show">
                        <span class="fas fa-exclamation-circle"></span>
                        <span class="msg"> <?= $currentMessage; ?> </span>
                        <span class="close-btn">
                            <span class="fas fa-times"></span>
                        </span>
                    </div>

                <?php 

            endforeach;
        endforeach;
        unset($_SESSION['flashMessage']);
    endif; 
