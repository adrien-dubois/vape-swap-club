<div class="container">
    <div class="row">

        <div class="column-20 a-form">
            <div class="cont">
                <div class="titling">
                    <h3>Ajouter un produit 2/2</h3>
                </div>
                <p><i> <br> Afin de compléter votre annonce et de lui donner un maximum de visibilité, nous vous conseillons de rajouter des photos supplémentaires qui seront visibles et disponibles sur cette dernière. <br> Vous pouvez rajouter 3 photos supplémentaires en plus de la photo principale déjà postée depuis la page précédente, que vous pouvez sélectionner en même temps.</i></p>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="user-details">

                        <div class="input-box">
                            <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                            <input type="file" id="pics" name="images[]" class="input-cover" data-multiple-caption=" {count} images sélectionnées" multiple>
                            <label for="pics"><i class="fas fa-upload"></i> <span> Choisir une/des image(s)</span> </label>
                        </div>

                        <script>
                            var inputs = document.querySelectorAll('.input-cover');
                            Array.prototype.forEach.call(inputs, function(input) {
                                var label = input.nextElementSibling,
                                    labelVal = label.innerHTML;

                                input.addEventListener('change', function(e) {
                                    var fileName = '';
                                    if (this.files && this.files.length > 1)
                                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                                    else
                                        fileName = e.target.value.split('\\').pop();

                                    if (fileName)
                                        label.querySelector('span').innerHTML = fileName;
                                    else
                                        label.innerHTML = labelVal;
                                });
                            });
                        </script>

                        <div class="btn-adress">
                            <button type="submit" value="up" name="upload" class="btn-register"> Valider </button>
                            <a href="<?= $this->router->generate('main-home'); ?>"> <button style="cursor: pointer;" class="btn-modify"> Passer cette étape</button></a>
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