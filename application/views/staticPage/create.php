<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bg-white" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>


<?php
echo validation_errors();
echo form_open_multipart('staticPage_controller/create_staticPage');
?>

<div id="category-form" class="mt-5">

    <p>Les champs obligatoires sont précédés d'une étoile *</p>


    <div class="form-group row mb-5 mt-5">
        <label for="title" class="col-3">Titre du document *</label>
        <input type="text" class="col-9" name="title" required>
    </div>

    <div class="form-group row mb-5 mt-5">
        <label for="text" class="col-3">Contenu *</label>
        <textarea name="text" class="col-9" required></textarea>
    </div>

    <div class="form-group row mb-5 mt-5">
        <label for="lien_doc" class="col-3">Lien</label>
        <input type="text" class="col-9" name="lien_doc">
    </div>
    
    <div class="form-groupe row mb-5">
        <label for="userfile" class="col-3">Image</label>
        <input type="file" name="userfile" size="20" class="col-9" />
    </div>

    <div class="form-group row mb-5 mt-5">
        <label for="video" class="col-3">Vidéo</label>
        <input type="text" class="col-9" name="video">
    </div>

    <button type="submit" class="btn btn-danger" name="submit">Valider</button>

    </form>

</div>