<div class="row">
    <div class="col-3 p-0">
        <img class="w-100 h-100" src="<?php echo base_url('asset/images/BWB_background_accueil.png') ?>" alt="">
    </div>
    <div class="col-9 p-0">
        <h1 id="bandeau" class="text-left"><?php echo $pageTitle; ?></h1>
    </div>
</div>

<img src="https://via.placeholder.com/1680x550?text=image+ou+video+de+l'association" alt="">

<div class="container">
    <div class="row">
        <div class="col-8">
            <h3 class="mt-5">PRESENTATION DE L'ASSOCIATION</h3>
            <p class="mt-3 text-justify">Et quia Mesopotamiae tractus omnes crebro inquietari sueti praetenturis et stationibus servabantur agrariis, laevorsum flexo itinere Osdroenae subsederat extimas partes, novum parumque aliquando temptatum commentum adgressus. quod si impetrasset, fulminis modo cuncta vastarat. erat autem quod cogitabat huius modi. Altera sententia est, quae definit amicitiam paribus officiis ac voluntatibus. Hoc quidem est nimis exigue et exiliter ad calculos vocare amicitiam, ut par sit ratio acceptorum et datorum. Divitior mihi et affluentior videtur esse vera amicitia nec observare restricte, ne plus reddat quam acceperit; neque enim verendum est, ne quid excidat, aut ne quid in terram defluat, aut ne plus aequo quid in amicitiam congeratur. Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.Haec dum oriens diu perferret, caeli reserato tepore Constantius consulatu suo septies et Caesaris ter egressus Arelate Valentiam petit, in Gundomadum et Vadomarium fratres Alamannorum reges arma moturus, quorum crebris excursibus vastabantur confines limitibus terrae Gallorum. Proinde concepta rabie saeviore, quam desperatio incendebat et fames, amplificatis viribus ardore incohibili in excidium urbium matris Seleuciae efferebantur, quam comes tuebatur Castricius tresque legiones bellicis sudoribus induratae.</p>
        </div>

        <div class="col-3 offset-1">
            <h3 class="mt-5">LES DOCUMENTS</h3>
            <?php foreach ($documents as $document) : ?>
                <div class="row">
                    <a href="<?php echo site_url('static/getById/' . $document->documentId) ?>" class="btn btn-danger my-2"><?php echo $document->title ?></a>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="row">
        <h3 class="m-5">LES MEMBRES</h3>
    </div>
    <div class="row">
        <?php foreach ($users as $user) : ?>

            <div class="card m-4" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo base_url('asset/images/' . $user->user_image) ?>" alt="Avatar">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user->username ?></h5>
                    <p class="card-text"><?php echo $user->promo ?></p>
                </div>
            </div>
        <?php endforeach ?>

    </div>

</div>