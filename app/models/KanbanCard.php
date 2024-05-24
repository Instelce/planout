<?php

namespace app\models;

use app\core\DBModel;

class KanbanCard extends DBModel
{
    public int $id = -1;
    public string $content = '';
    public int $kanban_column = -1;
    public int $position = 1;

    public static function tableName(): string
    {
        return 'kanban_cards';
    }

    public function attributes(): array
    {
        return ['content', 'position', 'kanban_column'];
    }

    public function canUpdateAttributes(): array
    {
        return ['content', 'position', 'kanban_column'];
    }

    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
        ];
    }
}