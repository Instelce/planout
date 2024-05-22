<?php

/** @var $this \app\core\View */
/** @var $model \app\models\Project */

$this->title = "Supprimer";

?>

<header class="header header-page">
    <h2>Supprimer <?php echo $model->name ?></h2>
</header>

<div class="mt-2 flex f-col jc-center items-center">
    <h3 class="mb-2">Êtes vous sûr ?</h3>
    <div class="flex gg-1">
        <form action="" method="post">
            <button type="submit" class="btn btn-danger">Oui</button>
        </form>
        <button onclick="toggleModal(1)" class="btn">Non</button>
    </div>
</div>
