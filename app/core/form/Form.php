<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo "<form class='form' action='$action' method='$method'>";
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attr)
    {
        return new InputField($model, $attr);
    }
}