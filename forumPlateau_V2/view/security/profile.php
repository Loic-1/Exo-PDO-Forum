<?php
$user = $result["data"]['user'];
?>

<?php

if ($user) { ?>

    <div>
        <?= $user ?>(<?= $user->getEmail ?>), profil créé le <?= $user->getRegistrationdate ?><br>
        Il a les rôles : <?= $user->getRoles ?>
    </div>
<?php }
else { ?>
    <p>Le profil de cet utilidateur est indisponible</p>
<?php } ?>