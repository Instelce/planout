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
        $isRequired = in_array($this->model::RULE_REQUIRED, $this->model->rules()[$this->attr]);
        return sprintf('
            <div class="field">
                <div class="input">
                    %s
                    <label class="form-label" for="%s">%s <span>%s</span></label>
                </div>
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->renderInput(),
            $this->attr,
            $this->model->getLabel($this->attr) ?? ucfirst($this->attr),
            $isRequired ? '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12 3.51472V20.4853" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M3.51471 12H20.4853" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
' : '',
            $this->model->getFirstError($this->attr)
        );
    }
}