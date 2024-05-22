<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\Request;
use app\models\KanbanBoard;
use app\models\KanbanCard;
use app\models\KanbanColumn;
use app\models\Project;

class KanbanController extends Controller
{
    public function details(Request $request)
    {
        $projectPk = $request->getRouteParam('pk');
        $project = Project::findOne(['id' => $projectPk]);
        $kanbanBoardPk = $request->getRouteParam('pkKanbanBoard');
        $kanbanBoard = KanbanBoard::findOne(['id' => $kanbanBoardPk, 'project' => $projectPk]);
        if (!$kanbanBoard) throw new NotFoundException();

        $kanbanColumn = new KanbanColumn();
        $kanbanColumns = KanbanColumn::find(['kanban_board' => $kanbanBoard->id]);

        if ($request->isPost()) {
            $body = $request->getBody();
            
            if ($body['formId'] === 'newKanbanColumn') {
                $kanbanColumn->loadData($body);

                if ($kanbanColumn->validate() && $kanbanColumn->save()) {
                    Application::$app->response->redirect($request->getPath());
                    exit;
                }
            }

            if ($body['formId'] === 'newKanbanCard') {
                $kanbanCard = new KanbanCard();
                $kanbanCard->loadData($body);

                if ($kanbanCard->validate() && $kanbanCard->save()) {
                    Application::$app->response->redirect($request->getPath());
                    exit;
                }
            }
        }

        return $this->render('kanban/details', [
            'project' => $project,
            'kanbanBoard' => $kanbanBoard,
            'kanbanColumn' => $kanbanColumn,
            'kanbanColumns' => $kanbanColumns,
            'kanbanCard' => new KanbanCard()
        ]);
    }
}