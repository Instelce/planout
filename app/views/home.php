<?php

/** @var $this \app\core\View */

$this->title = "Home";

?>

<header class="home">
    <h1 class="t-center">Planifier n’a jamais <br>été aussi simple !</h1>
    <a href="/inscription" class="btn sb" style="width: 20rem">
        <span>Commencer</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
    </a>
    
    <div class="grid">
        <?php
        for ($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 30; $j++) {
                echo '<span></span>';
            }
        }
        ?>
    </div>
</header>
