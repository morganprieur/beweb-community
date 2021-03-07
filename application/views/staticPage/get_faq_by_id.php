<div class="row mb-3">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $title; ?></h1>
    </div>
</div>


<div class="row">
    <div class="col-2">
        <?php $this->load->view('templates/menu_faq'); ?>
    </div>

    <div class="col-10">
        <div class="container">


            <div class="card ml-4">
                <h4 class="card-header">
                    <?php echo $faq->question ?>
                </h4>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p><?php echo $faq->answer ?></p>
                    </blockquote>
                </div>
            </div>

            <a href="<?php echo site_url('static/faq') ?>" class="btn btn-danger ml-4 mt-5">Retour aux questions</a>
        </div>
    </div>
</div>