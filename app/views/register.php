<?php
/** @var $model \app\models\User */
/** @var $this \app\core\View */

$this->title = 'Inscription';

?>


<div class="page-form">
    <h2 class="mb-2">Inscription</h2>

    <div class="w-half">
        <?php $form = \app\core\form\Form::begin('', 'post') ?>
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordField() ?>
            <?php echo $form->field($model, 'password_confirm')->passwordField() ?>
            <button type="submit" class="btn btn-primary">Soumettre</button>
            <small>Vous avez déjà un compte ? <a href="/connexion" class="link">Connectez-vous</a></small>
        <?php \app\core\form\Form::end() ?>
    </div>
</div>