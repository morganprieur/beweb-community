<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>

<?php echo validation_errors(); ?>
<?php echo form_open_multipart('monCompte_controller/update_user/' . $single_user->user_id); ?>

<?php $image_properties = array(
    'src'   => base_url('asset/images/' . $single_user->user_image),
    'height' => '150px',
); ?>


<div id="category-form" class="mt-5">

    <?php if ($_SESSION['role'] === 'member') : ?>

        <div class="form-group row mb-5">
            <label for="lastname" class="col-3">Nom</label>
            <input type="text" class="col-9" name="lastname" value="<?php echo $single_user->lastname ?>">
        </div>
        <div class="form-group row mb-5">
            <label for="firstname" class="col-3">Prénom</label>
            <input type="text" class="col-9" name="firstname" value="<?php echo $single_user->firstname ?>">
        </div>
        <div class="form-group row mb-5">
            <label for="mail" class="col-3">Mail</label>
            <input type="email" class="col-9" name="mail" value="<?php echo $single_user->mail ?>">
        </div>
        <div class="form-group row mb-5">
            <label for="linkedin" class="col-3">Linkedin</label>
            <input type="text" class="col-9 mb-4" name="linkedin" value="<?php echo $single_user->linkedin ?>">
        </div>

        <?php echo img($image_properties); ?>
        <input type='file' name='userfile' size='20' class="mt-2" />
        <br><br>

            <input type="hidden" class="col-9" name="username" value="<?php echo $single_user->username ?>">
            <input type="hidden" class="col-9" name="promo" value="<?php echo $single_user->promo ?>">

    <?php elseif ($_SESSION['role'] === 'admin') : ?>

        <div class="form-group row mb-5">
            <label for="username" class="col-3">Username</label>
            <input type="text" class="col-9" name="username" value="<?php echo $single_user->username ?>">
        </div>
        <div class="form-group row mb-5">
            <label for="promo" class="col-3">Promo</label>
            <input type="text" class="col-9" name="promo" value="<?php echo $single_user->promo ?>">
            <small>ex : nimes-01</small>
        </div>

        <input type="hidden" class="col-9" name="lastname" value="<?php echo $single_user->lastname ?>">
        <input type="hidden" class="col-9" name="firstname" value="<?php echo $single_user->firstname ?>">
        <input type="hidden" class="col-9" name="mail" value="<?php echo $single_user->mail ?>">
        <input type="hidden" class="col-9 mb-4" name="linkedin" value="<?php echo $single_user->linkedin ?>">

    <?php endif ?>

    <button type="submit" class="btn btn-danger mt-3" name="submit">Valider</button>

    </form>

</div>