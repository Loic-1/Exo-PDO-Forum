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
    private string $password;
    private $registrationDate;
    private string $avatar;
    private string $email;
    private bool $isBanned;
    public $roles;

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

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = json_decode($roles);
        if (empty($this->roles)) {
            $this->roles[] = "ROLE_USER";
        }
    }

    // public function setRoles($roles)
    // {
    //     // Decode JSON roles into an array
    //     $decodedRoles = json_decode($roles, true); // 'true' converts to associative array
    //     if (!is_array($decodedRoles)) {
    //         $decodedRoles = [];
    //     }

    //     // Always ensure the "ROLE_USER" is present
    //     if (!in_array("ROLE_USER", $decodedRoles, true)) {
    //         $decodedRoles[] = "ROLE_USER";
    //     }

    //     // Add "ROLE_ADMIN" if needed
    //     if (!in_array("ROLE_ADMIN", $decodedRoles, true)) {
    //         $decodedRoles[] = "ROLE_ADMIN";
    //     }

    //     // Encode the roles back to JSON and set the property
    //     $this->roles = $decodedRoles;
    // }

    // public function addRole(string $role) {

    //     // converts json string to php array
    //     $rolesDecode = json_decode($this->roles, true);

    //     // $rolesDecode = ["ROLE_USER"];

    //     // si $role est null, alors $rolesdecode sera null
    //     if (!is_array($rolesDecode)) {

    //         // il faut donc déclarer $rolesDecode en tant qu'array
    //         $rolesDecode = [];
    //     }

    //     // si le rôle n'est pas déjà attribué
    //     if (!in_array($role, $rolesDecode, true)) {

    //         // rajoute le nouveau rôle dans $rolesDecode
    //         array_push($rolesDecode, $role);
    //     }

    //     // on encode et on met à jour l'attribut $roles
    //     $this->roles = json_encode($rolesDecode);
    // }

    public function addRole(string $role)
    {
        // si le array rentré est vide ou n'est pas du json
        if (empty($this->roles) || !is_string($this->roles)) {

            // on initialise un array qu'on encode en json
            $this->roles = json_encode(["ROLE_USER"]);
        }

        // converts json string to php array
        $rolesDecode = json_decode($this->roles, true);

        // si $rolesDecode est vide (redondant)
        if (!is_array($rolesDecode)) {

            // on le déclare
            $rolesDecode = ["ROLE_USER"];
        }

        // si le rôle n'est pas déjà attribué
        if (!in_array($role, $rolesDecode, true)) {

            // rajoute le nouveau rôle dans $rolesDecode
            array_push($rolesDecode, $role)/* $rolesDecode[] = $role*/;
        }

        // on encode et on met à jour l'attribut $roles
        $this->roles = json_encode($rolesDecode);
    }

    public function removeRole(string $role)
    {
        // si le array rentré est vide ou n'est pas du json
        if (empty($this->roles) || !is_string($this->roles)) {

            // on initialise un array qu'on encode en json
            $this->roles = json_encode(["ROLE_USER"]);
        }

        // converts json string to php array
        $rolesDecode = json_decode($this->roles, true);

        // si $rolesDecode est vide (redondant)
        if (!is_array($rolesDecode)) {

            // on le déclare
            $rolesDecode = ["ROLE_USER"];
        }

        // si le rôle n'est pas déjà attribué
        if (!in_array($role, $rolesDecode, true)) {

            for ($i = 0; $i < count($rolesDecode); $i++) {

                if ($rolesDecode[$i] === $role) {
                    array_splice($rolesDecode, $i, 1);
                }
            }
        }

        // on encode et on met à jour l'attribut $roles
        $this->roles = json_encode($rolesDecode);
    }

    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    public function __toString()
    {
        return $this->nickName;
    }
}
