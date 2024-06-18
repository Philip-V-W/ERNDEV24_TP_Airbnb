<?php

use App\AppRepoManager;
use Core\Session\Session;

?>
<main class="container-form">
    <h1 class="title title-detail">Airbnb my house</h1>
    <!-- on importe notre template de gestion d'erreur et success -->
<!--   --><?php //include(PATH_ROOT . 'views/_templates/_message.html.php') ?>


    <form class="auth-form" action="/addResidenceForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
        <div class="box-auth-input">
            <label class="detail-description">Title</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="title">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Description</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="description">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Price per night</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="price">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Rooms</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="rooms">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Bedrooms</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="bedrooms">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Bathrooms</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="bathrooms">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Guests</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="guests">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Type of residence</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="type">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Address</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="address">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">City</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="city">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Zip code</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="zip">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Country</label>
            <!-- Input for email address -->
            <input type="" class="form-control" name="country">
        </div>
        <!-- Submit button -->
        <button type="submit" class="call-action">Add residence</button>
    </form>
