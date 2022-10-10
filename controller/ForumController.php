<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {


        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["creationdate", "DESC"])
            ]
        ];
    }



    public function listPosts($id)
    {

        $topicManager = new TopicManager();
        $postManager = new PostManager();

        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "topic" => $topicManager->findOneById($id),
                "posts" => $postManager->FindPostByTopic($id)
            ]
        ];
    }


    public function addPost($id)
    {
        $contenuPost = filter_input(INPUT_POST, "contenu", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $postManager = new PostManager();
        if ($contenuPost) {
            $data = [
                "topic_id" => $id,
                "contenu" => $contenuPost,
                "user_id" => 1,
                "creationdate" => date("Y-m-d H:i:s")
            ];
            
            $postManager->add($data);

            $this->redirectTo("forum", "listPosts", $id);
        }
    }

    public function addTopic(){
        $topicTitle =  filter_input(INPUT_POST, "topicTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contenuPost = filter_input(INPUT_POST, "contenu", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $topicManager = new TopicManager();

        if ($topicTitle && $contenuPost){
            $data = [
                "title" => $topicTitle,
                "user_id" => 1,
                "creationdate" => date("Y-m-d H:i:s")
            ];

            $topicManager->add($data);

            $lastId = $topicManager->getLastId()[0]["LAST_INSERT_ID()"];

            $this->addPost($lastId);


        }

    }
}
