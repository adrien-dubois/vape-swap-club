<?php
     if (isset($errorList)) : 
     ?>
        <?php foreach ($errorList as $currentError) : ?>
          <div id="errors">
            <p style="color: red;"> <?= $currentError; ?> </p>
          </div>
        <?php endforeach; ?>
    <?php endif; ?>
