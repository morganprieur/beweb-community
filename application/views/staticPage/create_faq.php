<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bg-white" class="text-left">Dashboard</h1>
    </div>
</div>


<?php
echo validation_errors();
echo form_open('faq_page_controller/create_faq');
?>

<div id="category-form" class="mt-5">

    <h3 class="mt-4"><?php echo $pageTitle; ?></h3>
    <p>Les champs obligatoires sont précédés d'une étoile *</p>


    <div class="form-group row mb-5">
        <label for="question" class="col-3">Renseignez la question *</label>
        <input type="text" class="col-9" name="question" required>
    </div>
    <div class="form-group row mb-5">
        <label for="answer" class="col-3">Renseignez la réponse *</label>
        <textarea name="answer" class="col-9" required></textarea>
    </div>

    <button type="submit" class="btn btn-danger" name="submit">Valider</button>

    </form>

</div>