<?php
// Check if the user is authenticated, if yes, redirect to the homepage
if($auth::isAuth()) $auth::redirect('/');
?>

<main class="container-form">
    <h1>Je crée mon compte</h1>

    <!-- Display error messages if the form has errors -->
    <?php if ($form_result && $form_result->hasErrors()): ?>
        <div class="alert alert-danger" role="alert">
            <!-- Display the first error message -->
            <?= $form_result->getErrors()[0]->getMessage() ?>
        </div>
    <?php endif ?>

    <!-- Registration form -->
    <form class="auth-form" action="/register" method="POST">
        <div class="box-auth-input">
            <label class="detail-description">Adresse Email</label>
            <!-- Input for email address -->
            <input type="email" class="form-control" name="email">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Mot de passe</label>
            <!-- Input for password -->
            <input type="password" class="form-control" name="password">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Confirmation</label>
            <!-- Input for password confirmation -->
            <input type="password" class="form-control" name="password_confirm">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Votre nom</label>
            <!-- Input for last name -->
            <input type="text" class="form-control" name="lastname">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Votre prénom</label>
            <!-- Input for first name -->
            <input type="text" class="form-control" name="firstname">
        </div>
        <!-- Submit button -->
        <button type="submit" class="call-action">Je m'inscrit</button>
    </form>

    <!-- Link to login page for users with an existing account -->
    <p class="header-description">J'ai déja un compte, <a class="auth-link" href="/login-form">Je me connecte</a></p>
</main>
