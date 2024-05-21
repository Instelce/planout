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
    

    public function save() {
        $this->user = Application::$app->session->get('user');
        

        
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
            'job' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 60]]
        ];
    }
}