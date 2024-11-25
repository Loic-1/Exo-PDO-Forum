<?php
$user = $result["data"]['user'];
?>

<?php

if ($user) { ?>

    <div>
        <?= $user ?>(<?= $user->getEmail() ?>), profil créé le <?= $user->getRegistrationdate() ?><br>
        Il a les rôles :
        <?php
        $count = count($user->getRoles());
        for ($i = 0; $i < count($user->getRoles()); $i++) {

            $curr = $user->getRoles()[$i];
            

            // $curr est en fin d'array
            if ($i == $count - 1) { ?>

                <?= $curr ?>
            <?php } 
            // $curr n'est pas en fin d'array
            else { ?>

                <?= $curr . ", " ?>
        <?php }
        }

        ?>
    </div>
<?php } else { ?>
    <p>Le profil de cet utilidateur est indisponible ☻</p>
<?php } ?>