<?php
// Check if the user is authenticated, if yes, redirect to the homepage
if($auth::isAuth()) $auth::redirect('/');
?>

<main class="container-form">
    <h1>Je me connecte</h1>

    <!-- Display error messages if the form has errors -->
    <?php if ($form_result && $form_result->hasErrors()): ?>
        <div class="alert alert-danger" role="alert">
            <!-- Display the first error message -->
            <?= $form_result->getErrors()[0]->getMessage() ?>
        </div>
    <?php endif ?>

    <!-- Login form -->
    <form class="auth-form" action="/login" method="POST">
        <div class="box-auth-input">
            <label class="detail-description">Adresse Email</label>
            <!-- Input for email address -->
            <input type="email" class="form-control" name="email">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Mot de passe</label>
            <!-- Input for password -->
            <input type="password" class="form-control" name="password">
            <!-- Submit button -->
            <button type="submit" class="call-action">Je me connecte</button>
        </div>
    </form>

    <!-- Link to registration page for users without an account -->
    <p class="header-description">Je n'ai pas de compte, <a class="auth-link" href="/register-form">Je m'inscrit</a></p>
</main>
