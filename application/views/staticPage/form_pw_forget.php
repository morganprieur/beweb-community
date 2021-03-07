<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>


<?php
echo validation_errors();
echo form_open('mail_controller/pw_forget');
?>

<div class="container">
    <h3 class="mt-4">Renseignez votre adresse mail</h3>
    <p>Les champs obligatoires sont précédés d'une étoile *</p>

    <div class="row">
        <div class="col form-group">
            <label for="mail">Mail *</label>
            <input type="email" class="form-control" name="mail" required>
        </div>

    <button type="submit" class="btn btn-danger" name="submit">Envoyer</button>

    </form>

</div>