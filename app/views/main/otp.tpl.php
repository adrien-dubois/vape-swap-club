<div class="container-register">
    <div class="r-form">
        <div class="heading">
            <h1>Activation de votre compte</h1>
        </div>
       <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

        <!-- FORM -->
        <form action="" method="POST" class="user-form">

            <!-- OTP -->
            <div class="wrap2">
                <label class="label">Numéro d'activation</label>
                <input class="input" name="user_otp" type="text" />
                <span class="focus-input2"></span>
            </div>

            <input type="submit" name="submit" class="btn-register" value="Submit" />
        </form>
    </div>

    <!-- SIDE FORM IMAGE -->
    <div class="side-img"> <!--image-->
        <img src="<?= $assetsBaseUri ?>images/register2.png" class="right-img" alt=""> <!-- img -->
    </div>
</div>