<?php

/** @var $this \app\core\View */
/** @var $project \app\models\Project */
/** @var $kanbanBoard \app\models\KanbanBoard */
/** @var $kanbanColumn \app\models\KanbanColumn */
/** @var $kanbanColumns \app\models\KanbanColumn[] */

/** @var $kanbanCard \app\models\KanbanCard */

use app\core\form\Form;
use app\core\form\InputField;
use app\core\form\TextareaField;
use app\models\KanbanCard;

$this->title = $kanbanBoard->name . " Kanban";

?>

<header class="header header-section">
    <h3><a class="link"
           href="/projects/<?php echo $project->id ?>"><?php echo $project->name ?></a>
        / <?php echo $kanbanBoard->name ?></h3>
</header>

<div class="kanban-grid">

    <?php foreach ($kanbanColumns as $column): ?>
        <div class="kanban-column">
            <header>
                <h4><?php echo $column->name ?></h4>
                <button class="btn btn-small btn-rounded new-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                         height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </header>

            <!-- Create new card form --->
            <div class="kanban-column-content">
                <form action="" method="post" class="new-card-form">
                    <input type="hidden" name="formId" value="newKanbanCard">
                    <input type="hidden" name="kanban_column"
                           value="<?php echo $column->id ?>">
                    <?php echo new TextareaField($kanbanCard, 'content') ?>
                    <button class="btn btn-small" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                             height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-check">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </button>
                </form>
                <?php
                $cards = KanbanCard::find(['kanban_column' => $column->id]);

                foreach ($cards as $card):
                    ?>
                    <div class="kanban-card" draggable="true">
                        <p><?php echo $card->content ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Create new column form --->
    <div class="new-column-form">
        <header>
            <form action="" method="post" class="flex gg-1 sb w-full">
                <input type="hidden" name="formId" value="newKanbanColumn">
                <?php echo new InputField($kanbanColumn, 'name') ?>
                <button class="btn btn-small" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                         height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-check">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </form>
        </header>

        <div class="m-1">
            <button class="close btn btn-gray w-full">Fermer</button>
        </div>
    </div>

    <!-- Show form --->
    <button class="new-column-button btn btn-gray">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </button>
</div>