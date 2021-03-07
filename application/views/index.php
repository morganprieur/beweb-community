<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $title; ?></h1>
    </div>
</div>


<div class="container">
    <div class="row">
        <h3 class="m-4">NOS PROCHAINS EVENEMENTS</h3>
    </div>

    <?php if (count($_SESSION) > 1) : ?>
        <a href="<?php echo site_url('events/create'); ?>" class="btn btn-danger m-3">Créer un événement</a>
    <?php endif ?>

    <div class="row">

        <?php foreach ($events as $event) : ?>

            <?php
            $image_properties = array(
                'src'   => base_url('asset/images/' . $event->event_image),
                'height' => '150px',
            );
            ?>

            <div class="card m-4" style="width: 18rem;">
                <?php echo img($image_properties); ?>
                <div class="card-body">
                    <h3 class="card-title bold"><?php echo $event->title ?></h3>
                    <p class="card-text">
                        <h5>Catégories :</h5>
                        <ul>
                            <?php foreach ($cats as $category) : ?>
                                <?php foreach ($category as $cat) : ?>
                                    <?php if ($cat->event_id === $event->event_id) : ?>
                                        <li><?php echo $cat->type;  ?></li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </ul>
                    </p>
                    <p class="card-text">
                        <h5>Technos :</h5>
                        <?php if ($technos < 0) : ?>
                            <ul>
                                <li>Pas de techno renseignée</li>
                            </ul>
                        <?php else : ?>
                            <ul>
                                <?php foreach ($technos as $techno) : ?>
                                    <?php foreach ($techno as $tech) : ?>
                                        <?php if ($tech->event_id === $event->event_id) : ?>
                                            <li><?php echo $tech->name; ?></li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>
                    </p>
                    <?php if (count($_SESSION) > 1) : ?>
                        <p class="card-text"><?php echo $event->date; ?></p>
                        <p class="card-text"><?php echo $event->lieu; ?></p>
                    <?php endif ?>
                    <p class="card-text"><?php echo character_limiter($event->description, 50); ?></p>

                    <a href="<?php echo site_url('events/view_event/' . $event->event_id); ?>" class="btn btn-info">Consulter</a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (count($_SESSION) > 1) : ?>
            <a href="<?php echo site_url('events/create'); ?>" class="btn btn-danger m-3">Créer un événement</a>
        <?php endif ?>

        </section>


    </div>