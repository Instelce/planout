<?php

namespace app\models;

use app\core\Application;
use app\core\DBModel;

class KanbanColumn extends DBModel
{
    public int $id = -1;
    public string $name = '';
    public int $kanban_board = -1;

    public function loadData($data)
    {
        $this->kanban_board = Application::$app->request->getRouteParam('pkKanbanBoard');
        parent::loadData($data);
    }

    public static function tableName(): string
    {
        return 'kanban_columns';
    }

    public function attributes(): array
    {
        return ['name', 'kanban_board'];
    }

    public function canUpdateAttributes(): array
    {
        return ['name'];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 60], [self::RULE_UNIQUE, 'class' => self::class, 'with' => ['kanban_board']]]
        ];
    }
}