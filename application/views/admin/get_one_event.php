

<h2><?php echo $title; ?></h2>

<?php 
    $image_properties = array(
        'src'   => base_url('asset/images/'.$event->event_image),
        'height'=> '200',
    );
?>

<p>titre : <?php echo $event->title; ?></p>
<p>description : <?php echo $event->description; ?></p>
<p>date : <?php echo $event->date; ?></p>
<p>heure : <?php echo $event->hour; ?></p>
<p>image : <?php echo img($image_properties); ?></p>
<p>lieu : <?php echo $event->lieu; ?></p>
<p>catégories :
    <ul> <?php foreach($categs as $categ): ?>
        <li><?php echo $categ->type; ?> </li>
    <?php endforeach; ?>
</ul>
</p>
<p>technos :
    <ul>
        <?php foreach($technos as $techno): ?>
            <li><?php echo $techno->name; ?></li>
        <?php endforeach; ?>
    </ul>
</p>
<p>actif : <?php echo ($event->is_active == 1) ? 'oui' : 'non'; ?></p>
<p>créé par : <?php echo $event->username; ?></p>
<p>
    <a href="<?php echo site_url('admin/edit_event/'.$event->event_id); ?>">
        Modifier
    </a>
&nbsp;
    <a style="color:red" href="<?php echo site_url('admin/delete_event/'.$event->event_id); ?>">
        Supprimer
    </a>
</p>    

    
</body>
</html>

