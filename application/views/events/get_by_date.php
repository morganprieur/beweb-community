<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bg-white" class="text-left">Dashboard</h1>
    </div>
</div>

<div class="container">
    <table class="table table-striped mb-2 mt-5">
        <thead>
            <tr>
                <th>INTITULE</th>
                <th>DATE</th>
                <th>HEURE</th>
                <th>LIEU</th>
                <th>CREATEUR</th>
                <th>ARCHIVER</th>
                <th>CONSULTER</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$events) : ?>
                <h3>Il n'y a pas d'événements à afficher pour le moment</h3>
                <?php else :

                foreach ($events as $event) : ?>
                    <tr>
                        <td><?php echo $event->title; ?></td>
                        <td><?php echo $event->date; ?></td>
                        <td><?php echo $event->hour; ?></td>
                        <td><?php echo $event->lieu; ?></td>
                        <td><?php echo $event->username; ?></td>

                        <?php if ($event->is_active == 1) : ?>
                            <td><a href="<?php echo site_url("admin/archiver_event/" . $event->event_id); ?>" onclick="return confirm('Etes vous sur de vouloir l\'archiver ?')"><span class="btn btn-outline-danger">Archiver</span></a></td>
                        <?php elseif ($event->is_active == 0) : ?>
                            <td><span class="btn btn-secondary">Dépassé</span></td>
                        <?php endif ?>

                        <td>
                            <a href="<?php echo site_url('events/view_event/' . $event->event_id); ?>"><span class="btn btn-outline-info">Voir</span></a>
                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>
        </tbody>
    </table>
    <a href="<?php echo site_url('dashboard') ?>" class="btn btn-danger my-3">Retour dashboard</a>

</div>