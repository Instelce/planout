<?php

/** @var $this \app\core\View */
/** @var $user \app\models\User */


$url = $_ENV['DOMAIN'] . "/users/activate?token=" . $user->activation_hash;
?>

<h3>Welcome <?php echo $user->username ?></h3>

<p>
    Click the following link to activate your account: <a href="<?php echo $url ?>">
        <?php echo $url ?>
    </a>.
</p>
