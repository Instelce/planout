<?php

namespace app\controllers;

use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\Request;
use app\models\KanbanBoard;
use app\models\KanbanColumn;

class KanbanController extends Controller
{
    public function details(Request $request)
    {
        $projectPk = $request->getRouteParam('pk');
        $kanbanBoardPk = $request->getRouteParam('pkKanbanBoard');
        $kanbanBoard = KanbanBoard::findOne(['id' => $kanbanBoardPk, 'project' => $projectPk]);
        if (!$kanbanBoard) throw new NotFoundException();
        $kanbanColumn = new KanbanColumn();

        if ($request->isPost()) {
            $body = $request->getBody();
            if ($body['formId'] === ) {

            }
        }

        return $this->render('kanban/details', ['kanbanBoard' => $kanbanBoard]);
    }
}