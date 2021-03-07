<div class="row">
    <div class="col-8 col col-menu">
        <nav class="navbar-nav shadow p-3 mb-5 bg-white rounded position-fixed ml-5 px-5">
            <?php foreach ($faqs as $faq) : ?>
                <a class="nav-link d-block text-danger " href="<?php echo site_url('static/faq/' . $faq->faq_id) ?>"><?php echo $faq->question ?></a>
            <?php endforeach ?>
        </nav>
    </div>
</div>