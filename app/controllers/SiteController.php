<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render("home");
    }
}