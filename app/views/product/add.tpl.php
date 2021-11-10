<div class="container-product">
    <div class="pl-form">
        <div class="heading">
            <h3>Ajouter une annonce 1/2</h3>
        </div>
        <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

        <!-- FORM -->

        <form action="" method="post" enctype="multipart/form-data" class="user-form">

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

                <!-- TYPE -->
                <div class="f1">
                    <label class="label">Type de produit</label>
                    <select name="type" class="input">
                        <option value="" disabled selected>Choisir un type</option>
                        <?php foreach ($allTypes as $currentType) : ?>
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
                        <?php foreach ($allCategories as $currentCategory) : ?>
                            <option value="<?= $currentCategory->getId() ?>"><?= $currentCategory->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="focus-input"></span>
                </div>
            </div>

            <div class="wrap">

                <!-- BRAND -->
                <div class="f1">
                    <label class="label">Marque du produit</label>
                    <select name="brand" class="input">
                        <option value="" disabled selected>Choisir une marque</option>
                        <?php foreach ($allBrands as $currentBrand) : ?>
                            <option value="<?= $currentBrand->getId() ?>"><?= $currentBrand->getName() ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="focus-input"></span>
                </div>

                <!-- IF NEW BRAND -->
                <div class="f2">
                    <label class="label">Cochez cette case pour ajouter une nouvelle marque</label>
                    <input id="check" type="checkbox">
                    <input name="new-brand" id="brand" type="text" class="input" disabled>
                    <span class="focus-input"></span>
                </div>
            </div>

            <!-- PICTURE -->
            <div class="wrap2">
                <input id="pic" class="input-file" name="picture" type="file" />
                <label for="pic" class="label l-file"><i class="fas fa-upload"></i> <span>Image principale </span></label>
                <span class="focus-input2"></span>
            </div>

            <script>
                var inputs = document.querySelectorAll('.input-file');
                Array.prototype.forEach.call(inputs, function(input) {
                    var label = input.nextElementSibling,
                        labelVal = label.innerHTML;

                    input.addEventListener('change', function(e) {
                        var fileName = '';
                        // if (this.files && this.files.length > 1)
                        //     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                        // else
                        fileName = e.target.value.split('\\').pop();

                        if (fileName)
                            label.querySelector('span').innerHTML = fileName;
                        else
                            label.innerHTML = labelVal;
                    });
                });
            </script>

            <!-- SUBMIT -->
            <button class="btn-register" type="submit">Valider</button>

        </form>
    </div>

    <div class="side-img">
        <img src="<?= $assetsBaseUri ?>images/adress.png" class="add-img" alt="">
    </div>

</div>

<script>
    document.getElementById('check').addEventListener('change', function() {
        if (document.getElementById('brand').disabled == true) {
            document.getElementById('brand').disabled = false;
        } else if (document.getElementById('brand').disabled == false) {
            document.getElementById('brand').disabled = true;
        }
    });
</script>