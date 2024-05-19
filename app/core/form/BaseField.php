<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attr;

    abstract public function renderInput(): string;


    public function __construct(Model $model, string $attr)
    {
        $this->model = $model;
        $this->attr = $attr;
    }

    public function __toString()
    {
        return sprintf('
            <div class="field">
                <div class="input">
                    %s
                    <label class="form-label" for="%s">%s</label>
                </div>
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->renderInput(),
            $this->attr,
            $this->model->getLabel($this->attr) ?? ucfirst($this->attr),
            $this->model->getFirstError($this->attr)
        );
    }
}