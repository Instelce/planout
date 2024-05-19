<?php
use app\core\Application;

require Application::$ROOT_DIR.'/views/layouts/parts/header.php'
?>

<nav class="navbar">
    <a href="/">Planout</a>

    <ul>
        <li>
            <a href="/connexion">Connexion</a>
        </li>
        <li>
            <a href="/inscription">Inscription</a>
        </li>
    </ul>
</nav>

<div class="container">
    <?php
    if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Application::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    {{content}}
</div>

<?php
require Application::$ROOT_DIR.'/views/layouts/parts/footer.php'
?>