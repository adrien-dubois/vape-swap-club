<div class="glob">

    <?php require __DIR__ . '/../partials/_sidebar.tpl.php'; ?>

    <div class="bo-content">
        <div class="bo-title">
            <h3>Éditer <?= $currentProduct->getName() ?></h3>
        </div>
        <main>
            <div class="composant-full">
                <div class="bo-form">
                    <div class="cont">
                        <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="user-details">

                                <!-- NAME -->
                                <div class="input-box">
                                    <span class="detail">Nom de l'article</span>
                                    <input type="text" name="name" placeholder="Nom..." value="<?= $currentProduct->getName() ?>" required>
                                </div>

                                <!-- PRICE -->
                                <div class="input-box">
                                    <span class="detail">Prix €</span>
                                    <input id="price" type="number" min="0" name="price" value="<?= $currentProduct->getPrice() ?>" placeholder="Prix" required>
                                </div>

                                <!-- SUBTITLE -->
                                <div class="input-box">
                                    <span class="detail">Courte description <i>(miniature)</i></span>
                                    <textarea name="subtitle" type="text" placeholder="Présentation en une courte phrase"><?= $currentProduct->getSubtitle() ?></textarea>
                                </div>

                                <!-- RATE -->
                                <div class="input-box">
                                    <span class="detail">État de l'article <i>(sur 5) </i></span>
                                    <input type="number" min="0" max="5" step="1" id="rate" value="<?= $currentProduct->getRate() ?>" name="rate" placeholder="0" required>
                                </div>

                                <!-- DESCRIPTION -->
                                <div class="input-box">
                                    <span class="detail">Description complète <i>(fiche produit)</i> </span>
                                    <textarea name="description" type="text" placeholder="Description complète du produit"><?= $currentProduct->getDescription() ?></textarea>
                                </div>

                                <!-- TYPE -->
                                <div class="input-box">
                                    <span class="detail">Type de l'article</span>
                                    <select name="type" class="input2" style="width: 200px;" required>
                                        <option disabled >Choisir un type</option>
                                            <?php foreach ($allTypes as $currentType) : ?>
                                        <option 
                                            value="<?= $currentType->getId() ?>"
                                            <?php if($currentProduct->getTypeId() == $currentType->getId()) : echo 'selected'; endif; ?>
                                            >
                                            <?= $currentType->getName() ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- BRAND -->
                                <div class="input-box">
                                    <span class="detail">Marque</span>
                                    <select name="brand" style="width: 315px;" class="input2" required>
                                        <option disabled >Choisir une marque</option>
                                        <?php foreach ($allBrands as $currentBrand) : ?>
                                            <option 
                                            value="<?= $currentBrand->getId() ?>"
                                            <?php if($currentProduct->getBrandId() == $currentBrand->getId()) : echo 'selected'; endif; ?>
                                            ><?= $currentBrand->getName() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- CATEGORY -->
                                <div class="input-box">
                                    <span class="detail">Catégorie</span>
                                    <select name="category" class="input2" style="width: 200px;" required>
                                        <option disabled >Catégorie du produit</option>
                                        <?php foreach ($allCategories as $currentCategory) : ?>
                                            <option 
                                            value="<?= $currentCategory->getId() ?>"
                                            <?php if($currentProduct->getCategory_id() == $currentCategory->getId()) : echo 'selected'; endif; ?>
                                            ><?= $currentCategory->getName() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- PICTURE -->

                                <div class="input-box">
                                    <span class="detail">Image principale</span>
                                    <input id="cover" class="input-cover" name="picture" type="file" />
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
            </div>
        </main>
    </div>

</div>