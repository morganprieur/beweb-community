<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>


<?php echo validation_errors(); ?>
<?php echo form_open('user_controller/login'); ?>

<div class="container">

    <p class="mt-5">Les champs obligatoires sont précédés d'une étoile *</p>


    <div class="form-group">
        <label for="username">Pseudo Slack *</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe *</label>
        <input type="password" class="form-control" name="password" required>
    </div>

    <button type="submit" class="btn btn-danger" name="submit">Connexion</button>

    <small><a href="<?php echo site_url('forget') ?>">Mot de passe oublié</a></small>

    </form>
</div>