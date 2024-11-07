<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php } ?>

<form action="index.php?ctrl=forum&action=addCategory" method="post">
    <input type="text" name="name" placeholder="Nom de la catégorie">
    <input type="submit">
</form>