
<!-- FOOTER -->
<footer class="footer-distributed">
    <div class="footer-left">
        <img src="<?= $assetsBaseUri; ?>images/logo-footer.png" alt="logo" style="width: 100px; margin-left: 75px;">
        <h3>Vape <span>Swap Club</span> </h3>
        <p class="footer-links">
            <a href="<?= $this->router->generate('main-home'); ?>">Accueil</a>
            <a href="<?= $this->router->generate('product-list'); ?>">Annonces</a>
            <a href="<?= $this->router->generate('user-vendor'); ?>">Vendeur</a>
            <a href="<?= $this->router->generate('main-contact'); ?>">Contact</a>
        </p>
        <p class="footer-comp-name">&copy;2021 White Umbrella - Adrien Dubois</p>
    </div>
    
    <div class="footer-center">
        <div>
            <i class="fas fa-balance-scale"></i>
            <p><a href="<?= $this->router->generate('main-legals') ?>">Mentions Légales</a></p>
        </div>
        <div>
            <i class="fas fa-key"></i>
            <p><a href="<?= $this->router->generate('main-privacy') ?>">Politique de confidentialité</a></p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto: contact@vape-swap-club.white-umbrella.fr">Contact</a></p>
        </div>
    </div>
        
        <div class="footer-right">
            <p class="footer-comp-about">
                <span>Disclaimer</span>
                Ce site est un site de présentation, un side project juste destiné à partager mon code, et permettre de servir d'exemple de mes capacités. Vous pouvez vous inscrire, tester les diverses features, tout est fonctionnel, mais en aucun cas ce site est à but lucratif et/ou ne vend quelconque matériel ou objet.
                Vous pouvez retrouver le code du site sur mon GitHub, me retrouver sur LinkedIn ou me contacter via le formulaire de contact. Vous trouverez les liens vers mes réseaux ci-dessous.
            </p>
            <div class="footer-icons">
                <a href="https://www.linkedin.com/in/adrien-dubois-03/"><i class="fa fa-linkedin"></i></a>
                <a href="https://github.com/adrien-dubois"><i class="fa fa-github"></i></a>
                <a href="https://twitter.com/AdrienDuboisDev"><i class="fa fa-twitter"></i></a>
            </div>
        </div>
            
    </footer>

<script src="<?= $assetsBaseUri; ?>js/script.js"></script>
</body>

</html>