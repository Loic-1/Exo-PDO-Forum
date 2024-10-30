<?php
// $categories = $result["data"]['category'];
$topics = $result["data"]['topics'];
$posts = $result["data"]['posts'];
?>

<h1>Liste des posts</h1>

<?php
foreach ($posts as $post) { ?>
    <p><?= $post ?> par <?= $post->getUser() ?>, le <?= $post->getCreationDate() ?></p>
<?php } ?>

<form action="submitPost" method="$_POST">
    <input type="text" name="text">
    <input type="submit">
</form>