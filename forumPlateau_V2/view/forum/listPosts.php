<?php
// $categories = $result["data"]['category'];
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<h1>Liste des posts</h1>

<?php
foreach ($posts as $post) { ?>
    <p><?= $post ?> par <?= $post->getUser() ?>, le <?= $post->getCreationDate() ?></p>
<?php } ?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId()?>" method="post">
    <input type="text" name="text">
    <input type="submit">
</form>