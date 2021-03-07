<div class="row mb-3">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $document->title ?></h1>
    </div>
</div>


<div class="row">
    <div class="col-2">
        <?php $this->load->view('templates/menu_documents'); ?>
    </div>
    
    
    <div class="col-10">
        <div class="container">
            <?php
            $image_properties = array(
                'src'   => base_url('asset/images/' . $document->image),
                'width' => '50%',
            );
            ?>

            <div class="container-fluid">
                <div class="text-center">
                    <span><?php echo img($image_properties); ?></span>
                </div>
            </div>

            <p class="text-justify mt-5"><?php echo $document->text ?></p>
            <p><?php echo $document->lien_doc ?></p>
            <p><?php echo $document->video ?></p>

            <a href="<?php echo site_url('static/getAll') ?>" class="btn btn-danger mt-5">Retour aux documents</a>
            <?php if ($_SESSION['role'] === 'admin') : ?>
                <a href="<?php echo site_url('dashboard') ?>" class="btn btn-info mt-5">Retour au dashboard</a>
            <?php endif ?>
        </div>
    </div>
</div>