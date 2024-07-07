<?php

use App\AppRepoManager;
use Core\Session\Session;

// Define the groups based on equipment IDs
$equipment_groups = [
    'What about these guest favorites?' => range(1, 8),
    'Do you have any standout amenities?' => range(9, 22),
    'Do you have any of these safety items?' => range(23, 26)
];

// Fetch all equipment items
$equipments = AppRepoManager::getRm()->getEquipmentRepository()->getAllEquipment();

// Group the equipment items based on the predefined groups
$groupedEquipments = [];
foreach ($equipments as $equipment) {
    foreach ($equipment_groups as $group_name => $range) {
        if (in_array($equipment['id'], $range)) {
            $groupedEquipments[$group_name][] = $equipment;
            break;
        }
    }
}

?>

<main class="container-form">
    <div style="width: 100%;height: 15px;background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);"></div>
    <div class="container">
        <div class="row justify-content-center" style="padding: 60px 0;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"
                         style="text-align:center; color:#fff; font-weight:bold; background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Insert your residence
                    </div>
                    <div class="card-body">
                        <form action="/addResidenceForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea style="height: 270px;resize: none;" name="description" rows="8" cols="80"
                                          class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price per night</label>
                                <input type="number" name="price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="size">Size ㎡</label>
                                <input type="number" name="size" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="rooms">Rooms</label>
                                <select class="form-control" name="rooms">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="bedrooms">Bedrooms</label>
                                <select class="form-control" name="bedrooms">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="bathrooms">Bathrooms</label>
                                <select class="form-control" name="bathrooms">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="guests">Guests</label>
                                <select class="form-control" name="guests">
                                    <?php for ($i = 1; $i <= 20; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type_id" id="type">
                                    <?php
                                    $types = AppRepoManager::getRm()->getTypeRepository()->getAllTypes();
                                    foreach ($types as $type) :
                                        ?>
                                        <option value="<?= htmlspecialchars($type['id']) ?>"><?= htmlspecialchars($type['label']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="" id="addresshost" name="address" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="" name="city" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="zip">Zip code</label>
                                <input type="" name="zip" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="" name="country" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="equipment">Equipment</label>
                                <?php
                                // Display equipment items in different sections based on groups
                                foreach ($groupedEquipments as $group_name => $items) {
                                    echo "<h3>" . htmlspecialchars($group_name) . "</h3>";
                                    foreach ($items as $equipment) {
                                        ?>
                                        <div>
                                            <input type="checkbox" name="equipment[]"
                                                   value="<?= htmlspecialchars($equipment['id']) ?>">
                                            <?php if (!empty($equipment['image_path'])): ?>
                                                <img src="<?= htmlspecialchars($equipment['image_path']) ?>"
                                                     alt="<?= htmlspecialchars($equipment['label']) ?>"
                                                     style="width:30px; height:30px;">
                                            <?php endif; ?>
                                            <label><?= htmlspecialchars($equipment['label']) ?></label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="form-group"><br>
                                <label for="photo_url">Upload your cover image</label>
                                <input type="file" name="photo_url" class="form-control">
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="additional_photos">Upload additional images</label>
                                <input type="file" name="photo_url_additional[]" class="form-control" multiple>
                            </div>
                            <br>
                            <button type="submit" class="reserve-btn mb-3">Insert your residence</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
