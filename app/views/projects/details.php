<?php

/** @var $this \app\core\View */
/** @var $project \app\models\Project */
/** @var $members Member[] */
/** @var $kanbanBoard \app\models\KanbanBoard */
/** @var $kanbanBoards \app\models\KanbanBoard[] */

use app\controllers\MemberController;
use app\core\Application;
use app\models\Member;

$this->title = $project->name;
?>

<header class="header header-page mb-2">
    <div>
        <h2><?php echo $project->name; ?></h2>
        <!--        <p>--><?php
//echo $project->description
?><!--</p>-->
    </div>
    <div class="flex gg-1">
        <?php if ($project->isOwned()): ?>
            <a href="/projects/edit/<?php echo $project->id; ?>"
               class="btn btn-rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </a>
            <button class="btn btn-danger btn-rounded" onclick="toggleModal(1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-trash">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
            </button>
        <?php endif; ?>
    </div>
</header>

<!-- Member section -->
<section class="mb-2">
    <div class="header header-section">
        <h3>Membres</h3>
        <a href="/projects/<?php echo $project->id; ?>/members/new"
           class="btn btn-small btn-rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-plus">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
    </div>
    <?php if (count($members) === 0): ?>
        <div class="center mt-2">
            <p>Aucun membre dans ce projet.</p>
        </div>
    <?php endif; ?>
    <div class="grid gc-4 gg-1 mt-2">
        <?php foreach ($members as $member): ?>

            <?php if (
                Application::$app->request->getParam("memberId") == $member->id
            ): ?>
                <?php $form = \app\core\form\Form::begin("", "post"); ?>
                <input type="hidden" name="formId" value="updateMember">
                <input type="hidden" name="id" value="<?php echo $member->id; ?>">
                <?php echo $form->field(
                    Member::returnIdMember(Application::$app->request),
                    "role"
                ); ?>
                <?php echo $form->field(
                    Member::returnIdMember(Application::$app->request),
                    "job"
                ); ?>
                <div class="flex gg-1">
                    <button class="btn" type="submit">Confirmer</button>
                    <a class="btn btn-gray w-full" href="/projects/<?php echo $project->id; ?>">Annuler</a>
                </div>
                <?php \app\core\form\Form::end(); ?>
            <?php else: ?>
                <div class="member-card">
                    <h4 class="username"><?php
                    $user = \app\models\User::findOne(["id" => $member->user]);
                    echo $user->username;
                    ?></h4>
                    <div class="attributes">
                        <div><span>Role</span><span><?php echo $member->role; ?></span></div>
                        <div><span>Job</span><span><?php echo $member->job; ?></span></div>
                    </div>
                    <div class="buttons">
                        <a class="btn btn-small" href="<?php echo "/projects/$project->id?memberId=$member->id"; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                        <button class="btn btn-small btn-danger" onclick='toggleModal(3, "<?php echo "/projects/$project->id/members/delete/$member->id?confirm=true"; ?>", "target")'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>

    </div>
</section>

<!-- Kanban section -->
<section>
    <div class="header header-section">
        <h3>Kanban</h3>
        <div>
            <!--        href="/projects/-->
            <?php
//echo $project->id
?><!--/kanban/new"-->
            <a onclick="toggleModal(2)"

               class="btn btn-small btn-rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </a>
        </div>
    </div>
    <?php if (count($kanbanBoards) === 0): ?>
        <div class="center mt-2">
            <p>Vous n'avez pas encore de tableau kanban.</p>
        </div>
    <?php endif; ?>
    <div class="grid gc-1 gg-1 mt-2">
        <?php foreach ($kanbanBoards as $board): ?>
            <a href="/projects/<?php echo $project->id; ?>/kanban/<?php echo $board->id; ?>" class="kanban-board-card">
                <h4><?php echo $board->name; ?></h4>

                <div>
                    <span>
                        <?php echo count($board->getCards()) . " cartes"; ?>
                    </span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Modals -->
<div id="m1" class="modal-container">
    <div class="modal">
        <h3>Êtes vous sûr ?</h3>
        <div class="buttons">
            <a href="/projects/delete/<?php echo $project->id; ?>?confirm=true"
               class="btn btn-danger">Oui</a>
            <button onclick="toggleModal(1)" class="btn btn-gray">Non</button>
        </div>
    </div>
</div>

<div id="m2" class="modal-container">
    <div class="modal">
        <h3>Créer une kanban</h3>
        <?php $form = \app\core\form\Form::begin("", "post"); ?>
            <input type="hidden" name="formId" value="createKanbanBoard">
            <?php echo $form->field($kanbanBoard, "name"); ?>
            <div class="buttons">
                <button type="submit" class="btn">Créer</button>
                <button onclick="toggleModal(2)" class="btn btn-gray">Annuler
                </button>
            </div>
        <?php \app\core\form\Form::end(); ?>
    </div>
</div>

<div id="m3" class="modal-container">
    <div class="modal">
        <h3>Êtes vous sûr ?</h3>
        <div class="buttons">
            <a class="target btn btn-danger" href="">Oui</a>
            <button onclick="toggleModal(3)" class="btn btn-gray">Non</button>
        </div>
    </div>
</div>
