<div class="container">
    <div class="row">

        <div class="column-20 a-form">
            <div class="cont">
                <div class="titling">
                    <h3>Ajouter un produit 1/2</h3>
                </div>
                <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="user-details">

                        <!-- NAME -->
                        <div class="input-box">
                            <span class="detail">Nom de l'article</span>
                            <input type="text" name="name" placeholder="Nom..." required>
                        </div>

                        <!-- PRICE -->
                        <div class="input-box">
                            <span class="detail">Prix €</span>
                            <input id="price" type="number" min="0" name="price" placeholder="Prix" required>
                        </div>

                        <!-- SUBTITLE -->
                        <div class="input-box">
                            <span class="detail">Courte description <i>(miniature)</i></span>
                            <textarea name="subtitle" type="text" placeholder="Présentation en une courte phrase"></textarea>
                        </div>

                        <!-- RATE -->
                        <div class="input-box">
                            <span class="detail">État de l'article <i>(sur 5) </i></span>
                            <input type="number" min="0" max="5" step="1" id="rate" name="rate" placeholder="0" required>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="input-box">
                            <span class="detail">Description complète <i>(fiche produit)</i> </span>
                            <textarea name="description" type="text" placeholder="Description complète du produit"></textarea>
                        </div>

                        <!-- TYPE -->
                        <div class="input-box">
                            <span class="detail">Type de l'article</span>
                            <select name="type" class="input2" style="width: 200px;" required>
                                <option disabled selected>Choisir un type</option>
                                <?php foreach ($allTypes as $currentType) : ?>
                                    <option value="<?= $currentType->getId() ?>"><?= $currentType->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- BRAND -->
                        <div class="input-box">
                            <span class="detail">Marque</span>
                            <select name="brand" style="width: 315px;" class="input2" required>
                                <option disabled selected>Choisir une marque</option>
                                <?php foreach ($allBrands as $currentBrand) : ?>
                                    <option value="<?= $currentBrand->getId() ?>"><?= $currentBrand->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- CATEGORY -->
                        <div class="input-box">
                            <span class="detail">Catégorie</span>
                            <select name="category" class="input2" style="width: 200px;" required>
                                <option disabled selected>Catégorie du produit</option>
                                <?php foreach ($allCategories as $currentCategory) : ?>
                                    <option value="<?= $currentCategory->getId() ?>"><?= $currentCategory->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- NEW BRAND -->
                        <div class="input-box">
                            <span class="detail">Si la marque de votre produit n'existe pas, cochez cette case</span>
                            <input type="checkbox" id="check" style="width: initial; text-align: center;">
                        </div>

                        <div class="input-box">
                            <span class="detail">Nouvelle marque</span>
                            <input id="brand" type="text" name="new-brand" disabled>
                        </div>

                        <!-- PICTURE -->

                        <div class="input-box">
                            <span class="detail">Image principale</span>
                            <input id="cover" class="input-cover" name="picture" type="file" required />
                            <label for="cover"><i class="fas fa-upload"></i> <span>Choisir une image...</span></label>
                        </div>

                        <script>
                            var inputs = document.querySelectorAll('.input-cover');
                            Array.prototype.forEach.call(inputs, function(input) {
                                var label = input.nextElementSibling,
                                    labelVal = label.innerHTML;

                                input.addEventListener('change', function(e) {
                                    var fileName = '';
                                    fileName = e.target.value.split('\\').pop();

                                    if (fileName)
                                        label.querySelector('span').innerHTML = fileName;
                                    else
                                        label.innerHTML = labelVal;
                                });
                            });
                        </script>

                        <div class="btn-adress">
                            <input type="submit" class="btn-register" value="Valider">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="column-20 side-img" style="margin-left: 20px;">
            <img src="<?= $assetsBaseUri ?>images/prod.png" width="1000px">
        </div>

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