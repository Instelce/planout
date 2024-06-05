<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Mail;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect("/projects");
                exit;
            }
        }
//        $this->setLayout('auth');
        return $this->render('login', ['model' => $loginForm]);
    }

    public function register(Request $request)
    {
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                $mail = new Mail();

                try {
//                    \mail($user->email, 'Activate your account', Application::$app->view->renderOnlyView('email/activate-user', ['user' => $user]));
                    $mail->send($user->email, 'Activate your account', 'email/activate-user', ['user' => $user]);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    exit;
                }

                Application::$app->session->setFlash("success", "Your account has been created successfully. Please check your email for activate your account before login.");
                Application::$app->response->redirect('/connexion');
                exit;
            }

            return $this->render('register', [
                'model' => $user
            ]);
        }

//        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/connexion');
    }

    public function activation()
    {
        $activation_hash = Application::$app->request->getParam('token');
        $user = User::findOne(['activation_hash' => $activation_hash]);

        if (!$user) {
            Application::$app->session->setFlash('error', 'Invalid token');
            Application::$app->response->redirect('/connexion');
            exit;
        } else {
            $user->status = User::STATUS_ACTIVE;
            $user->activation_hash = null;

            if ($user->activate()) {
                Application::$app->session->setFlash('success', 'Your account has been activated successfully');
                Application::$app->response->redirect('/connexion');
                exit;
            }
        }
    }

    public function profile() {
        return $this->render('profile');
    }
}