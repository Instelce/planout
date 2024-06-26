<?php

namespace app\core\form;

use app\core\Model;

class TextareaField extends BaseField
{

    public function __construct(Model $model, string $attr)
    {
        parent::__construct($model, $attr);
    }

    public function renderInput(): string
    {
        return sprintf('<textarea id="%s" name="%s" class="form-control %s" placeholder="">%s</textarea>',
            $this->attr,
            $this->attr,
            $this->model->hasError($this->attr) ? 'is-invalid' : '',
            $this->model->{$this->attr}
        );
    }
}