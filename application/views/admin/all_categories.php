
<h3><?php echo $pageTitle; ?></h3>

<div id="category">

    <div class="row mb-5" style="margin: 0 auto; width: 85%;">
        <?php foreach($categories as $category): ?>
            
        <div class="card border-dark m-3 text-center " style="width: 15rem;">
            <div class="card-header bg-danger text-light">
                <?php echo $category->type; ?>
            </div>
            <div class="card-body text-dark">
                <!-- h5 class="card-title">Dark card title</!-->
                <p class="card-text"><?php echo character_limiter($category->description, 50); ?></p>
            </div>
            <div class="card-footer p-0 bg-danger text-light">
                <ul>
                    <li>
                        <a href="<?php echo site_url('admin/get_one_category/'.$category->category_id); ?>">
                            Voir
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/update_category/'.$category->category_id); ?>">
                            Modifier
                        </a>
                    </li>
                </ul>
                
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <ul id="menu-categ" class="list-group list-group-horizontal">
        
        <li class="list-group-item p-0">
            <a href="<?php echo site_url('dashboard'); ?>">
                Retour au dashboard
            </a>
        </li>

        <li class="list-group-item p-0">
            <a href="<?php echo site_url('admin/create_category'); ?>">
                Nouvelle catégorie
            </a>
        </li>

    </ul>
    
</div>




