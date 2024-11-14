<?php

namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController
{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register()
    {
        $userManager = new UserManager();

        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($pseudo && $mail && $pass1 && $pass2) {
            // Vérifier E-mail et Pseudo uniques

            if ($userManager->isUniqueMail($mail) && $userManager->isUniquePseudo($pseudo)) {
                //  var_dump("test");
                //  die;

                // Longueur du mot de passe variable (12 comme exemple)
                if ($pass1 === $pass2 && strlen($pass1) >= 12) {



                    $hash = password_hash($pass1, PASSWORD_DEFAULT);
                    // var_dump($pseudo, $mail, $pass1, $pass2, $hash);
                    // die;

                    $data = ["nickName" => $pseudo, "password" => $hash, "email" => $mail];

                    $userManager->add($data);
                }
            }
        }

        return [
            "view" => VIEW_DIR . "forum/register.php",
            "meta_description" => "Page de connexion"
        ];
    }

    public function login()
    {
        return [
            "view" => VIEW_DIR . "forum/login.php",
            "meta_description" => "Page de connexion"
        ];
    }

    public function logout() {}
}
