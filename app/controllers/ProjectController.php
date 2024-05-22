<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\KanbanBoard;
use app\models\Project;
use app\models\Member;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['list', 'details', 'create', 'delete']));
    }

    public function list()
    {
        $projects = Project::find(['user' => Application::$app->session->get('user')]);

        return $this->render("projects/list", ['projects' => $projects]);
    }

    public function details(Request $request)
    {
        $pk = $request->getRouteParam('pk');
        $project = Project::findOne(['id' => $pk]);
        if (!$project) throw new NotFoundException();

        $members = Member::find(['project' => $pk]);
        $kanbanBoard = new KanbanBoard();
        $kanbanBoards = KanbanBoard::find(['project' => $pk]);
        
        $member = MemberController::returnIdMember($request);


        if ($request->isPost()) {
            $body = $request->getBody();
            if ($body['formId'] === 'createKanbanBoard') {
                $kanbanBoard->loadData($body);
                if ($kanbanBoard->validate() && $kanbanBoard->save()) {
                    Application::$app->response->redirect(Application::$app->request->getPath());
                    exit;
                }
            }

            if ($body['formId'] === 'updateMember') {
                $member->loadData($body);
                if ($member->validate() && $member->update()) {
                    Application::$app->session->setFlash('success', "$member->name à bien été mit à jour");
                    Application::$app->response->redirect(Application::$app->request->getPath());
                    exit;
                }
            }

        }

        
        return $this->render("projects/details", ['project' => $project, 'members' => $members, 'kanbanBoard' => $kanbanBoard, 'kanbanBoards' => $kanbanBoards]);
    }

    public function create(Request $request)
    {
        $project = new Project();

        if ($request->isPost()) {
            $project->loadData($request->getBody());

            if ($project->validate() && $project->save()) {
                Application::$app->session->setFlash('success', "$project->name à bien été créé");
                Application::$app->response->redirect('/projects');
                exit;
            }

            return $this->render("projects/create", ['model' => $project]);
        }

        return $this->render("projects/create", ['model' => $project]);
    }

    public function update(Request $request)
    {
        $pk = $request->getRouteParam('pk');
        $project = Project::findOne(['id' => $pk]);

        if ($request->isPost()) {
            $project->loadData($request->getBody());

            if ($project->validate() && $project->update()) {
                Application::$app->session->setFlash('success', "$project->name à bien été mit à jour");
                Application::$app->response->redirect("/projects/$pk");
                exit;
            }
        }

        return $this->render('projects/update', ['model' => $project]);
    }

    public function delete(Request $request)
    {
        $confirm = $request->getParam('confirm');
        $pk = $request->getRouteParam('pk');
        $project = Project::findOne(['id' => $pk]);

        if ($confirm || $request->isPost()) {
            if ($project->destroy()) {
                Application::$app->session->setFlash('success', "$project->name à bien été supprimé");
                Application::$app->response->redirect("/projects");
                exit;
            }
        }

        return $this->render('projects/delete', ['model' => $project]);
    }
}