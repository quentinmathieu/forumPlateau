<?php



$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>

<h1><?= $topic->getTitle() ?></h1>
<h2>Crée par <strong style="color : blue"><?= $topic->getUser()->getPseudo() ?></strong></h2>
<h4><?= $topic->getCreationdate() ?></h4>

<?php

foreach ($posts as $post) {

?>

    <div style="margin-top : 3em;max-width : 70%; border : 1px black solid; padding : 0 2vw 1vw 2vw; margin : 2em">
        <p><?= $post->getContenu() ?></p>
        <p><?= $post->getCreationdate() ?></p>
        Par <strong><?= $post->getUser()->getPseudo() ?></strong>
    </div>

<?php

}

?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId()?>" method="post" class="container">

    <p class="mb-3">
        <label class="form-label" for="contenu">Répondre :
            <textarea type="text" class="form-control" name="contenu" id="contenu" rows="5"></textarea>
        </label>
    </p>
    <p class="mb-3 form-check">
        <input type="submit" name="submit" value="Répondre" class="btn btn-primary">
    </p>
</form>