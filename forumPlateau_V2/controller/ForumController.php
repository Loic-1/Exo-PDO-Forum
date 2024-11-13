<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\DAO;
use Model\Entities\Topic;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use PDO;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {

        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id)
    {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : " . $category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function listPostsByTopic($id)
    {

        $topicManager = new TopicManager();
        $postManager = new PostManager();
        // pour mettre topic->getId() dans l'url de submitForm
        $topic = $topicManager->findOneById($id);
        // Model\Managers\PostManager;
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "meta_description" => "Liste des messages par sujet : ",
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }


    //-------------------FONCTIONS ADD---------------------


    public function addPost($id) // id de topic
    {

        $postManager = new PostManager;

        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = ["text" => $text, "topic_id" => $id];

        $postManager->add($data);

        $this->redirectTo('forum', 'listPostsByTopic', $id);
    }

    // add topic title and first message
    public function addTopic($id) // id de category
    {

        $topicManager = new TopicManager();
        $postManager = new PostManager;

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($title && $text) {

            $dataTitle = ["title" => $title, "category_id" => $id];

            $topicId = $topicManager->add($dataTitle);

            $dataMessage = ["text" => $text, "topic_id" => $topicId];

            $postManager->add($dataMessage);

            $this->redirectTo('forum', 'listTopicsByCategory', $id);
        }
        // if one of the two fields is null
        $this->redirectTo('forum', 'listTopicsByCategory', $id);
    }

    public function addCategory()
    {

        $categoryManager = new CategoryManager;

        // changes '<', '>', '&' into '&lt', '&gt', '&amp'
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = ["name" => $name];

        $categoryManager->add($data);

        $this->redirectTo('forum', 'index');
    }


    //-------------------FONCTIONS DELETE---------------------


    public function deletePost($id)
    {

        $postManager = new PostManager;
        $post = $postManager->findOneById($id);

        // if (isset($_POST['id'])) {
        $postManager->delete($id);
        $this->redirectTo('forum', 'listPostsByTopic', $post->getTopic()->getId());
        // }
    }

    public function deleteTopic($id)
    {

        $topicManager = new TopicManager;
        $topic = $topicManager->findOneById($id);

        // if (isset($_POST['id'])) {
        $topicManager->delete($id);
        $this->redirectTo('forum', 'listTopicsByCategory', $topic->getCategory()->getId());
        // }
    }

    // public function deleteCategory($id) { }


    //-------------------FONCTIONS DELETE---------------------


    public function updatePostText($id) : void {

        $postManager = new PostManager();
        $post = $postManager->findOneById($id);

        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = ["text" => $text];

        $postManager->update($data, $id);

        $this->redirectTo('forum', 'listPostsByTopic', $post->getTopic()->getId());
    }

    public function updateTopicTitle($id) {
        
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = ["title" => $title];

        $topicManager->update($data, $id);

        $this->redirectTo('forum', 'listTopicsByCategory', $topic->getCategory()->getId());
    }
}
