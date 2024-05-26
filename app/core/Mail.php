<?php

namespace app\core;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    public PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['MAIL_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['MAIL_USERNAME'];
        $this->mailer->Password = $_ENV['MAIL_PASSWORD'];
        $this->mailer->Port = $_ENV['MAIL_PORT'];
    }

    public function send($to, $subject, $view, $params = [])
    {
        $this->mailer->setFrom($_ENV['MAIL_USERNAME'], $_ENV['MAIL_NAME']);
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = Application::$app->view->renderOnlyView($view, $params);
        $this->mailer->send();
    }
}