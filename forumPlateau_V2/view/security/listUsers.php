<?php

use App\Session;

$users = $result["data"]['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php

if ($users) {
    foreach ($users as $user) { ?>

        <div><a href="index.php?ctrl=security&action=profile&id=<?= $user->getId() ?>"><?= $user ?></a>, profil créé le <?= $user->getRegistrationdate() ?>

            <?php

            // attribution du rôle dynamiquement en fonction du rôle
            echo (in_array("ROLE_ADMIN", $user->getRoles(), true))
                ? "<a href=\"index.php?ctrl=security&action=demoteFromAdmin&id=" . $user->getId() . "\">Rétrograder en tant qu'user</a>"
                : "<a href=\"index.php?ctrl=security&action=promoteToAdmin&id=" . $user->getId() . "\">Nommer en tant qu'admin</a>";

                // var_dump(strlen("Rétrograder en tant qu'user"), strlen("Nommer en tant qu'admin"));
                // die;

            ?>

    <?php }
} else {
    # code...
}

    ?>