<?php

use App\AppRepoManager;
use Core\Session\Session;

// Define the groups based on equipment IDs
$equipment_groups = [
    'What about these guest favorites?' => range(1, 8), // IDs 1 to 10
    'Do you have any standout amenities?' => range(9, 22), // IDs 11 to 20
    'Do you have any of these safety items?' => range(23, 26)  // IDs 21 to 30
    // Add more groups as needed
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
    <h1 class="title title-detail">Airbnb my house</h1>
    <!-- Import error and success message template -->
    <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>

    <form class="auth-form" action="/addResidenceForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

        <div class="box-auth-input">
            <label class="detail-description">Title</label>
            <input type="" class="form-control" name="title">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Description</label>
            <input type="" class="form-control" name="description">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Price per night</label>
            <input type="" class="form-control" name="price">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Size ㎡</label>
            <input type="" class="form-control" name="size">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Rooms</label>
            <input type="" class="form-control" name="rooms">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Bedrooms</label>
            <input type="" class="form-control" name="bedrooms">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Bathrooms</label>
            <input type="" class="form-control" name="bathrooms">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Guests</label>
            <input type="" class="form-control" name="guests">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Type</label>
            <select name="type_id" id="type">
                <?php
                $types = AppRepoManager::getRm()->getTypeRepository()->getAllTypes();
                foreach ($types as $type) :
                    ?>
                    <option value="<?= htmlspecialchars($type['id']) ?>"><?= htmlspecialchars($type['label']) ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Address</label>
            <input type="" class="form-control" name="address">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">City</label>
            <input type="" class="form-control" name="city">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Zip code</label>
            <input type="" class="form-control" name="zip">
        </div>

        <div class="box-auth-input">
            <label class="detail-description">Country</label>
            <input type="" class="form-control" name="country">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Equipment</label>
            <?php
            // Display equipment items in different sections based on groups
            foreach ($groupedEquipments as $group_name => $items) {
                echo "<h3>" . htmlspecialchars($group_name) . "</h3>";
                foreach ($items as $equipment) {
                    ?>
                    <div>
                        <input type="checkbox" name="equipment[]" value="<?= htmlspecialchars($equipment['id']) ?>">
                        <label><?= htmlspecialchars($equipment['label']) ?></label>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <!-- Submit button -->
        <button type="submit" class="call-action">Add residence</button>
    </form>
</main>
