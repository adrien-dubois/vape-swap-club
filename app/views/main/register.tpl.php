<div class="container-register">
    <div class="r-form">
        <div class="heading">
            <h1>Créer un compte</h1>
        </div>
       <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

        <!-- FORM -->
        <form action="" method="POST" enctype="multipart/form-data" class="user-form">
            <div class="wrap">
                <!-- LASTNAME -->
                <div class="f1">
                    <label class="label">Nom</label>
                    <input class="input" name="lastname" type="text" value="<?php if (isset($user)) : echo $user->getLastname(); endif; ?>"/>
                    <span class="focus-input"></span>
                </div>

                <!-- FIRSTNAME -->
                <div class="f2">
                    <label class="label">Prénom</label>
                    <input class="input" name="firstname" type="text" value="<?php if (isset($user)) : echo $user->getFirstname(); endif; ?>"/>
                    <span class="focus-input"></span>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="wrap2">
                <label class="label">E-Mail</label>
                <input class="input" name="email" type="text" value="<?php if (isset($user)) : echo $user->getEmail(); endif; ?>"/>
                <span class="focus-input2"></span>
            </div>

            <!-- PASSWORD -->
            <div class="wrap2">
                <label class="label">Mot de passe</label>
                <input class="input" name="password" type="password">
                <span class="focus-input2"></span>
            </div>

            <!-- AVATAR -->
            <div class="wrap2">
                <input id="file" class="input-file" name="picture" type="file" data-multiple-caption="{count} files selected" multiple />
                <label for="file" class="label l-file"><i class="fas fa-upload"></i> <span>Avatar </span></label>
                <span class="focus-input2"></span>
            </div>

            <script>
                var inputs = document.querySelectorAll( '.input-file' );
                Array.prototype.forEach.call( inputs, function( input )
                {
                    var label	 = input.nextElementSibling,
                        labelVal = label.innerHTML;

                    input.addEventListener( 'change', function( e )
                    {
                        var fileName = '';
                        if( this.files && this.files.length > 1 )
                            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                        else
                            fileName = e.target.value.split( '\\' ).pop();

                        if( fileName )
                            label.querySelector( 'span' ).innerHTML = fileName;
                        else
                            label.innerHTML = labelVal;
                    });
                });

            </script>

            <button class="btn-register" type="submit">Enregistrer</button>
        </form>
    </div>

    <!-- SIDE FORM IMAGE -->
    <div class="side-img"> <!--image-->
        <img src="<?= $assetsBaseUri ?>images/register2.png" class="right-img" alt=""> <!-- img -->
    </div>
</div>