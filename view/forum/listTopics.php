<?php

$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>


<?php


    echo '<table style="margin : auto; width : 70%;  " class ="table table-striped table-bordered">
            <tbody>
                <thead>
                    <tr>
                        <th ">Topic</td>
                        <th ">Auteur</td>
                        <th ">Date de création</td>
                        <th ">Status</td>
                    </tr>
                </thead>';
                foreach ($topics as $topic) {
                    $openClose = $topic->getClosed() ? "Fermé" : "Ouvert";

                echo '<tr>
                    <td ><a href="index.php?ctrl=forum&action=listPosts&id='. $topic->getId() .'">' . $topic->getTitle() . '</a></td>
                    <td >' . $topic->getUser()->getPseudo() . '</td>
                    <td >' . $topic->getCreationDate() . '</td>
                    <td >' . $openClose . '</td>
                </tr>';
                } echo '
            </tbody>
    </table>';
            
?>

<form action="index.php?ctrl=forum&action=addTopic" method="post" class="container">

    <p class="mb-3">
        <label class="form-label" for="topicTitle">Nouveau topic :
            <input type="text" class="form-control" name="topicTitle" id="topicTitle"></input>
        </label>
    </p>
    <p class="mb-3">
        <label class="form-label" for="contenu">
            <textarea type="text" class="form-control" name="contenu" id="contenu" rows="5"></textarea>
        </label>
    </p>
    <p class="mb-3 form-check">
        <input type="submit" name="submit" value="Répondre" class="btn btn-primary">
    </p>
</form>
