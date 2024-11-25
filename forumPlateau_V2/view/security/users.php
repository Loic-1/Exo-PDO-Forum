<?php
$users = $result["data"]['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php

if ($users) {
    foreach ($users as $user) { ?>

        <div><a href="index.php?ctrl=security&action=profile&id=<?= $user->getId() ?>"><?= $user ?></a>, profil créé le <?= $user->getRegistrationdate() ?> /a>

            <?php
            if (App\Session::isAdmin()) { ?>

            <a href="#">Nommer en tant qu'admin</a>
            <?php } ?>

        </div>

<?php }
} else {
    # code...
}

?>