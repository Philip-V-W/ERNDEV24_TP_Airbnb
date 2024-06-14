<!-- Display error message -->
<?php use Core\Session\Session;

if ($form_result && $form_result->hasErrors()) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $form_result->getErrors()[0]->getMessage() ?>
    </div>
    <script>
        setTimeout(function () {
            <?php
            Session::remove(Session::FORM_RESULT);
            ?>
        }, 300);
        setTimeout(function () {
            document.querySelector('.alert-danger').remove();
        }, 3000);
    </script>
<?php endif ?>

<!-- Display success message -->
<?php if ($form_success && $form_success->hasSuccess()) : ?>
    <div class="alert alert-success" role="alert">
        <?= $form_success->getSuccessMessage()->getMessage() ?>
    </div>
    <script>
        setTimeout(function () {
            <?php
            Session::remove(Session::FORM_SUCCESS);
            ?>
        }, 300);
        setTimeout(function () {
            document.querySelector('.alert-success').remove();
        }, 3000);
    </script>
<?php endif ?>