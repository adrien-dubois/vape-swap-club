<div class="container-register">
    <div class="r-form">
        <div class="heading">
            <h1>Ajouter une annonce</h1>
        </div>
        <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

        <!-- FORM -->

        <form action="" method="post" enctype="multipart/form-data" class="user-form" >

            <!-- NAME -->
            <div class="wrap2">
                <label class="label">Nom de l'article</label>
                <input type="text" name="name" class="input">
                <span class="focus-input2"></span>
            </div>

            <div class="wrap">
                <!-- PRICE -->
                <div class="f1">
                    <label class="label">Prix</label>
                    <input type="number" class="input" name="price">
                    <span class="focus-input"></span>
                </div>

                <!-- RATE -->
                <div class="f2">
                    <label class="label">Note <i>(sur 5)</i></label>
                    <input type="number" min="0" max="5" step="1" name="rate" class="input">
                    <span class="focus-input"></span>
                </div>
            </div>

            <div class="wrap">
                
                <!-- TYPE -->
                <div class="f1">
                    <label class="label">Type de produit</label>
                    <select name="type" class="input" >
                        <option value="" disabled selected>Choisir un type</option>
                        <?php foreach($allTypes as $currentType): ?>
                            <option value="<?= $currentType->getId() ?>"><?= $currentType->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="focus-input"></span>
                </div>

                <!-- CATEGORY -->
                <div class="f2">
                    <label class="label">Catégorie</label>
                    <select name="category" class="input">
                        <option value="" disabled selected>Choisir une catégorie</option>
                        <?php foreach($allCategories as $currentCategory): ?>
                            <option value="<?= $currentCategory->getId() ?>"><?= $currentCategory->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="focus-input"></span>
                </div>
            </div>

            <!-- SUBTITLE -->
            <div class="wrap2">
                <label class="label">Courte description <i> (pour la miniature)</i> </label>
                <textarea name="subtitle" class="input"></textarea>
                <span class="focus-input2"></span>
            </div>

            <!-- DESCRIPTION -->
            <div class="wrap2">
               <label class="label">Description complète</label>
                <textarea name="description complète" class="input"></textarea>
                <span class="focus-input2"></span>
            </div>

            <div class="wrap">
                <!-- BRAND -->
                <div class="f1">
                    <label class="label">Marque du produit</label>
                    <select name="brand" class="input">
                        <option value="" disabled selected>Choisir une marque</option>
                        <?php foreach($allBrands as $currentBrand): ?>
                            <option value="<?= $currentBrand->getId() ?>"><?= $currentBrand->getName() ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="focus-input"></span>
                </div>

                <!-- IF NEW BRAND -->
                <div class="f2">
                    <label class="label">Si la marque n'existe pas</label>
                    <input type="checkbox" class="input">
                    <input type="text" class="input">
                    <span class="focus-input"></span>
                </div>
            </div>

            <button class="btn-register" type="submit">Créer annonce</button>
        </form>

    </div>
</div>