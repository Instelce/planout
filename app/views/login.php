<?php
/** @var $model \app\models\LoginForm */
/** @var $this \app\core\View */

$this->title = "Connexion";
?>


<div class="flex items-center f-col">
    <h1 class="mb-2">Connexion</h1>
    <div class="w-half">
        <?php $form = \app\core\form\Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordField() ?>
        <button type="submit" class="btn btn-primary">Connexion</button>
        <?php \app\core\form\Form::end() ?>
    </div>
</div>

