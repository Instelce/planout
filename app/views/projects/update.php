<?php
/** @var $model \app\models\Project */
/** @var $this \app\core\View */

$this->title = "Modifier echo $model->name";

?>


<div class="flex items-center f-col">
    <h2 class="mb-2">Modifier <?php echo $model->name ?></h2>
    <div class="w-half">
        <?php $form = \app\core\form\Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'name') ?>
        <?php echo new \app\core\form\TextareaField($model, 'description') ?>
        <?php echo $form->field($model, 'deadline')->dateField() ?>
        <button type="submit" class="btn btn-primary">Appliquer</button>
        <?php \app\core\form\Form::end() ?>
    </div>
</div>

