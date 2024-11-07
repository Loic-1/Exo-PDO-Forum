<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php
foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?>, le <?= $topic->getCreationDate() ?></p>
<?php } ?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId()?>" method="post">
    <input type="text" name="text">
    <input type="submit">
</form>