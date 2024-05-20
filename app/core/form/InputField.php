<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public const TEXT_TYPE = 'text';
    public const EMAIL_TYPE = 'email';
    public const PASSWORD_TYPE = 'password';
    public const NUMBER_TYPE = 'number';
    public const DATE_TYPE = 'date';

    public string $type;

    public function __construct(Model $model, string $attr)
    {
        $this->type = self::TEXT_TYPE;
        parent::__construct($model, $attr);
    }

    public function passwordField()
    {
        $this->type = self::PASSWORD_TYPE;
        return $this;
    }

    public function dateField() {
        $this->type = self::DATE_TYPE;
        return $this;
    }

    public function renderInput(): string
    {
        $value = $this->model->{$this->attr};
        if ($this->type === self::DATE_TYPE) {
            $value = date('Y-m-d', strtotime($this->model->{$this->attr}));
        }
        return sprintf('<input type="%s" id="%s" name="%s" value="%s" class="%s" placeholder="">',
            $this->type,
            $this->attr,
            $this->attr,
            $value,
            $this->model->hasError($this->attr) ? 'is-invalid' : ''
        );
    }
}