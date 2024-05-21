<?php
/** @var $model \app\models\Member */
/** @var $this \app\core\View */

$this->title = "Nouveau membre";
?>


<div class="flex items-center f-col">
    <h2 class="mb-2">Nouveau membre</h2>
    <div class="w-half">
        <?php $form = \app\core\form\Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'role') ?>
        <?php echo $form->field($model, 'job') ?>
        <?php echo $form->field($model, 'user_email') ?>
        <button type="submit" class="btn btn-primary">Créer</button>
        <?php \app\core\form\Form::end() ?>
    </div>
</div>

