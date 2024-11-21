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

        // seul les users avec le rôle "ROLE_USER" (donc ceux avec un compte) pourront utiliser cette action
        $this->restrictTo("ROLE_USER");

        // si du texte est envoyé
        if (!empty($_POST)) {

            $postManager = new PostManager;

            // on "nettoie" les inputs (ex: '<' devient &lt et '>' devient &gt et '&' devient &amp) pour empêcher les failles XSS
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // si le champ est rempli
            if ($text) {

                // on crée le tableau associatif qui sera donné en paramètre à la fonction add()
                $data = ["text" => $text, "topic_id" => $id];

                // les clés et valeurs du tableau sont rajoutées à la BDD
                $postManager->add($data);

                Session::addFlash("success", "Nouveau message ajouté !");

                $this->redirectTo('forum', 'listPostsByTopic', $id);
            } else {

                Session::addFlash("error", "Un problème est survenu, veuillez réessayer.");
            }
        }
        $this->redirectTo("forum", "listPostsByTopic", $id);
    }

    // add topic title and first message
    public function addTopic($id) // id de category
    {

        $this->restrictTo("ROLE_USER");

        // si du texte est envoyé
        if (!empty($_POST)) {

            $topicManager = new TopicManager();
            $postManager = new PostManager();

            // on "nettoie" les inputs (ex: '<' devient &lt et '>' devient &gt et '&' devient &amp) pour empêcher les failles XSS
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // si les deux champs sont remplis
            if ($title && $text) {

                // on crée le tableau associatif qui sera donné en paramètre à la fonction add()
                $dataTitle = ["title" => $title, "category_id" => $id];

                $topicId = $topicManager->add($dataTitle);

                $dataMessage = ["text" => $text, "topic_id" => $topicId];

                $postManager->add($dataMessage);

                Session::addFlash("success", "Nouveau post & message ajoutés !");

                $this->redirectTo('forum', 'listTopicsByCategory', $id);
            }
            // Si les deux champs ne sont pas remplis
            else {

                Session::addFlash("error", "Quelque chose s'est mal passé");
            }
        }
        $this->redirectTo('forum', 'listTopicsByCategory', $id);
    }

    public function addCategory()
    {

        $this->restrictTo("ROLE_ADMIN");

        if (!empty($_POST)) {

            $categoryManager = new CategoryManager;

            // on "nettoie" les inputs (ex: '<' devient &lt et '>' devient &gt et '&' devient &amp) pour empêcher les failles XSS
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // si $name n'est pas NULL
            if ($name) {

                // on crée le tableau associatif qui sera donné en paramètre à la fonction add()
                $data = ["name" => $name];

                $categoryManager->add($data);

                Session::addFlash("success", "La catégorie a bien été rajoutée !");

                $this->redirectTo('forum', 'index');
            }
            // $name n'était pas rempli
            else {

                Session::addFlash("error", "Quelque chose s'est mal passé");
            }
        }

        $this->redirectTo('forum', 'index');
    }


    //-------------------FONCTIONS DELETE---------------------


    public function deletePost($id)
    {

        $this->restrictTo("ROLE_USER");

        $postManager = new PostManager;
        $post = $postManager->findOneById($id);

        if (isset($_POST)) {

            $postManager->delete($id);

            Session::addFlash("success", "Le message a bien été supprimé !");

            $this->redirectTo('forum', 'listPostsByTopic', $post->getTopic()->getId());
        }

        $this->redirectTo('forum', 'listPostsByTopic', $post->getTopic()->getId());
    }

    public function deleteTopic($id)
    {

        $this->restrictTo("ROLE_USER");

        $topicManager = new TopicManager;
        $topic = $topicManager->findOneById($id);

        if (isset($_POST)) {

            $topicManager->delete($id);

            Session::addFlash("success", "Le Topic a bien été posté");

            $this->redirectTo('forum', 'listTopicsByCategory', $topic->getCategory()->getId());
        }

        $this->redirectTo('forum', 'listTopicsByCategory', $topic->getCategory()->getId());
    }


    //-------------------FONCTIONS UPDATE---------------------


    public function updatePostText($id): void
    {

        $this->restrictTo("ROLE_USER");

        if ($_POST) {

            $postManager = new PostManager();
            $post = $postManager->findOneById($id);

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($text) {

                $data = ["text" => $text];

                $postManager->update($data, $id);

                Session::addFlash("success", "Le message a bien été modifié !");

                $this->redirectTo('forum', 'listPostsByTopic', $post->getTopic()->getId());
            } else {

                Session::addFlash("error", "Quelque chose s'est mal passé");
            }
        }

        $this->redirectTo('forum', 'listPostsByTopic', $post->getTopic()->getId());
    }

    public function updateTopicTitle($id)
    {
        $this->restrictTo("ROLE_USER");

        if (!empty($_POST)) {

            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($title) {

                $data = ["title" => $title];

                $topicManager->update($data, $id);

                Session::addFlash("success", "Le topic a bien été changé !");

                $this->redirectTo('forum', 'listTopicsByCategory', $topic->getCategory()->getId());
            } else {

                Session::addFlash("error", "Quelque chose s'est mal passé");
            }
        }

        $this->redirectTo('forum', 'listTopicsByCategory', $topic->getCategory()->getId());
    }
}
