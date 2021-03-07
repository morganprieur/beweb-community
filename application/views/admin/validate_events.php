<!--DOCTYPE html>

    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            padding: 2px;
        }
    </style-->

<h2><?php echo $title; ?></h2>



<table class="table table-hover">
    <thead>
        <th>titre</th>
        <th>description</th>
        <th>date</th>
        <th>heure</th>
        <th>image</th>
        <th>lieu</th>
        <!--<th>is_active</th>-->
        <th>creation_user_id</th>
        <th colspan="4">Actions</th>
      </tr>
    </thead>

    <?php if(!$events): ?>
        <h3>Il n'y a pas d'événements à valider</h3>

    <?php else:
        foreach($events as $event):
            $image_properties = array(
                'src'   => base_url('asset/images/'.$event->event_image),
                'height'=> '200',
            );
        ?>
        <tbody>
            <td><?php echo $event->title; ?></td>
            <td><?php echo character_limiter($event->description, 100); ?></td>
            <td><?php echo $event->date; ?></td>
            <td><?php echo $event->hour; ?></td>
            <td><?php echo img($image_properties); ?></td>
            <td><?php echo $event->lieu; ?></td>
            <!--<td><?php // echo ($event->is_active == 1)?'oui':'non'; ?></td>-->
            <td><?php echo $event->username; ?></td>
            <td>
                <a href="<?php echo site_url('admin/get_one_event/'.$event->event_id); ?>">
                    Voir
                </a>
            </td><td>
                <a href="<?php echo site_url('admin/edit_event/'.$event->event_id); ?>">
                    Modifier
                </a>
            </td><td>
                <?php if($event->is_validated == 0): ?>
                    <a style="color:green" href="<?php echo site_url('admin/validate/'.$event->event_id); ?>">
                        Valider
                    </a>
                <?php else: ?> 
                        <span>OK</span>
                <?php endif; ?>
            </td><td>
                <?php if(($event->date < date("Y-m-d")) && ($event->is_active == 1)): ?>
                    <a style="color:red" href="<?php echo site_url('admin/archive/'.$event->event_id); ?>">
                        Archiver
                    </a>
                <?php elseif(($event->event_date > date("Y-m-d")) && ($event->is_active == 1)): ?>
                    Actif
                <?php else: ?>
                    <span style="color:silver">Archivé</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>

        <?php endif; ?>
        </tbody>
    </table>

    <h3>
        <a href="<?php echo site_url('events/view_all_events') ?>">
        </a>
    </h3>

</body>
</html>
