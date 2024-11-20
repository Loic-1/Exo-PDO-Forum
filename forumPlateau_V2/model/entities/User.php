<?php

namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity
{

    private int $id;
    private string $nickName;
    private ?string $password = null;
    private $registrationDate;
    private string $avatar;
    private string $email;
    private bool $isBanned;
    private $roles;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getIsBanned()
    {
        return $this->isBanned;
    }

    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles($roles)
    {
        $rolesJSON = json_encode($roles);

        $this->roles = $rolesJSON;

        return $this;
    }

    public function __toString()
    {
        return $this->nickName;
    }

    public function hasRole($roleSearch): Bool
    {

        // convertit le json roles en tableau roles
        $roles = json_decode($this->roles, true);

        // var_dump($roles);
        // die;

        // si $roles['roles'] est défini
        if ($roles != null && isset($roles['roles'])) {

            var_dump("test");
            die;

            // recherche sur tous les 'roles' $role de User dans $roles
            foreach ($roles['roles'] as $role) {
                if ($role == $roleSearch) {

                    // il existe un $role $roleSearch
                    return true;
                }
            }
        }

        // pas de $role $roleSearch
        return false;
    }
}
