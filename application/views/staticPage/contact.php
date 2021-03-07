<?php
echo validation_errors();
echo form_open('mail_controller/mail');
?>

<div class="row mb-3">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo beweb">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>


<div class="container">
    <p>Les champs obligatoires sont précédés d'une étoile *</p>

    <div class="row">
        <div class="col form-group">
            <label for="mail">Mail *</label>
            <input type="email" class="form-control" name="mail" required>
        </div>
        <div class="col form-group">
            <label for="pseudo">Pseudo Slack</label>
            <input type="text" class="form-control" name="pseudo">
        </div>
    </div>
    <div class="form-group">
        <label for="content">Message *</label>
        <textarea name="content" class="form-control" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>

    </form>
</div>