<?php
// Check if the user is authenticated, if yes, redirect to the homepage
if ($auth::isAuth()) $auth::redirect('/');
?>

<main class="container-form">
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 60px 0;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"
                         style="text-align:center; color:#fff; font-weight:bold; background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Log in to your account
                    </div>
                    <div class="card-body">
                        <!-- Display error messages if the form has errors -->
                        <?php if ($form_result && $form_result->hasErrors()): ?>
                            <div class="alert alert-danger" role="alert">
                                <!-- Display the first error message -->
                                <?= $form_result->getErrors()[0]->getMessage() ?>
                            </div>
                        <?php endif ?>

                        <!-- Login form -->
                        <form action="/login" method="POST">
                            <div class="form-group">
                                <label>Email Address</label>
                                <!-- Input for email address -->
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <!-- Input for password -->
                                <input type="password" class="form-control" name="password">
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success btn-block">Log in</button>
                        </form>

                        <!-- Link to registration page for users without an account -->
                        <p class="mt-3">I don't have an account, <a href="/register-form">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
