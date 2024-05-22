<?php

/** @var $this \app\core\View */
/** @var $project \app\models\Project */
/** @var $kanbanBoard \app\models\KanbanBoard */
/** @var $kanbanColumn \app\models\KanbanColumn */
/** @var $kanbanColumns \app\models\KanbanColumn[] */

use app\core\form\Form;
use app\core\form\InputField;

$this->title = $kanbanBoard->name . " Kanban";

?>

<header class="header header-section">
    <h3><?php echo $kanbanBoard->name ?></h3>
</header>

<div class="kanban-grid">


    <!-- Create new column --->
    <div class="kanban-column">
        <header>
            <form action="" method="post" class="flex gg-1 sb w-full">
                <input type="hidden" name="formId" value="newKanbanColumn">
                <?php echo new InputField($kanbanColumn, 'name') ?>
                <button class="btn btn-small" type="submit">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </button>
            </form>
        </header>
    </div>

    <?php foreach ($kanbanColumns as $column): ?>
        <div class="kanban-column">
            <header>
                <h4><?php echo $column->name ?></h4>
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
    <?php endforeach; ?>
</div>