<?php

use Core\Session\Session;

// Ensure $listing, $types, and $groupedEquipments are passed to this view
?>

<main class="container-form">
    <div style="width: 100%; height: 15px; background: rgb(131,58,180); background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 60px 0;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align: center; color: #fff; font-weight: bold; background: rgb(131,58,180); background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Edit your residence
                    </div>
                    <div class="card-body">
                        <form action="/edit-residence/<?= $listing->getId() ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($listing->getTitle()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea style="height: 270px; resize: none;" name="description" rows="8" cols="80" class="form-control"><?= htmlspecialchars($listing->getDescription()) ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price per night</label>
                                <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($listing->getPricePerNight()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="size">Size ㎡</label>
                                <input type="number" name="size" class="form-control" value="<?= htmlspecialchars($listing->getSize()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="rooms">Rooms</label>
                                <select class="form-control" name="rooms">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $listing->getNbRooms() ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="bedrooms">Bedrooms</label>
                                <select class="form-control" name="bedrooms">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $listing->getNbBeds() ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="bathrooms">Bathrooms</label>
                                <select class="form-control" name="bathrooms">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $listing->getNbBaths() ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="guests">Guests</label>
                                <input type="number" name="guests" class="form-control" value="<?= htmlspecialchars($listing->getNbGuests()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type_id" id="type">
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?= htmlspecialchars($type['id']) ?>" <?= $type['id'] == $listing->getTypeId() ? 'selected' : '' ?>><?= htmlspecialchars($type['label']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="addresshost" name="address" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($listing->getAddress()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($listing->getCity()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="zip">Zip code</label>
                                <input type="text" name="zip" class="form-control" value="<?= htmlspecialchars($listing->getZip()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($listing->getCountry()) ?>">
                            </div>

                            <div class="form-group">
                                <label for="equipment">Equipment</label>
                                <?php foreach ($groupedEquipments as $group_name => $items): ?>
                                    <h3><?= htmlspecialchars($group_name) ?></h3>
                                    <?php foreach ($items as $equipment): ?>
                                        <?php $checked = in_array($equipment['id'], $listing->getEquipmentIds()) ? 'checked' : ''; ?>
                                        <div>
                                            <input type="checkbox" name="equipment[]" value="<?= htmlspecialchars($equipment['id']) ?>" <?= $checked ?>>
                                            <?php if (!empty($equipment['image_path'])): ?>
                                                <img src="<?= htmlspecialchars($equipment['image_path']) ?>" alt="<?= htmlspecialchars($equipment['label']) ?>" style="width:30px; height:30px;">
                                            <?php endif; ?>
                                            <label><?= htmlspecialchars($equipment['label']) ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>

                            <div class="form-group"><br>
                                <label for="photo_url">Upload your cover image</label>
                                <input type="file" name="photo_url" class="form-control">
                            </div><br>
                            <button type="submit" class="btn btn-success btn-block">Update your residence</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
