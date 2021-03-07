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
echo form_open('faq_page_controller/update_faq/' . $faqs->faq_id);
?>

<div class="container">

    <h2 class="mt-4"><?php $pageTitle; ?></h2>
    <p>Les champs obligatoires sont précédés d'une étoile *</p>


    <div class="form-group">
        <label for="question">Renseignez la question *</label>
        <input type="text" class="form-control" name="question" required value="<?php echo $faqs->question ?>">
    </div>
    <div class="form-group">
        <label for="answer">Renseignez la réponse *</label>
        <textarea name="answer" class="form-control" required><?php echo $faqs->answer ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Valider</button>

    </form>

</div>