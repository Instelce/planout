<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\Member;
use app\models\Project;
use app\models\User;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['list', 'details', 'create', 'delete']));
    }

    public function list()
    {
        
    }

    public function details(Request $request)
    {
        
    }

    public function create(Request $request)
    {
        $member = new Member();

        // use for autocomplete
        $users = User::all();
        $users = array_filter($users, fn($user) => $user->id !== Application::$app->session->get('user')); // remove the current user

        if ($request->isPost()){
            $member->loadData($request->getBody());

            if($member->validate() && $member->save()){
                Application::$app->session->setFlash('success', "$member->user_email à bien été ajouté au projet");
                Application::$app->response->redirect("/projects/$member->project");
                exit;
            }

            return $this->render("members/create", ['model' => $member]);
        }

        return $this->render("members/create", ['model' => $member, 'users' => $users]);
    }

    //unused
    public function update(Request $request)
    {
        $pkProject = $request->getRouteParam('pk');
        $pk = $request->getRouteParam('pkMember');
        $member = Member::findOne(['id' => $pk]);

        if ($request->isPost()) {
            $member->loadData($request->getBody());

            if ($member->validate() && $member->update()) {
                Application::$app->session->setFlash('success', "$member->name à bien été mit à jour");
                Application::$app->response->redirect("/projects/$pkProject");
                exit;
            }
        }

        return $this->render('member/update', ['model' => $member]);
    }

    public function delete(Request $request)
    {
        $confirm = $request->getParam('confirm');
        $pk = $request->getRouteParam('pkMember');
        $member = Member::findOne(['id' => $pk]);
        $user = User::findOne(['id' => $member->user]);

        if ($confirm || $request->isPost()) {
            if ($member->destroy()) {
                Application::$app->session->setFlash('success', "$user->username à bien été supprimé");
                Application::$app->response->redirect("/projects/$member->project");
                exit;
            }
        }

        return $this->render('projects/delete', ['model' => $member]);
    }
}