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
                    <div class="card-header" style="text-align:center; color:#fff; font-weight:bold; background: rgb(131,58,180);background: linear-gradient(90deg, rgba(131,58,180,0.6671043417366946) 0%, rgba(253,29,29,0.7287289915966386) 50%, rgba(252,176,69,0.6502976190476191) 100%);">
                        Insert your apartment.
                    </div>
                    <div class="card-body">
                        <form action="/addResidenceForm" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type">
                                    <option value="Entire Apartment">Entire Apartment</option>
                                    <option value="Single Room">Single Room</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea style="height: 270px;resize: none;" name="description" rows="8" cols="80" class="form-control"></textarea>
                            </div>

                            <div class="services-check">
                                <ul class="ks-cboxtags">
                                    <?php foreach ($services as $service): ?>
                                        <li>
                                            <input type="checkbox" id="<?= $service->service_name ?>" name="<?= $service->service_name ?>" class="form-check-input" value="<?= $service->id ?>">
                                            <label class="form-check-label" for="<?= $service->service_name ?>"><?= $service->service_name ?></label>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="form-group" style="padding-top:1rem;">
                                <label for="price_at_night">Price per night</label>
                                <input type="number" name="price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="number_of_bed">Number of beds</label>
                                <select class="form-control" name="number_of_bed">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="number_of_bathroom">Number of bathrooms</label>
                                <select class="form-control" name="number_of_bathroom">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="number_of_room">Number of rooms</label>
                                <select class="form-control" name="number_of_room">
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mq">Square meters</label>
                                <input type="number" name="size" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="photo_url">Upload your cover image</label>
                                <input type="file" name="photo_url" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="addresshost" type="text" name="address" class="form-control" placeholder="Search...">
                            </div>

                            <input id="latitude" type="text" name="latitude" class="form-control none" value="">
                            <input id="longitude" type="text" name="longitude" class="form-control none" value="">
                            <button type="submit" class="btn btn-success btn-block">Insert your apartment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
