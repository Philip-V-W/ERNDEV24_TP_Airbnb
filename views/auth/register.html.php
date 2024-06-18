<?php
// Check if the user is authenticated, if yes, redirect to the homepage
if($auth::isAuth()) $auth::redirect('/');
?>

<main class="container-form">
    <h1>Create an account</h1>

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
            <label class="detail-description">Email address</label>
            <!-- Input for email address -->
            <input type="email" class="form-control" name="email">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Password</label>
            <!-- Input for password -->
            <input type="password" class="form-control" name="password">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Confirm password</label>
            <!-- Input for password confirmation -->
            <input type="password" class="form-control" name="password_confirm">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Lastname</label>
            <!-- Input for last name -->
            <input type="" class="form-control" name="lastname">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Firstname</label>
            <!-- Input for first name -->
            <input type="" class="form-control" name="firstname">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Phone number</label>
            <input type="" class="form-control" name="phone">
        </div>
        <!-- Submit button -->
        <button type="submit" class="call-action">Sign up</button>
    </form>

    <!-- Link to login page for users with an existing account -->
    <p class="header-description">I already have an account, <a class="auth-link" href="/login-form">Log in</a></p>
</main>
