<div class="row mb-3">
   <div class="col-3 p-0">
      <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="">
   </div>
   <div class="col-9 p-0">
      <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
   </div>
</div>



<div class="container">

   <div class="row">
    <?php foreach ($documents as $document) : ?>
        <div class="col-sm-6">
            <div class="card border-dark m-3">
                <h5 class="card-header"><?php echo $document->title ?></h5>
                <div class="card-body text-dark">
                    <p class="card-text"><?php echo word_limiter($document->text, 20) ?></p>
                    <a href="<?php echo site_url('static/getById/' . $document->documentId) ?>" class="btn btn-danger">Voir plus</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>

</div>