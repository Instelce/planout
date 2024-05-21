<?php

namespace app\models;

use app\core\Application;
use app\core\DBModel;

class Member extends DBModel
{
    public int $id = -1;
    public string $role = "";
    public string $job = "";
    public int $project = -1;
    public int $user = -1;
    public string $user_email = '';
    
    public function save() {
        $email = Application::$app->request->getBody()['user_email'];
        $user = User::findOne(['email' => $email]);

        if (!$user) {
            $this->addError('user_email', 'An user does not exist with this email address');
            return false;
        }

        $this->user = $user->id;
        $this->project = Application::$app->request->getRouteParam('pk');        
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'members';
    }

    public function attributes(): array
    {
        return ['role', 'job', 'project', 'user'];
    }

    public function canUpdateAttributes(): array
    {
        return ['role', 'job'];
    }

    public static function pk(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'role' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 60]],
            'job' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 60]],
            'user_email' => [self::RULE_REQUIRED, self::RULE_MAIL]
        ];
    }

    public function labels(): array {
        return [
            'user_email' => "Email de l'utilisateur"
        ];
    }
}