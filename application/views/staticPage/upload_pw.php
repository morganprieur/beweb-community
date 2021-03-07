<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left">Réinitialiser son mot de passe</h1>
    </div>
</div>


<?php
echo validation_errors();
echo form_open('mail_controller/reset_pw');
?>

<div class="container">
    <h3 class="mt-4">Renseignez votre nouveau mot de passe</h3>
    <p>Les champs obligatoires sont précédés d'une étoile *</p>

    <div class="row">
        <div class="col form-group">
            <label for="password">Mot de passe *</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="col form-group">
            <label for="psswd_confirm">Confirmer votre mot de passe *</label>
            <input type="password" class="form-control" name="psswd_confirm" required>
        </div>
        <input type="hidden" value="<?php echo $token ?>" name="token">


        <button type="submit" class="btn btn-danger" name="submit">Envoyer</button>

        </form>

    </div>