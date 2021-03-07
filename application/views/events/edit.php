<h2><?php echo $pageTitle; ?></h2>

<?php validation_errors(); ?>
<?php echo form_open_multipart('event_controller/update_event/'.$event->event_id); ?>

    <label for="title">Titre de l'événement</label>
    <input type="text" name="title" value="<?php echo $event->title; ?>" />
    
    <br>
    <label for="lieu">Lieu</label>
    <input type="text" name="lieu" value="<?php echo $event->lieu; ?>" />
    
    <br>
    <label for="date">Date</label>
    <input type="text" name="date" placeholder="aaaa-mm-jj" value="<?php echo $event->date; ?>" />
    
    <br>
    <label for="hour">Heure</label>
    <input type="text" name="hour" placeholder="hh:mm:ss" value="<?php echo $event->hour; ?>" />
    
    <br>
    <label for="description">Description</label>
    <input type="text" name="description" />
    
    <br>
    <!--label for="is_validated">Validé ?</!--label>
    <input type="text" name="is_validated" />
    
    <br-->
    <!--<label for="is_active">Actif</label>
    <input type="text" name="is_active" value="<?php // echo $event->is_active; ?>" />
    
    <br>-->
    <label for="creation_user_id">ID Créateur</label>
    <input type="text" name="creation_user_id" value="<?php echo $event->creation_user_id; ?>" />
    <br>

    <br>
    <h3>Choisir la/les categrories</h3>
    <?php foreach ($categories as $category) : ?>
        <input type="checkbox" name="groupe[]" value="<?php echo $category->category_id; ?>">
        <label for="categories"><?php echo $category->type; ?></label><br>
    <?php endforeach; ?>
    <br>
    
    <h3>Choisir la/les technos</h3>
    <?php foreach ($technos as $techno) : ?>
        <input type="checkbox" name="techno[]" value="<?php echo $techno->techno_id; ?>">
        <label for="categories"><?php echo $techno->name; ?></label><br>
    <?php endforeach; ?>

    <p>
    <?php
        $image_properties = array(
            'src'   => base_url('asset/images/'.$event->event_image),
            'max-height'=> '200',
        );
    ?>
    <?php echo img($image_properties); ?>
    </p>
    <label for="userfile">Image</label>
    <input type="file" name="userfile" size="20"/>
    <br />
    
    <hr>
    <input type="submit" value="Enregistrer">
</form>

</body>
</html>
