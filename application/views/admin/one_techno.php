

<h3><?php echo $pageTitle.' '.$techno->techno_id; ?></h3>

<div id="techno">

    <div class="row mb-5" style="margin: 0 auto; width: 85%;">
        <div class="card border-dark m-3 text-center " style="width: 15rem;">
            <div class="card-header bg-danger text-light">
                <?php echo $techno->name; ?>
            </div>
            <div class="card-body text-dark">
                <!-- h5 class="card-title">Dark card title</!-->
                <p class="card-text">
                    <?php echo $techno->description; ?>
                </p>
            </div>
            <div class="card-footer bg-danger text-light p-0">
                <a href="<?php echo site_url('admin/update_techno/'.$techno->techno_id); ?>">
                    Modifier
                </a>
            </div>
        </div>
    </div>


    <ul id="menu-categ" class="list-group list-group-horizontal">
        <li class="list-group-item p-0">
            <a href="<?php echo site_url('admin/all_technos'); ?>">
                Retour à toutes les technos
            </a>
        </li>
        <li class="list-group-item p-0">
            <a href="<?php echo site_url('dashboard'); ?>">
                Retour au dashboard
            </a>
        </li>
    </ul>

</div>







