<?php

use Core\Session\Session;

?>

<main>
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 30px 0;">
            <div class="col-md-12">
                <div>
                    <h1 style="padding-bottom: 15px;">Account</h1>
                    <?php if (isset($user)): ?>
                        <p><strong>First Name:</strong> <?= htmlspecialchars($user->name ?? '') ?></p>
                        <p><strong>Last Name:</strong> <?= htmlspecialchars($user->lastname ?? '') ?></p>
                        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user->date_of_birth ?? '') ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user->email ?? '') ?></p>
                    <?php else: ?>
                        <p>No user data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div style="width: 100%;height: 2px;margin-bottom: 60px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>

        <ul>
            <?php
            $ishost = false;
            if (!empty($flats)) {
                foreach ($flats as $flat) {
                    if (!empty($flat->user_id) && $flat->user_id == $user->id) {
                        $ishost = true;
                        break;
                    }
                }
            }
            ?>

            <?php if ($ishost): ?>
                <h1>Your Listings:</h1>
            <?php endif; ?>

            <?php if (!empty($flats)): ?>
                <?php foreach ($flats as $flat): ?>
                    <?php if ($flat->user_id == $user->id && (property_exists($flat, 'deleted') ? !$flat->deleted : true)): ?>
                        <div class="row justify-content-center" style="margin-bottom: 23px;">
                            <a href="/show/<?= htmlspecialchars($flat->id) ?>">
                                <div class="col-xs-12 col-md-4 blocco-flat" style="position:relative;">
                                    <div id="carouselExampleControls<?= htmlspecialchars($flat->id) ?>" class="carousel slide" data-interval="false" style="border-radius:10px; margin-bottom: 10px;">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" style="height: 250px;">
                                                <img src="<?= asset($flat->photo_url) ?>" alt="">
                                            </div>
                                            <?php
                                            $i = 0;
                                            foreach ($photos as $photo) {
                                                if ($photo->flat_id == $flat->id) {
                                                    ?>
                                                    <div class="carousel-item" style="height: 250px;">
                                                        <img src="<?= asset($photo->photo_url) ?>" alt="">
                                                    </div>
                                                    <?php
                                                    $i = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php if ($i == 1): ?>
                                            <a class="carousel-control-prev" href="#carouselExampleControls<?= htmlspecialchars($flat->id) ?>" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls<?= htmlspecialchars($flat->id) ?>" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        <?php endif; ?>

                                        <?php
                                        $exist = isset($flat->sponsors->first()->pivot->flat_id);
                                        if ($exist && !$date->gt($flat->sponsors->first()->pivot->date_end)) {
                                            ?>
                                            <div class="shadow" style="background-color: #fff;border-radius: 5px;border: solid 1px #343a40;position: absolute;top: 13px;left: 13px;width:109px;height:25px;">
                                                <p style="color: black;text-align:center;">Sponsored</p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php if ($i == 0): ?>
                                            <a style="position: absolute;top: 7px;right: 14px;font-size: 30px;color: #fff;" href="/photo/<?= htmlspecialchars($flat->id) ?>"><i class="fas fa-images"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                            <div class="col-xs-12 col-md-4" style="display: flex; align-items: center;">
                                <div>
                                    <a href="/show/<?= htmlspecialchars($flat->id) ?>">
                                        <h4 style="margin-bottom: 10px;" class="titoloappsearch"><?= htmlspecialchars($flat->title) ?></h4>
                                    </a>
                                    <p class="descrizione"><?= htmlspecialchars($flat->description) ?></p>
                                    <p><strong><?= htmlspecialchars($flat->price_at_night) ?> €</strong></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4" style="text-align: end;">
                                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                                    <?php
                                    $exist = isset($flat->sponsors->first()->pivot->flat_id);
                                    if (!$exist || $date->gt($flat->sponsors->first()->pivot->date_end)) {
                                        ?>
                                        <div class="width">
                                            <a href="/sponsorForm/<?= htmlspecialchars($flat->id) ?>">Sponsor<i class="fas fa-chart-line"></i></a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="width">
                                        <a href="/showStats/<?= htmlspecialchars($flat->id) ?>">Statistics<i class="fas fa-chart-bar"></i></a>
                                    </div>
                                    <div class="width">
                                        <a href="/message/<?= htmlspecialchars($flat->id) ?>">Messages<i class="fas fa-envelope"></i></a>
                                    </div>
                                    <div class="width">
                                        <a href="/update/<?= htmlspecialchars($flat->id) ?>">Edit<i class="fas fa-pen"></i></a>
                                    </div>
                                    <?php if ($flat->disactive == 0): ?>
                                        <div class="width">
                                            <a href="/disable/<?= htmlspecialchars($flat->id) ?>">Disable<i class="fas fa-check-square"></i></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="width">
                                            <a href="/enable/<?= htmlspecialchars($flat->id) ?>">Enable<i class="fas fa-check-square"></i></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="width">
                                        <a href="/delete/<?= htmlspecialchars($flat->id) ?>">Delete<i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%;height: 2px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No flats available.</p>
            <?php endif; ?>
        </ul>
    </div>
</main>
