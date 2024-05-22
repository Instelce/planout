<?php

namespace app\models;

use app\core\Application;
use app\core\DBModel;

class KanbanBoard extends DBModel
{
    public int $id = -1;
    public string $name = '';
    public int $project = -1;

    public function loadData($data)
    {
        $this->project = Application::$app->request->getRouteParam('pk');
        parent::loadData($data);
    }

    public static function tableName(): string
    {
        return 'kanban_boards';
    }

    public function attributes(): array
    {
        return ['name', 'project'];
    }

    public function canUpdateAttributes(): array
    {
        return ['name'];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 60], [self::RULE_UNIQUE, 'class' => self::class, 'with' => ['project']]]
        ];
    }

    public function getCards(): array
    {
        $cards = [];
        $columns = KanbanColumn::find(['kanban_board' => $this->id]);
        foreach ($columns as $column) {
            $c = KanbanCard::find(['kanban_column' => $column->id]);
            foreach ($c as $card) {
                $cards[] = $card;
            }
        };
        return $cards;
    }
}