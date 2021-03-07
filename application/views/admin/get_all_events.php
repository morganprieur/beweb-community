<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title><?php echo $title; ?></title>
</head>

<body class="container-fluid">

    <h2><?php echo $title; ?></h2>

    <p>
        <a href="<?php echo site_url('admin/create_event'); ?>">
            Créer un événement
        </a>
    </p>
    

    <table class="table table-hover">
        <thead>
            <tr>
                <th>titre</th>
                <th>description</th>
                <th>date</th>
                <th>heure</th>
                <th>image</th>
                <th>lieu</th>
                <th>catégorie</th>
                <th>is_active</th>
                <th>creation_user_id</th>
                <th colspan="5">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!$events): ?>
            <h3>Il n'y a pas d'événements à afficher pour le moment</h3>
        <?php else:
             foreach ($events as $event) : ?>
            <?php 
                $image_properties = array(
                    'src'   => base_url('asset/images/'.$event->event_image),
                    'height'=> '200',
                );
            ?>
                <tr>
                    <td><?php echo $event->title; ?></td>
                    <td><?php echo character_limiter($event->description, 100) ; ?></td>
                    <td><?php echo $event->date; ?></td>
                    <td><?php echo $event->hour; ?></td>
                    <td><?php echo img($image_properties); ?></td>
                    <td><?php echo $event->lieu; ?></td>
                    <td>
                        <ul>
                            <li><?php echo $event->type ?></li>
                        </ul>
                    </td>

                    <td><?php echo ($event->is_active == 1) ? 'oui' : 'non'; ?></td>
                    <td><?php echo $event->username; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/get_one_event/' . $event->event_id); ?>">
                            Voir
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo site_url('admin/edit_event/' . $event->event_id); ?>">
                            Modifier
                        </a>
                    </td>
                    <td>
                        <?php
                        if (($event->date < date("Y-m-d")) && ($event->is_active == 1)) : ?>
                            <a style="color:red" href="<?php echo site_url('admin/archive_event/' . $event->event_id); ?>">
                                Archiver
                            </a>
                        <?php elseif (($event->date >= date("Y-m-d")) && ($event->is_active == 1)) : ?>
                            Actif
                        <?php else : ?>
                            <span style="color:silver">Archivé</span>
                        <?php endif;
                        ?>
                    </td>
                    <td>
                        <a style="color:red" href="<?php echo site_url('admin/delete_event/' . $event->event_id); ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer?');">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; 
            endif; ?>
        </tbody>
    </table>



</body>

</html>