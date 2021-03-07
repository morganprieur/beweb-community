<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bg-white" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-2">
        <?php $this->load->view('templates/menu_dashboard'); ?>
    </div>

    <div class="col-10">
        <div class="container">

            <div class="row my-5">
                <div class="col-sm-6">
                    <div class="card h-100 border border-danger" id="event">
                        <div class="card-body">
                            <h4 class="card-title">Evénement(s) en cours</h4>
                            <p class="card-text"><span class="font-weight-bold h3"><?php echo count($events_valid) ?></span> événement(s) en cours.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card h-100 border border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Evénement(s) en attente</h5>
                            <p class="card-text"><span class="font-weight-bold h3"><?php echo count($events_not_valid) ?></span> événement(s) en attente(s) de validation.</p>
                        </div>
                    </div>
                </div>
            </div>


            <h1 class="mt-5">Moderation des événements</h1>
            <table class="table table-striped mb-2">
                <thead>
                    <tr>
                        <th>INTITULE</th>
                        <th>DATE</th>
                        <th>HEURE</th>
                        <th>LIEU</th>
                        <th>IMAGE</th>
                        <th>CREATEUR</th>
                        <th>CATEGORIE</th>
                        <th>TECHNOS</th>
                        <th>VALIDER</th>
                        <th>ARCHIVER</th>
                        <th>VOIR</th>
                        <th>MODIFIER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$events) : ?>
                        <h3>Il n'y a pas d'événements à afficher pour le moment</h3>
                        <?php else :

                        foreach ($events as $event) : ?>
                            <?php
                            $image_properties = array(
                                'src'   => base_url('asset/images/' . $event->event_image),
                                'height' => '50px',
                            );
                            ?>
                            <tr>
                                <td><?php echo $event->title; ?></td>
                                <td><?php echo $event->date; ?></td>
                                <td><?php echo $event->hour; ?></td>
                                <td><?php echo $event->lieu; ?></td>
                                <td><?php echo img($image_properties); ?></td>
                                <td><?php echo $event->username; ?></td>
                                <td>
                                    <ul>
                                        <?php foreach ($categories as $category) : ?>
                                            <?php foreach ($category as $cat) : ?>
                                                <?php if ($cat->event_id === $event->event_id) : ?>
                                                    <li><?php echo $cat->type;  ?></li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endforeach ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <?php foreach ($technos as $techno) : ?>
                                            <?php foreach ($techno as $tech) : ?>
                                                <?php if ($tech->event_id === $event->event_id) : ?>
                                                    <li><?php echo $tech->name; ?></li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endforeach ?>
                                    </ul>
                                </td>

                                <?php if ($event->is_validated == 0) : ?>
                                    <td><a href="<?php echo site_url("admin/valider_event/" . $event->event_id); ?>" onclick="return confirm('Etes vous sur de vouloir valider l\'événement ?')"><span class="btn btn-outline-success">Valider</span></a></td>
                                <?php elseif ($event->is_validated == 1) : ?>
                                    <td><a href="<?php echo site_url("admin/refuser_event/" . $event->event_id); ?>" onclick="return confirm('Etes vous sur de vouloir refuser l\'événement ?')"><span class="btn btn-outline-danger">Refuser</span></a></td>
                                <?php endif ?>

                                <?php if ($event->is_active == 0) : ?>
                                    <td><a href="<?php echo site_url("admin/activer_event/" . $event->event_id); ?>" onclick="return confirm('Etes vous sur de vouloir le remettre actif ?')"><span class="btn btn-outline-success">Rendre actif</span></a></td>
                                <?php elseif ($event->is_active == 1) : ?>
                                    <td><a href="<?php echo site_url("admin/archiver_event/" . $event->event_id); ?>" onclick="return confirm('Etes vous sur de vouloir l\'archiver ?')"><span class="btn btn-outline-danger">Archiver</span></a></td>
                                <?php endif ?>

                                <td>
                                    <a href="<?php echo site_url('events/view_event/' . $event->event_id); ?>"><span class="btn btn-outline-info">Voir</span></a>
                                </td>

                                <td>
                                    <a href="<?php echo site_url('admin/edit_event/' . $event->event_id); ?>"><span class="btn btn-outline-info">Modifier</span></a>
                                </td>
                            </tr>
                    <?php endforeach;
                    endif; ?>

                </tbody>
            </table>
            <a href="<?php echo site_url('get_event_archive') ?>" class="btn btn-danger mt-3 mb-5">Voir les événements archivés</a>

            <hr>
            <hr>


            <div class="row my-5">
                <div class="col-sm-6" id="user">
                    <div class="card h-100 border border-danger">
                        <div class="card-body">
                            <h4 class="card-title">Membre(s)</h4>
                            <p class="card-text"><span class="font-weight-bold h3"><?php echo count($user_activ) ?></span> personne(s) actif(s).</p>
                        </div>
                    </div>
                </div>

            </div>

            <h1 class="mt-4">Liste des utilisateurs</h1>
            <table class="table table-striped mb-5">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>MAIL</th>
                        <th>PSEUDO</th>
                        <th>PROMO</th>
                        <th>ROLE</th>
                        <th>ACTIFS</th>
                        <th>ACTION</th>
                        <th>ROLE</th>
                        <th>MODIFIER</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role) : ?>
                        <tr>
                            <td><?php echo $role->lastname ?></td>
                            <td><?php echo $role->firstname ?></td>
                            <td><?php echo $role->mail ?></td>
                            <td><?php echo $role->username ?></td>
                            <td><?php echo $role->promo ?></td>
                            <td><?php echo $role->type ?></td>
                            <td><?php if ($role->is_active === '1') : ?>X<?php endif ?></td>

                            <?php if ($role->is_active == 0) : ?>
                                <td><a href="<?php echo site_url("admin/actif_user/" . $role->user_id); ?>" onclick="return confirm('Etes vous sur de vouloir le remettre actif ?')"><span class="btn btn-outline-success">Rendre actif</span></a></td>
                            <?php elseif ($role->is_active == 1) : ?>
                                <td><a href="<?php echo site_url("admin/archive_user/" . $role->user_id); ?>" onclick="return confirm('Etes vous sur de vouloir l\'archiver ?')"><span class="btn btn-outline-danger">Archiver</span></a></td>
                            <?php endif ?>

                            <?php if ($role->fk_roleId == 1) : ?>
                                <td><a href="<?php echo site_url("admin/member_user/" . $role->user_id); ?>" onclick="return confirm('Etes vous sur de vouloir passer l\'utilisateur en admin ?')"><span class="btn btn-outline-success">Passer à admin</span></a></td>
                            <?php elseif ($role->fk_roleId == 2) : ?>
                                <td><a href="<?php echo site_url("admin/admin_user/" . $role->user_id); ?>" onclick="return confirm('Etes vous sur de vouloir passer l\'utilisateur en membre ?')"><span class="btn btn-outline-danger">Passer à membre</span></a></td>
                            <?php endif ?>

                            <td><a href="<?php echo site_url("modification/" . $role->user_id); ?>"><span class="btn btn-outline-info">Modifier</span></a></td>

                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
            <hr>
            <hr>


            <h1 class="mt-5" id="cat">Liste des catégories</h1>
            <a href="<?php echo site_url('admin/create_category') ?>" class="btn btn-danger my-3">Ajouter une categorie</a>
            <table class="table table-striped mb-5 mt-2">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>DESCRIPTION</th>
                        <th>MODIFIER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cats as $cat) : ?>
                        <tr>
                            <td><?php echo $cat->type ?></td>
                            <td><?php echo $cat->description ?></td>
                            <td><a href="<?php echo site_url('admin/update_category/' . $cat->category_id) ?>" class="btn btn-outline-info">Modifier</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <hr>
            <hr>


            <h1 class="mt-5" id="tech">Liste des technos</h1>
            <a href="<?php echo site_url('admin/create_techno') ?>" class="btn btn-danger my-3">Ajouter une techno</a>
            <table class="table table-striped mb-5 mt-2">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>DESCRIPTION</th>
                        <th>FRONT</th>
                        <th>BACK</th>
                        <th>MODIFIER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($techs as $tech) : ?>
                        <tr>
                            <td><?php echo $tech->name ?></td>
                            <td><?php echo $tech->description ?></td>
                            <td><?php if ($tech->front === '1') : ?>X<?php endif ?></td>
                            <td><?php if ($tech->back === '1') : ?>X<?php endif ?></td>
                            <td><a href="<?php echo site_url('admin/update_techno/' . $tech->techno_id) ?>" class="btn btn-outline-info">Modifier</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>


            <hr>
            <hr>

            <h1 class="mt-5" id="faq">FAQ</h1>
            <a href="<?php echo site_url('admin/create_faq') ?>" class="btn btn-danger my-3">Ajouter une question</a>
            <table class="table table-striped mb-5 mt-2">
                <thead>
                    <tr>
                        <th>QUESTION</th>
                        <th>REPONSE</th>
                        <th>MODIFIER</th>
                        <th>SUPPRIMER</th>
                        <th>VOIR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($faqs as $faq) : ?>
                        <tr>
                            <td><?php echo $faq->question ?></td>
                            <td><?php echo $faq->answer ?></td>
                            <td><a href="<?php echo site_url('admin/update_faq/' . $faq->faq_id) ?>" class="btn btn-outline-info">Modifier</a></td>
                            <td><a href="<?php echo site_url('static/delete_faq/' . $faq->faq_id) ?>" class="btn btn-outline-danger">Supprimer</a></td>
                            <td><a href="<?php echo site_url('static/faq/' . $faq->faq_id) ?>" class="btn btn-outline-info">Voir</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <hr>
            <hr>

            <h1 class="mt-5" id="static">Pages diverses</h1>
            <a href="<?php echo site_url('static/create') ?>" class="btn btn-danger my-3">Ajouter un document</a>
            <table class="table table-striped mb-5 mt-2">
                <thead>
                    <tr>
                        <th>TITRE</th>
                        <th>CONTENU</th>
                        <th>LIEN</th>
                        <th>IMAGE</th>
                        <th>VIDEO</th>
                        <th>MODIFIER</th>
                        <th>SUPPRIMER</th>
                        <th>VOIR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statics as $static) : ?>
                        <tr>
                            <td><?php echo $static->title ?></td>
                            <td><?php echo character_limiter($static->text, 100) ?></td>
                            <td><?php echo $static->lien_doc ?></td>
                            <td><?php echo $static->image ?></td>
                            <td><?php echo $static->video ?></td>
                            <td><a href="<?php echo site_url('static/update/' . $static->documentId) ?>" class="btn btn-outline-success">Modifier</a></td>
                            <td><a href="<?php echo site_url('static/delete/' . $static->documentId) ?>" class="btn btn-outline-danger">Supprimer</a></td>
                            <td><a href="<?php echo site_url('static/getById/' . $static->documentId) ?>" class="btn btn-outline-info">Voir</a></td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>


        </div>
    </div>
</div>