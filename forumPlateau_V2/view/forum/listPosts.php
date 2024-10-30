<?php
$categories = $result["data"]['categories'];
$topics = $result["data"]['topics'];
$posts = $result["data"]['posts'];
?>

<h1>Liste des posts</h1>

<?php
foreach ($posts as $post) { ?>
    <p>test</p>
    <p><?= $post ?> par <?= $post->getUser() ?></p>
<?php }
