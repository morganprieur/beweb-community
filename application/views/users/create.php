<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>


<div class="container">

<?php echo validation_errors(); ?>
<?php echo form_open('user_controller/create_user'); ?>

    <h5 class="my-4">Le formulaire est soumis a condition de validation par l'admin. Vous ne pourrez pas vous connecter de suite.</h5>
    <p class="my-4">Les champs obligatoires sont précédés d'une étoile *</p>


    <div class="form-group">
        <label for="username">Pseudo Slack *</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="lastname">Nom *</label>
        <input type="text" class="form-control" name="lastname" required>
    </div>
    <div class="form-group">
        <label for="firstname">Prénom *</label>
        <input type="text" class="form-control" name="firstname" required>
    </div>
    <div class="form-group">
        <label for="mail">Mail *</label>
        <input type="email" class="form-control" name="mail" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe *</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="confirmPasswd">Confirmation de mot de passe *</label>
        <input type="password" class="form-control" name="confirmPasswd" required>
    </div>
    <div class="form-group">
        <label for="linkedin">Linkedin</label>
        <input type="text" class="form-control" name="linkedin">
    </div>
    <div class="form-group">
        <label for="promo">Promo</label>
        <input type="text" class="form-control" name="promo">
        <small>ex : nimes-01</small>
    </div>

    <div class="form-check">
        <h4 class="mt-4">Choisir la/les technos</h4>
        <?php foreach ($technos as $techno) : ?>
            <input type="checkbox" name="techno[]" value="<?php echo $techno->techno_id ?>" class="form-check-input">
            <label for="categories" class="form-check-label"><?php echo $techno->name ?></label><br>
        <?php endforeach ?>
    </div>


    <button type="submit" class="btn btn-danger mt-4" name="submit">Valider</button>

    </form>
</div>