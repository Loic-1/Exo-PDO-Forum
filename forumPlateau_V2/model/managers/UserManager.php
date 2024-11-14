<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct()
    {
        parent::connect();
    }

    // fait le compte des lignes ayant le même pseudo ou le même e-mail que le user selectionné, si COUNT >= 1 then false else true
    public function isUniquePseudo($pseudo): Bool
    {
        $sql = "SELECT *
                FROM user u
                WHERE u.nickName = :pseudo";

        // getMultipleResults  --  Si le return de getMultipleResults est différent de null, alors le $pseudo testé existe déjà
        return  $this->getMultipleResults(DAO::select($sql, ['pseudo' => $pseudo]), $this->className) == null ? true : false;
    }

    public function isUniqueMail($mail): Bool
    {
        $sql = "SELECT *
                FROM user u
                WHERE u.email = :mail";

        // getMultipleResults  --  Si le return de getMultipleResults est différent de null, alors le $mail testé existe déjà
        return  $this->getMultipleResults(DAO::select($sql, ['mail' => $mail]), $this->className) == null ? true : false;
    }
}
