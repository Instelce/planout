<?php
/** @var $this \app\core\View */

use app\core\Application;

require Application::$ROOT_DIR.'/views/layouts/parts/header.php'
?>

<div class="container">
    {{content}}
</div>

<?php
require Application::$ROOT_DIR.'/views/layouts/parts/footer.php'
?>