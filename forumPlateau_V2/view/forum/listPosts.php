<?php
// $categories = $result["data"]['category'];
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<h1>Liste des posts</h1>

<?php
if ($posts) {
    foreach ($posts as $post) { ?>
        <p><?= $post ?> par <?= $post->getUser() ?>, le <?= $post->getCreationDate() ?> <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer post</a> <a href="#">Modifier message</a>

        <form action="index.php?ctrl=forum&action=updatePostText&id=<?= $post->getId() ?>" method="post">
            <input type="text" name="text" value="<?= $post ?>">
            <input type="submit" value="Modifier">
        </form>

        </p>
    <?php }
} else { ?>
    <p>Il n'y a pas de Posts dans ce topic ☺☻</p>
<?php }
?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="post">
    <input type="text" name="text" placeholder="Message">
    <input type="submit" value="Poster">
</form>