<?php 
    if (isset($_SESSION['flashMessage'])) : 
        foreach($_SESSION['flashMessage'] as $messageType => $messageList) : 
            foreach ($messageList as $currentMessage) : 
                if ($messageType == 'success'){ ?>

                    <p style="color: green;"> . $currentMessage . </p>
                <?php } elseif($messageType == 'danger'){ ?>
                    <p style="color: red;"> . $currentMessage . </p>
                <?php }


            endforeach;
        endforeach;
        unset($_SESSION['flashMessage']);
    endif; 
