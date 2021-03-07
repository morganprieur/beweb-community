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
echo form_open_multipart('staticPage_controller/update_staticPage/' . $single_staticPage->documentId);
?>

<?php $image_properties = array(
    'src'   => base_url('asset/images/' . $single_staticPage->image),
    'height' => '150px',
); ?>


<div id="category-form" class="mt-5">

    <div class="form-group row mb-5 mt-5">
        <label for="title" class="col-3">Titre du document</label>
        <input type="text" class="col-9" name="title" value="<?php echo $single_staticPage->title ?>">
    </div>
    <div class="form-group row mb-5 mt-5">
        <label for="text" class="col-3">Contenu</label>
        <textarea name="text" class="col-9"><?php echo $single_staticPage->text ?></textarea>
    </div>
    <div class="form-group row mb-5 mt-5">
        <label for="lien_doc" class="col-3">Lien</label>
        <input type="text" class="col-9" name="lien_doc" value="<?php echo $single_staticPage->lien_doc ?>">
    </div>
    <div class="form-group row mb-5 mt-5">
        <label for="userfile" class="col-3">Image</label>
        <input type="file" name="userfile" size="20" class="col-9"  value="<?php echo $single_staticPage->image ?>"/>
        <div class="container-fluid mt-3">
            <div class="text-center">
                <?php echo img($image_properties); ?>
            </div>
        </div>
    </div>
    <div class="form-group row mb-5 mt-5">
        <label for="video" class="col-3">Vidéo</label>
        <input type="text" class="col-9" name="video" value="<?php echo $single_staticPage->video ?>">
    </div>

    <button type="submit" class="btn btn-danger" name="submit">Valider</button>

    </form>
</div>