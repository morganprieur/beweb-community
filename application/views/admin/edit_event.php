<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bg-white" class="text-left">Dashboard</h1>
    </div>
</div>


<div id="category-form" class="mt-5">

    <h3><?php echo $title . $event->event_id; ?></h3>

    <?php validation_errors(); ?>
    <?php echo form_open_multipart('admin_controller/update_event/' . $event->event_id); ?>

    <div class="form-group row mb-5">
        <label for="title" class="col-3">Titre de l'événement</label>
        <input type="text" class="col-9" name="title" value="<?php echo $event->title; ?>" />
    </div>

    <div class="form-group row mb-5">
        <label for="lieu" class="col-3">Lieu</label>
        <input type="text" class="col-9" name="lieu" value="<?php echo $event->lieu; ?>" />
    </div>

    <div class="form-group row mb-5">
        <label for="date" class="col-3">Date</label>
        <input type="text" class="col-9" name="date" value="<?php echo $event->date; ?>" />
    </div>

    <div class="form-group row mb-5">
        <label for="hour" class="col-3">Heure</label>
        <input type="text" class="col-9" name="hour" value="<?php echo $event->hour; ?>" />
    </div>

    <div class="form-group row mb-5">
        <label for="description" class="col-3">Description</label>
        <input type="text" class="col-9" name="description" value="<?php echo $event->description; ?>" />
    </div>


    <div class="form-check">
        <h4 class="mt-5">Choisir la/les categrories</h4>
        <?php foreach ($categories as $category) : ?>
                <?php if (!empty($cat_event) && array_search($category->type, $cat_event)) : ?>
                    <input type="checkbox" name="groupe[]" value="<?php echo $category->category_id; ?>" class="form-check-input" checked>
                    <label for="groupe[]" class="form-check-label"><?php echo $category->type; ?></label><br>
                <?php else : ?>
                    <input type="checkbox" name="groupe[]" value="<?php echo $category->category_id; ?>" class="form-check-input">
                    <label for="groupe[]" class="form-check-label"><?php echo $category->type; ?></label><br>
                <?php endif ?>
        <?php endforeach; ?>
    </div>

    <div class="form-check">
        <h4 class="mt-4">Choisir la/les technos</h4>
        <?php foreach ($technos as $techno) : ?>
            <input type="checkbox" name="tech[]" value="<?php echo $techno->techno_id ?>" class="form-check-input">
            <label for="techno" class="form-check-label"><?php echo $techno->name ?></label><br>
        <?php endforeach ?>
    </div>

    <p class="mt-3">
        <?php
        $image_properties = array(
            'src'   => base_url('asset/images/' . $event->event_image),
            'height' => '200',
        );
        ?>
        <?php echo img($image_properties); ?>
    </p>

    <hr>
    <input type="submit" value="Enregistrer" class="btn btn-danger mt-4">
    </form>

</div>

</body>

</html>