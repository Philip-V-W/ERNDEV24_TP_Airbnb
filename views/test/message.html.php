<?php

use Core\Session\Session;

?>

<main>
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center">
            <a href="/show/<?= htmlspecialchars($flat->id) ?>">
                <div class="col-xs-12 col-md-6 blocco-flat" style="position:relative;height: 400px;margin-bottom: 60px;">
                    <div id="carouselExampleControls<?= htmlspecialchars($flat->id) ?>" class="carousel slide" data-interval="false" style="border-radius:10px; margin-bottom: 10px;">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height: 350px;">
                                <img src="<?= asset($flat->photo_url) ?>" alt="">
                            </div>
                            <?php
                            $i = 0;
                            foreach ($photos as $photo) {
                                if ($photo->flat_id == $flat->id) {
                                    ?>
                                    <div class="carousel-item" style="height: 350px;">
                                        <img src="<?= asset($photo->photo_url) ?>" alt="">
                                    </div>
                                    <?php
                                    $i = 1;
                                }
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls<?= htmlspecialchars($flat->id) ?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls<?= htmlspecialchars($flat->id) ?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </a>
            <div class="col-xs-12 col-md-6" style="display: flex; align-items: center;">
                <div>
                    <h4 style="margin-bottom: 10px;" class="titoloappsearch"><?= htmlspecialchars($flat->title) ?></h4>
                    <p class="descrizione"><?= htmlspecialchars($flat->description) ?></p>
                    <p><strong><?= htmlspecialchars($flat->price_at_night) ?> €</strong></p>
                </div>
            </div>
            <div style="width: 100%;height: 2px;margin-bottom: 60px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
        </div>
        <h1 style="margin-bottom: 100px;">I messaggi dell' Appartamento:</h1>
        <ul>
            <?php foreach ($messages as $message): ?>
                <?php if ($message->flat_id == $flat->id): ?>
                    <div class="row justify-content-center" style="margin: 20px;">
                        <div class="col-xs-12" style="width:100%;word-wrap:break-word;">
                            <p><strong>Nome Cognome :</strong> <?= htmlspecialchars($message->name) ?></p>
                        </div>
                        <div class="col-xs-12" style="width:100%;word-wrap:break-word;">
                            <p><strong>Email :</strong> <?= htmlspecialchars($message->email) ?></p>
                        </div>
                        <div class="col-xs-12" style="width:100%;word-wrap:break-word;">
                            <p><strong>Subject :</strong> <?= htmlspecialchars($message->subject) ?></p>
                        </div>
                        <div class="col-xs-12" style="width:100%;word-wrap:break-word;">
                            <p><strong>Message :</strong> <?= htmlspecialchars($message->message) ?></p>
                        </div>
                    </div>
                    <div style="width: 100%;height: 2px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
