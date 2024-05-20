<?php

/** @var $this \app\core\View */
/** @var $projects \app\models\Project[] */

$this->title = "Projets";

// sort projects
usort($projects, function ($a, $b) {
    return strtotime($a->deadline) - strtotime($b->deadline);
});

?>


<header class="header header-page">
    <h2>Projets</h2>
    <div>
        <a href="/projects/new" class="btn rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>
    </div>
</header>

<?php if (count($projects) === 0): ?>
    <div class="center mt-2">
        <p>Vous n'avez pas encore de projet.</p>
    </div>
<?php else: ?>
    <div class="grid gc-4 gg-2 mt-2">
        <?php foreach ($projects as $project): ?>
            <a href="/projects/<?php echo $project->id ?>" class="project-card">
                <div class="tasks">
                    tache assignée
                </div>
                <div class="bottom">
                    <p><?php echo $project->name ?></p>

                    <div class="remaining-time">
                        <span>
                            <?php
                            $now = new DateTime(date('Y-m-d'));
                            $deadline = new DateTime($project->deadline);
                            $diff = date_diff($now, $deadline);

                            echo $diff->d;
                            ?>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <a href="/projects/new" class="btn btn-gray" style="border-radius: 20px">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>
    </div>
<?php endif; ?>