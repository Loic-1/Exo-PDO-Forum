<?php
$category = $result["data"]['category'];
$topics = $result["data"]['topics'];
?>

<h1>Liste des topics</h1>

<?php
if ($topics) {
    foreach ($topics as $topic) { ?>
        <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?>, le <?= $topic->getCreationDate() ?> <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer Topic</a> <a href="#">Modifier</a>

        <form action="index.php?ctrl=forum&action=updateTopicTitle&id=<?= $topic->getId() ?>" method="post">
            <input type="text" name="title" value="<?= $topic ?>">
            <input type="submit" value="Modifier">
        </form>
        </p>

    <?php }
    // Il n'y a pas de Topics dans cette catégorie
} else { ?>
    <p>Il n'y a pas de Topics dans cette catégorie ☺☻</p>
<?php }
?>

<form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method="post">
    <input type="text" name="title" placeholder="Titre">
    <input type="text" name="text" placeholder="Premier message">
    <input type="submit" value="Créer">
</form>