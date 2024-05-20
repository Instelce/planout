<?php
use app\core\Application;

require Application::$ROOT_DIR.'/views/layouts/parts/header.php'
?>

<nav class="navbar">
    <a href="<?php echo Application::$app->isAuthenticated() ? '/projects' : '/' ?>">
        <img src="/assets/logo-full.png" alt="Logo">
    </a>

    <?php if (Application::$app->isAuthenticated()): ?>
        <ul>
            <li>
                <a class="profile" href="/profile"><?php echo Application::$app->user->username ?></a>
            </li>
            <li>
                <a href="/deconnexion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                </a>
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