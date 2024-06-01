<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public int $id = -1;
    public string $username = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $password_confirm = '';
    public ?string $activation_hash;

    public static function pk(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->activation_hash = hash('sha256', bin2hex(random_bytes(16)));
        return parent::save();
    }

    public function activate(): bool
    {
        return $this->targetUpdate(['status', 'activation_hash']);
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'status', 'activation_hash'];
    }

    public function canUpdateAttributes(): array
    {
        return ['username', 'email'];
    }

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 20]],
            'email' => [self::RULE_REQUIRED, self::RULE_MAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'password_confirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function labels(): array
    {
        return [
            'username' => 'Pseudo',
            'password' => 'Mot de passe',
            'password_confirm' => 'Confirmation mot de passe'
        ];
    }
}