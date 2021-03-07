
<?php foreach ($users as $user): ?>

    <?php
        $image_properties = array(
            'src'   => base_url('asset/images/'.$user->user_image),
            'height'=> '200',
        );
    ?>


<p>ID : <?php echo $user->user_id; ?></p>
<p>nom : <?php echo $user->lastname ?></p>
<p>prenom : <?php echo $user->firstname ?></p>
<p>mail : <?php echo $user->mail ?></p>
<p>pseudo : <?php echo $user->username ?></p>
<p>passwd : <?php echo $user->password ?></p>
<p>image : </p>
<img src="<?php echo ($user->user_image === "") ? base_url('asset/images/logo_small.png') : base_url('asset/images/'.$user->user_image); ?>" height="200px">
<?php // echo img($image_properties); ?>
<p>promo : <?php echo $user->promo ?></p>

<br><br>
<?php endforeach ?>

