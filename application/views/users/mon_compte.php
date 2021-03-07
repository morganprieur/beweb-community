<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left">Mon compte</h1>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <?php $this->load->view('templates/menu_member'); ?>
    </div>



    <div class="col-8">
        <div class="container">

            <h3 class="mt-4" id="creer">Evénements créés</h3>
            <?php if (!$events) : ?>
                <h3 class="mt-4">Vous n'avez pas encore créé d'événement.</h3>
            <?php else : ?>

                <div class="row">
                    <?php foreach ($events as $event) :
                        $image_properties = array(
                            'src'   => base_url('asset/images/' . $event->event_image),
                            'height' => '150px',
                            'width' => '100%'
                        );
                    ?>

                        <div class="card m-4" style="width: 15rem;">
                            <?php echo img($image_properties); ?>
                            <div class="card-body">
                                <h5 class="card-title"><u><?php echo $event->title; ?></u></h5>
                                <p class="card-text"><u>Date</u> : <?php echo $event->date; ?></p>
                                <p class="card-text"><u>Lieu</u> : <?php echo $event->lieu; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?php echo site_url('events/create'); ?>" class="btn btn-danger m-3">Créer un événement</a>

            <?php endif; ?>
            <hr>
            <hr>


            <h3 class="my-4" id="profil">Editer mon profil</h3>

            <div class="row">
                <div class="col-6">
                    <?php $image_properties = array(
                        'src'   => base_url('asset/images/' . $user->user_image),
                        'height' => '150px',
                    ); ?>

                    <?php echo img($image_properties); ?>
                    <p class="mt-3"><u>Pseudo Slack</u> : <?php echo $user->username ?></p>
                    <p><u>Nom</u> : <?php echo $user->lastname ?></p>
                    <p><u>Prénom</u> : <?php echo $user->firstname ?></p>
                    <p><u>Mail</u> : <?php echo $user->mail ?></p>
                    <p><u>Linkedin</u> : <?php echo $user->linkedin ?></p>
                </div>
                <div class="col-6">
                    <a href="<?php echo site_url('modification/' . $user->user_id); ?>" class="btn btn-danger m-3">Modifier mon profil</a>
                </div>
            </div>
            <hr>
            <hr>


            <h3 class="my-4" id="technos">Technos préférées</h3>
            <div class="row">
                <?php if (empty($technos)) : ?>
                    <div class="col-6">
                        <p>Vous n'avez pas de technos préférées</p>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo site_url('modif_techno'); ?>" class="btn btn-danger m-3">Ajouter une techno</a>
                    </div>

                <?php else : ?>
                    <div class="col-6">
                        <?php foreach ($technos as $techno) : ?>
                            <ul>
                                <li><?php echo $techno->name ?></li>
                            </ul>
                        <?php endforeach ?>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo site_url('modif_techno'); ?>" class="btn btn-danger m-3">Modifier mes technos</a>
                    </div>
                <?php endif ?>
            </div>
            <hr>
            <hr>


            <h3 class="my-4" id="passwd">Modifier mot de passe</h3>
            <p class="my-4">Les champs obligatoires sont précédés d'une étoile *</p>


            <?php echo validation_errors(); ?>
            <?php echo form_open('monCompte_controller/update_password'); ?>

            <div class="form-group">
                <label for="password_actuel">Mot de passe actuel *</label>
                <input type="password" class="form-control" name="password_actuel" required>
            </div>
            <div class="form-group">
                <label for="password_new">Nouveau mot de passe *</label>
                <input type="password" class="form-control" name="password_new" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirmer nouveau mot de passe *</label>
                <input type="password" class="form-control" name="password_confirm" required>
            </div>

            <button type="submit" class="btn btn-danger mb-3" name="submit">Valider</button>
            <hr>
            <hr>


            <h3 class="my-4" id="delete">Supprimer mon compte</h3>
            <div class="row">
                <div class="col-6">
                    <p>Supprimer mon compte</p>
                </div>
                <div class="col-6">
                    <a href="<?php echo site_url('archiver_user'); ?>" class="btn btn-danger m-3">Supprimer</a>
                </div>
            </div>

        </div>
    </div>