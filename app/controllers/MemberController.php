<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\NotFoundException;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
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
        $
    }

    public function update(Request $request)
    {
        
    }

    public function delete(Request $request)
    {
        
    }
}