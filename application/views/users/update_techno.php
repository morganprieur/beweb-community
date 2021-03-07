<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>

<div class="container">
    
    <?php validation_errors(); ?>
    <?php echo form_open('monCompte_controller/update_techno'); ?>

    <div id="category-form" class="mt-5">

        <h3 class="mt-4">Choisir la/les technos</h3>
        <div class="form-check" id="check">
            <?php foreach ($technos as $techno) : ?>
                <input type="checkbox" id="techno[<?php echo $techno->techno_id; ?>]" name="techno[]" value="<?php echo $techno->techno_id ?>" class="form-check-input">
                <label for="techno[<?php echo $techno->techno_id; ?>]" class="form-check-label"><?php echo $techno->name ?></label><br>
            <?php endforeach ?>
        </div>

        <button type="submit" class="btn btn-danger mt-3" name="submit">Valider</button>

        </form>
    </div>

</div>

