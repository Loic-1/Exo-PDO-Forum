<?php

namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use App\Session;

class SecurityController extends AbstractController
{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register()
    {
        $userManager = new UserManager();

        // on nettoie les inputs, par exemple FILTER_SANITIZE_FULL_SPECIAL_CHARS remplace < par &lt et > par &gt (pour éviter la faille XSS)
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, "mail", /*FILTER_SANITIZE_FULL_SPECIAL_CHARS, */ FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($pseudo && $mail && $pass1 && $pass2) {

            // on vérifie que $mail et $pseudo sont uniques
            if ($userManager->isUniqueMail($mail) && $userManager->isUniquePseudo($pseudo)) {

                // Longueur du mot de passe variable (12 comme exemple)
                if ($pass1 === $pass2 && strlen($pass1) >= 12) {

                    // bcrypt
                    $hash = password_hash($pass1, PASSWORD_DEFAULT);

                    $data = ["nickName" => $pseudo, "password" => $hash, "email" => $mail];

                    $userManager->add($data);
                }
            }
        }

        return [
            "view" => VIEW_DIR . "forum/register.php",
            "meta_description" => "Page d'inscription"
        ];
    }

    public function login()
    {

        $userManager = new UserManager();

        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($mail && $password) {

            $user = $userManager->findUserByMail($mail); // SELECT *, donc renvoie un objet User

            $hashedPassword = $user->getPassword();

            if (password_verify($password, $hashedPassword)) { // aaaaaaaaaaaa est la value de password dans register.php
            
                Session::setUser($user);
                var_dump($_SESSION);
                die;
            }
        }

        return [
            "view" => VIEW_DIR . "forum/login.php",
            "meta_description" => "Page de connexion"
        ];
    }

    public function logout() {

        return [
            "view" => VIEW_DIR . "home.php",
            "meta_description" => "Page d'accueil"
        ];
    }
}
