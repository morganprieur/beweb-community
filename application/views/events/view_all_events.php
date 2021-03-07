<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>


<div class="container">

    <?php if (count($_SESSION) > 1) : ?>
        <a href="<?php echo site_url('events/create'); ?>" class="btn btn-danger m-5">
            Créer un événement
        </a>
    <?php endif ?>

    <div class="row">
        <?php if (!$events) : ?>
            <h3>Il n'y a pas d'événements à afficher pour le moment</h3>
        <?php else : ?>

            <?php foreach ($events as $event) :
                $image_properties = array(
                    'src'   => base_url('asset/images/' . $event->event_image),
                    'height' => '200px',
                );
            ?>

                <div class="card m-4" style="width: 20rem;">
                    <?php echo img($image_properties); ?>
                    <div class="card-body">
                        <h3 class="card-title"><u><?php echo $event->title; ?></u></h3>
                        <p class="card-text"><?php echo character_limiter($event->description, 100); ?></p>
                        <?php if (count($_SESSION) > 1) : ?>
                            <p class="card-text"><u>Date</u> : <?php echo $event->date; ?></p>
                            <p class="card-text"><u>Heure</u> : <?php echo $event->hour; ?></p>
                            <p class="card-text"><u>Lieu</u> : <?php echo $event->lieu; ?></p>
                        <?php endif ?>
                        <p class="card-text"><u>Créateur</u> : <?php echo $event->username; ?></p>
                        <a href="<?php echo site_url('events/view_event/' . $event->event_id); ?>" class="btn btn-danger">Voir</a>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>