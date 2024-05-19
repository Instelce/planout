<?php
use app\core\Application;

require Application::$ROOT_DIR.'/views/layouts/parts/header.php'
?>

<nav class="navbar">
    <a href="/">
        <img src="/assets/logo-full.png" alt="Logo">
    </a>

    <?php if (Application::$app->isAuthenticated()): ?>
        <ul>
            <li>
                <a class="profile" href="/profile"><?php echo Application::$app->user->username ?></a>
            </li>
        </ul>
    <?php else: ?>
        <ul>
            <li>
                <a href="/connexion">Connexion</a>
            </li>
            <li>
                <a class="btn" href="/inscription">Inscription</a>
            </li>
        </ul>
    <?php endif; ?>
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