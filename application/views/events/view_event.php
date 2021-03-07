<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $event->title; ?></h1>
    </div>
</div>


<?php
$image_properties = array(
    'src'   => base_url('asset/images/' . $event->event_image),
    'width' => '100%',
);
?>
<div class="container">

<?php echo img($image_properties); ?>

    <p class="mt-5 text-justify">description : <?php echo $event->description; ?></p>
    <?php if(count($_SESSION) > 1): ?>
        <p><u>Date</u> : <?php echo $event->date; ?></p>
        <p><u>Heure</u> : <?php echo $event->hour; ?></p>
        <p><u>Lieu</u> : <?php echo $event->lieu; ?></p>
    <?php endif ?>
    <p><u>Catégories</u> :
        <ul> <?php foreach ($categs as $categ) : ?>
                <?php echo '<li>' . $categ->type . '</li>'; ?>
            <?php endforeach; ?>
        </ul>
    </p>
    <p><u>Technos</u> :
        <ul>
            <?php foreach ($technos as $techno) : ?>
                <li>
                    <?php echo $techno->name; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </p>
    <p><u>Créé par</u> : <?php echo $event->username; ?></p>

    <a href="<?php echo site_url('evenements'); ?>" class="btn btn-info m-4">Tous les événements</a>

</div>