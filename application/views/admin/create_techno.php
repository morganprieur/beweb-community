<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="logo">
    </div>
    <div class="col-9 p-0">
        <h1 id="bg-white" class="text-left">Dashboard</h1>
    </div>
</div>

<div id="techno-form" class="mt-5">

<h3 class="mt-5 text-center"><?php echo $pageTitle; ?></h3>

<?php 
    //  form_helper : afficher les erreurs 
    //  et ouvrir le formulaire selon les règles de category_controller/create_category
    echo validation_errors(); 
    echo form_open('techno_controller/create_techno');

    //  import template form
    $this->load->view('templates/form_techno'); 
?>

<!-- menu admin categories -->
<ul id="menu-techno" class="list-group list-group-horizontal">
        <li id="list-group-item">
            <a href="<?php echo site_url('dashboard'); ?>">
                Retour au dashboard
            </a>
        </li>
    </ul>

</div>

