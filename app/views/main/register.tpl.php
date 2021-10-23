<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="column-2">
                <img src="<?= $assetsBaseUri; ?>images/back.png" width="100%">
            </div>
            <div class="column-2">


                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="Indicator">
                    </div>

                    <form id="LoginForm" class="register-form">
                        <input type="text" placeholder="Email">
                        <input type="password" placeholder="Mot de passe" name="" id="">
                        <button type="submit" class="btn-primary">Connect</button>
                        <a href="#" class="italic">Mot de passe oublié?</a>
                    </form>


                    <form id="RegForm" class="register-form">
                        <input type="text" placeholder="Email">
                        <input type="text" placeholder="Nom">
                        <input type="text" placeholder="Prénom">
                        <input type="password" placeholder="Mot de passe" name="" id="">
                        <button type="submit" class="btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOGGLE LOGIN FORM -->

<script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");

        function register(){
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(135px)";
        }
        function login(){
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(10px)";
        }

</script>