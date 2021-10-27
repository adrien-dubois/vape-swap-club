<?php 
    if (isset($_SESSION['flashMessage'])) : 
        foreach($_SESSION['flashMessage'] as $messageType => $messageList) : 
            foreach ($messageList as $currentMessage) : 
                if($messageType === 'success') : ?>


                    <div class="alert show">
                        <span class="far fa-check-circle"></span>
                        <span class="msg"> <?= $currentMessage; ?> </span>
                        <span id="close-btn" class="close-btn">
                            <span class="fas fa-times"></span>
                        </span>
                    </div>

                <?php elseif ($messageType === 'danger') : ?>

                    <div class="alert2 show">
                        <span class="fas fa-exclamation-triangle"></span>
                        <span class="msg"> <?= $currentMessage; ?> </span>
                        <span class="close-btn2">
                            <span class="fas fa-times"></span>
                        </span>
                    </div>

                <?php    
                endif;
            endforeach;
        endforeach;
        unset($_SESSION['flashMessage']);
    endif; 
?>

<!-- FOR SUCCESS -->
<script>
    $('.close-btn').click(function(){
        $('.alert').addClass("hide");
        $('.alert').removeClass("show");
    });
    $('.alert')
    setTimeout(function(){
        $('.alert').addClass("hide");
        $('.alert').removeClass("show");
    }, 5000);
</script>
<!-- FOR DANGER -->
<script>
    $('.close-btn2').click(function(){
        $('.alert2').addClass("hide");
        $('.alert2').removeClass("show");
    });
    $('.alert2')
    setTimeout(function(){
        $('.alert2').addClass("hide");
        $('.alert2').removeClass("show");
    }, 5000);
</script>
