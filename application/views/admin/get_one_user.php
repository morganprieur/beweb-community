
<?php // echo $num_sess; ?>

<?php
    echo 
    '<br>session :
    <br>username : '.$username
    .'<br>role : '.$role
    .'<hr>';
?>

<p>nom : <?php echo $user->lastname ?></p>
<p>prenom : <?php echo $user->firstname ?></p>
<p>mail : <?php echo $user->mail ?></p>
<p>pseudo : <?php echo $user->username ?></p>
<p>passwd : <?php echo $user->password ?></p>
<p>image : </p>
<img src="<?php echo base_url('asset/images/' . $user->user_image) ?>" alt=""> 
<p>promo : <?php echo $user->promo ?>

<p>techno : </p>
<?php foreach ($technos as $techno): ?>
<ul>
    <li><?php echo $techno->name ?></li>
</ul>    
<?php endforeach ?>

