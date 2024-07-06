<?php

use Core\Session\Session;

?>

<main>
    <div class="jumbotron col-md-12 col-xs-12 ">
        <div class="division">
            <h1 class="title"><strong>Scegli la tua esperienza</strong></h1>
            <p class="text-center">Cambia quadro. Scopri alloggi nelle vicinanze <br> tutti da vivere, per lavoro o svago.</p>
            <div class="container h-100">
                <div class="d-flex justify-content-center h-100">
                    <div class="searchbar">
                        <input id="address-input" class="search_input" type="text" name="" placeholder="Search...">
                        <a id="bottone" href="/search" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success message -->
    <?php if (Session::has('status')): ?>
        <div class="alert alert-success">
            <?= Session::get('status') ?>
        </div>
    <?php endif; ?>

    <!-- Appartments -->
    <div class="container" style="max-width: 1350px;">
        <div class="flats">
            <h1><strong><i class="far fa-heart"></i> Appartamenti in Evidenza <i class="far fa-heart"></i></strong></h1>
            <div class="row justify-content-center" style="margin:45px 0 ;">
                <?php
                $count = 0;
                foreach ($sponsors as $sponsor) {
                    foreach ($sponsor->flats as $flat) {
                        if ($flat->disactive == 0 && $flat->deleted == 0 && $count < 6) {
                            $exist = isset($flat->sponsors->first()->pivot->flat_id);
                            if (!$exist) {
                                continue;
                            } elseif ($date->gt($flat->sponsors->first()->pivot->date_end)) {
                                continue;
                            } else {
                                $count += 1;
                                ?>
                                <div class="col-xs-12 col-lg-4 text-center" style="margin-bottom:20px;">
                                    <div class="dimension">
                                        <a href="/show/<?= htmlspecialchars($flat->id) ?>"><img src="<?= asset($flat->photo_url) ?>" style="width: 100%;box-shadow: 0 0.3rem 1rem rgba(0, 0, 0, 0.35) !important;" alt="404 not found"></a>
                                        <div class="shadow" style="background-color: #fff;border-radius: 5px;border: solid 1px #343a40;position: absolute;top: 3%;left: 3%;width:100px;height:18px;">
                                            <h6 style="color:#343a40;text-align: center;">SUPERHOST</h6>
                                        </div>
                                        <p style="margin-bottom: 1px;color: #f8fafc;position: absolute;bottom: 0px;left: 16px;font-size: 23px;"><strong><?= htmlspecialchars($flat->price_at_night) ?> € </strong></p>
                                    </div>
                                    <div class="title-description">
                                        <h2 style="font-size:16px;text-align: center;margin-top: 15px;"><a href="/show/<?= htmlspecialchars($flat->id) ?>"><?= htmlspecialchars($flat->title) ?></a></h2>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>
