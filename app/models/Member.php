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



        $this->user = $user->id;
        return parent::save();
    }

    public function validate()
    {
        $user = User::findOne(['email' => $this->user_email]);
        if (!$user) {
            $this->addError('user_email', 'An user does not exist with this email address');
            return false;
        }
        if ($user->id === Application::$app->user->id) {
            $this->addError('user_email', 'Vous êtes déjà membre de ce projet.');
            return false;
        }
        $this->user = $user->id;
        return parent::validate();
    }

    public function loadData($data)
    {
        $this->project = Application::$app->request->getRouteParam('pk');

        parent::loadData($data);
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
            'user_email' => [self::RULE_REQUIRED, self::RULE_MAIL],
            'user' => [[self::RULE_UNIQUE, 'class' => self::class, 'with' => ['project'], 'bindError' => 'user_email']]
        ];
    }

    public function labels(): array {
        return [
            'user_email' => "Email de l'utilisateur"
        ];
    }
}