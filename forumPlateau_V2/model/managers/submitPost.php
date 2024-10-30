<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        // DAO::connect()
        parent::connect();
    }

    // requêtes spécifiques:

        public function addPost($data) {
            return $this->add($data);
        }
}