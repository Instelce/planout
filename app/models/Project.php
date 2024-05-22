<?php

namespace app\models;

use app\core\Application;
use app\core\DBModel;

class Project extends DBModel
{
    public int $id = -1;
    public string $name = '';
    public string $description = '';
    public string $deadline = '';
    public string $created_at = '';
    public int $user;

    public function save() {
        $this->user = Application::$app->session->get('user');
        
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'projects';
    }

    public function attributes(): array
    {
        return ['name', 'description', 'deadline', 'user'];
    }

    public function canUpdateAttributes(): array
    {
        return ['name', 'description', 'deadline'];
    }

    public static function pk(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 60]],
            'description' => [[self::RULE_MAX, 'max' => 255]],
            'deadline' => [self::RULE_REQUIRED]
        ];
    }

    public function isOwned() {
        return $this->user === Application::$app->user->id;
    }
}