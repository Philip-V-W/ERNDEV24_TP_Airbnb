<?php

use App\AppRepoManager;
use Core\Session\Session;

?>

<main class="container-form">
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 60px 0;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center; color:#fff; font-weight:bold; background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Inserisci il tuo appartamento.
                    </div>
                    <div class="card-body">
                        <form action="/editFlat/<?= htmlspecialchars($flat->id) ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?= Session::get(Session::CSRF_TOKEN) ?>">

                            <div class="form-group">
                                <label for="title">Titolo</label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($flat->title) ?>">
                            </div>

                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <select class="form-control" name="type">
                                    <option value="Intero Appartamento" <?= $flat->type == 'Intero Appartamento' ? 'selected' : '' ?>>Intero Appartamento</option>
                                    <option value="Singola Stanza" <?= $flat->type == 'Singola Stanza' ? 'selected' : '' ?>>Singola Stanza</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Descrizione</label>
                                <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($flat->description) ?>">
                            </div>

                            <div class="form-group" style="padding-top:1rem;">
                                <label for="price_at_night">Prezzo a notte</label>
                                <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($flat->price_at_night) ?>">
                            </div>

                            <div class="form-group">
                                <label for="number_of_bed">Numero di letti</label>
                                <select class="form-control" name="number_of_bed">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>" <?= $flat->number_of_bed == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="number_of_bathroom">Numero di Bagni</label>
                                <select class="form-control" name="number_of_bathroom">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>" <?= $flat->number_of_bathroom == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="number_of_room">Numero di stanze</label>
                                <select class="form-control" name="number_of_room">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>" <?= $flat->number_of_room == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mq">Metri quadrati</label>
                                <input type="number" name="size" class="form-control" value="<?= htmlspecialchars($flat->mq) ?>">
                            </div>

                            <div class="form-group">
                                <label for="photo_url">Carica la tua immagine di copertina</label>
                                <input type="file" name="photo_url" class="form-control" value="<?= htmlspecialchars($flat->photo_url) ?>">
                            </div>

                            <div class="form-group">
                                <label for="address">Indirizzo</label>
                                <input id="addresshost" type="text" name="address" class="form-control" value="<?= htmlspecialchars($flat->address) ?>" placeholder="Search...">
                            </div>

                            <input id="latitude" type="text" name="latitude" class="form-control none" value="<?= htmlspecialchars($flat->latitude) ?>">
                            <input id="longitude" type="text" name="longitude" class="form-control none" value="<?= htmlspecialchars($flat->longitude) ?>">
                            <button type="submit" class="btn btn-success btn-block">Inserisci il tuo Appartamento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
