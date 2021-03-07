<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap-4.3.1-dist/js/bootstrap.js" rel="stylesheet" media="screen" type="text/css" />
    <link href="bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="icon" type="image/ico" href="<?php echo base_url(('favicon.ico')); ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/css/style.css'); ?> ">

    <title><?php echo title($pageTitle); ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div>
            <h3><?php 
                if (count($_SESSION) > 1) :
                      echo 'Bonjour '. $_SESSION['username'];
                else:
                    echo 'Bonjour et bienvenue'; 
                endif;  ?></h3>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-lg-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('association') ?>">Association</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('evenements') ?>">Evenements</a>
                </li>
                <?php if (count($_SESSION) > 1) : ?>
                    <?php if ($_SESSION['role'] === 'member') : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo site_url('mon_compte') ?>">Mon compte</a>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'admin') : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo site_url('mon_compte') ?>">Mon compte</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                        </li>
                    <?php endif ?>
                    <a href="<?php echo site_url('deconnexion') ?>" class="btn btn-danger">Deconnecter</a>

                <?php else : ?>
                    <a href="<?php echo site_url('connexion') ?>" class="btn btn-danger mx-2">Connexion</a>
                    <a href="<?php echo site_url('inscription') ?>" class="btn btn-info">Inscription</a>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    