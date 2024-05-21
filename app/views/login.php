<?php
/** @var $model \app\models\LoginForm */
/** @var $this \app\core\View */

$this->title = "Connexion";
?>


<div class="page-form">
    <h2 class="mb-2">Connexion</h2>
    <div class="w-half">
        <?php $form = \app\core\form\Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordField() ?>
        <button type="submit" class="btn btn-primary">Connexion</button>
        <small>Pas encore de compte ? <a href="/inscription" class="link">S'inscrire</a></small>
        <?php \app\core\form\Form::end() ?>
    </div>
</div>

