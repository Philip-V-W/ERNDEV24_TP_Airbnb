<?php

use Core\Session\Session;

?>

<main>
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 60px 0;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center; color:#fff; font-weight:bold; background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Carica
                    </div>
                    <div class="card-body">
                        <form action="/storePhoto/<?= htmlspecialchars($flat->id) ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?= Session::get(Session::CSRF_TOKEN) ?>">
                            <div class="form-group">
                                <label for="photo_url">Carica immagine</label>
                                <input type="file" name="photo_url" class="form-control" value="<?= htmlspecialchars($flat->photo_url) ?>" ondblclick="this.value=''">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Inserisci Immagini</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
