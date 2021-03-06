<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">
        <h2><span class="fas fa-tools"></span>Administration</h2>
    </div>

    <div class="sidebar-menu">
        <ul>
            <!-- HOME -->
            <li><a href="<?= $this->router->generate('backoffice-home') ?>" class="<?= ($currentPage === 'backoffice/home') ? 'active' : '' ?>"><span class="fa fa-home"></span><span>Accueil</span></a></li>

            <!-- USER -->
            <li><a href="<?= $this->router->generate('backoffice-user') ?>" class="<?= ($currentPage === 'backoffice/user') ? 'active' : '' ?>"><span class="fa fa-user-o"></span><span>Utilisateurs</span></a></li>

            <!-- REQUEST -->
            <li><a href="<?= $this->router->generate('backoffice-vendor') ?>" class="<?= ($currentPage === 'backoffice/request') ?'active' : '' ?>"><span class="fas fa-user-tie"></span><span>Demande vendeurs</span></a></li>

            <!-- PRODUCTS -->
            <li><a href="<?= $this->router->generate('backoffice-products') ?>" class="<?= ($currentPage === 'backoffice/products') ? 'active' : '' ?>"><span class="fas fa-shopping-cart"></span><span>Articles</span></a></li>

        </ul>
    </div>

</div>