<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\Member;
use app\models\Project;

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

        if ($request->isPost()){
            $member->loadData($request->getBody());
            if($member->validate() && $member->save()){
                Application::$app->session->setFlash('success', "$member->user_email à bien été ajouté au projet");
                Application::$app->response->redirect("/projects/$member->project");
                exit;
            }

            return $this->render("members/create", ['model' => $member]);
        }

        return $this->render("members/create", ['model' => $member]);
    }

    public function update(Request $request)
    {
        
    }

    public function delete(Request $request)
    {
        
    }
}