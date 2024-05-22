<?php

/** @var $this \app\core\View */
/** @var $project \app\models\Project */
/** @var $kanbanBoard \app\models\KanbanBoard */

$this->title = $kanbanBoard->name . " Kanban";

?>

<header class="header header-section">
    <h3><?php echo $kanbanBoard->name ?></h3>
</header>

<div class="kanban-grid">
    <div class="kanban-column">
        <?php ?>
        <header>
            <h4>Column</h4>
            <button class="btn btn-small btn-rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </button>
        </header>
    </div>
</div>