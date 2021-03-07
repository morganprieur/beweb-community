<div class="row mb-3">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $title; ?></h1>
    </div>
</div>

<div class="container">

    <div class="row">
    <?php foreach ($faqs as $faq) : ?>
        <div class="col-sm-6">
            <div class="card border-dark m-3">
                <h5 class="card-header"><?php echo $faq->question ?></h5>
                <div class="card-body text-dark">
                    <p class="card-text"><?php echo word_limiter($faq->answer, 20) ?></p>
                    <a href="<?php echo site_url('static/faq/' . $faq->faq_id) ?>" class="btn btn-danger">Voir plus</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>





</div>