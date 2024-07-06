<?php

use Core\Session\Session;

?>

<main>
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>

    <?php if (Session::has('status')): ?>
        <div class="alert alert-success">
            <?= Session::get('status') ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center" style="padding: 60px 0;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center; color:#fff; font-weight:bold; background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Sponsorizza il tuo annuncio
                    </div>
                    <div class="card-body">
                        <form action="/sponsorPayment/<?= htmlspecialchars($flat->id) ?>" method="post">
                            <input type="hidden" name="csrf_token" value="<?= Session::get(Session::CSRF_TOKEN) ?>">

                            <?php foreach ($sponsors as $sponsor): ?>
                                <div class="form-check" style="margin-bottom: 10px;">
                                    <input type="radio" name="sponsor" id="<?= htmlspecialchars($sponsor->id) ?>" class="form-check-input" value="<?= htmlspecialchars($sponsor->id . '/' . $sponsor->duration) ?>">
                                    <label class="form-check-label" for="<?= htmlspecialchars($sponsor->id) ?>">Sponsorizza il tuo annuncio per <?= htmlspecialchars($sponsor->duration) ?>H al costo di <?= htmlspecialchars($sponsor->cost) ?></label>
                                </div>
                            <?php endforeach; ?>

                            <?php if (Session::has('errors') && Session::get('errors')->has('sponsor')): ?>
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong><?= Session::get('errors')->first('sponsor') ?></strong>
                                </span>
                            <?php endif; ?>

                            <div id="dropin-container" style="margin-top:20px;"></div>
                            <a class="btn btn-primary" id="submit-button">Request payment method</a>
                            <button id="compra" type="submit" class="btn btn-success none">Paga</button>
                        </form>

                        <script type="text/javascript">
                            braintree.dropin.create({
                                authorization: "<?= Braintree\ClientToken::generate() ?>",
                                container: '#dropin-container'
                            }, function(createErr, instance) {
                                var button = document.querySelector('#submit-button');
                                button.addEventListener('click', function() {
                                    instance.requestPaymentMethod(function(err, payload) {
                                        if (typeof(payload) !== "undefined") {
                                            var element = document.getElementById("compra");
                                            element.classList.remove("none");
                                            element.classList.add("display");
                                            var element2 = document.getElementById("submit-button");
                                            element2.classList.add("none");
                                            console.log(payload);
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
