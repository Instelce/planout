<?php

/** @var $this \app\core\View */
/** @var $project \app\models\Project */
/** @var $members \app\models\Member[] */

$this->title = $project->name;

?>

<header class="header header-page">
    <div>
        <h2><?php echo $project->name ?></h2>
<!--        <p>--><?php //echo $project->description ?><!--</p>-->
    </div>
    <div class="flex gg-1">
        <a href="/projects/edit/<?php echo $project->id ?>" class="btn btn-rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </a>
        <button class="btn btn-danger btn-rounded" onclick="toggleModal(1)">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    </div>
</header>

<div>
    <div class="header header-section">
        <h3>Membres</h3>
        <a href="/projects/<?php echo $project->id?>/members/new" class="btn btn-small btn-rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>
    </div>

    <div class="grid gc-4 gg-2 mt-2">
        <?php foreach ($members as $member): ?>
            <div class="">
                <?php echo $member->role ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="header header-section">
    <h3>Kanban</h3>
    <div>
        <a href="/projects/<?php echo $project->id ?>/kanban/new" class="btn btn-small btn-rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>
    </div>
</div>

<div id="m1" class="modal-container">
    <div class="modal">
        <h3>Êtes vous sûr ?</h3>
        <div class="buttons">
            <a href="/projects/delete/<?php echo $project->id ?>?confirm=true" class="btn btn-danger">Oui</a>
            <button onclick="toggleModal(1)" class="btn btn-gray">Non</button>
        </div>
    </div>
</div>
