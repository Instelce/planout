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
use app\models\User;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['list', 'details', 'create', 'delete']));
    }

    public function list()
    {
        $projects = Project::find(['user' => Application::$app->session->get('user')]);

        $user_member_of = Member::find(['user' => Application::$app->user->id]);

        $projects_where_user = [];
        foreach ($user_member_of as $member){
            $project = Project::findOne(["id" => $member->project]);
            $projects_where_user[]=$project;
        }

        return $this->render("projects/list", ['projects' => $projects, 'projects_is_member' => $projects_where_user]);
    }

    public function details(Request $request)
    {
        // select project
        $pk = $request->getRouteParam('pk');
        $project = Project::findOne(['id' => $pk]);
        if (!$project) throw new NotFoundException();

        // select members project
        $members = Member::find(['project' => $pk]);
        $kanbanBoard = new KanbanBoard();
        $kanbanBoards = KanbanBoard::find(['project' => $pk]);
        
        $member = new Member();

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
                $member->id = $request->getParam('memberId');
                $member->loadData($body);
                if ($member->update()) {
                    $member = Member::findOne(['id' => $member->id]);
                    $user = User::findOne(['id' => $member->user]);
                    Application::$app->session->setFlash('success', "$user->username à bien été mit à jour");
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