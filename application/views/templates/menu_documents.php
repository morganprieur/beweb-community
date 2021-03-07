<div class="row">
    <div class="col-8 col col-menu">
        <nav class="navbar-nav shadow p-3 mb-5 bg-white rounded position-fixed ml-5 px-5">
            <?php foreach ($docs as $doc) : ?>
                <a class="nav-link d-block text-danger " href="<?php echo site_url('static/getById/' . $doc->documentId) ?>"><?php echo $doc->title ?></a>
            <?php endforeach ?>
        </nav>
    </div>
</div>