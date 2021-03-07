<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left">Créer un événement</h1>
    </div>
</div>

<div id="category-form" class="mt-5">


    <?php validation_errors(); ?>
    <?php echo form_open_multipart('event_controller/add_event'); ?>

    <p class="mt-4">Les champs obligatoires sont précédés d'une étoile *</p>

    <p>test</p>

    <div class="form-groupe row mb-5 mt-5">
        <label for="title" class="col-3">Titre de l'événement *</label>
        <input type="text" name="title" class="col-9" required />
    </div>

    <div class="form-groupe row mb-5">
        <label for="description" class="col-3">Description *</label>
        <textarea class="col-9" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="form-groupe row mb-5">
        <label for="lieu" class="col-3">Lieu *</label>
        <input type="text" name="lieu" class="col-9" required />
    </div>

    <div class="form-groupe row mb-5">
        <label for="date" class="col-3">Date</label>
        <input type="text" name="date" placeholder="aaaa-mm-jj" class="col-9" />
    </div>

    <div class="form-groupe row mb-5">
        <label for="hour" class="col-3">Heure</label>
        <input type="text" name="hour" placeholder="hh:mm:ss" class="col-9" />
    </div>

    <input type="hidden" name="creation_user_id" class="col-9" value="<?php echo $_SESSION['username'] ?>" />

    <div class="form-groupe row mb-5">
        <label for="userfile" class="col-3">Image</label>
        <input type="file" id="image_upload" onchange="preview_image(event)" name="userfile" size="15" class="col-9 mb-5" />

        <img src="" id="output_image" style="max-width: 200px;">
    </div>
    
    <script type="text/javascript">
        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <div class="form-check">
        <h4 class="mt-5">Choisir la/les categrories</h4>
        <?php foreach ($categories as $category) : ?>
            <input type="checkbox" name="groupe[]" value="<?php echo $category->category_id ?>" class="form-check-input">
            <label for="categories" class="form-check-label"><?php echo $category->type ?></label><br>
        <?php endforeach ?>
    </div>

    <div class="form-check">
        <h4 class="mt-4">Choisir la/les technos</h4>
        <?php foreach ($technos as $techno) : ?>
            <input type="checkbox"  name="techno[]" value="<?php echo $techno->techno_id ?>" class="form-check-input">
            <label for="techno" class="form-check-label"><?php echo $techno->name ?></label><br>
        <?php endforeach ?>
    </div>

    <button type="submit" class="btn btn-danger mt-4" name="submit">Enregister</button>
    </form>

</div>

