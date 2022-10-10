<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface
{



    public function index()
    {
        return [
            "view" => VIEW_DIR . "home.php"
        ];
    }

    public function register()
    {



        return [
            "view" => VIEW_DIR . "security/register.php"
        ];
    }

    public function addUser()
    {
        $pseudo =  filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email =  filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password =  filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordRepeat =  filter_input(INPUT_POST, "password_repeat", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $userManager = new UserManager;

        $existingUser = $userManager->isExisting($pseudo, $email);

        if ($pseudo && $email && $password && $passwordRepeat && ($password == $passwordRepeat) && ($existingUser == false)) {

            $data = [
                "pseudo" => $pseudo,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
            ];


            $userManager->add($data);
            $this->redirectTo("security", "login");
        } else {

            sleep(1);
            $this->redirectTo("security", "register");
        }
    }

    public function login()
    {


        return [
            "view" => VIEW_DIR . "security/login.php"
        ];
    }

    public function checkLogin()
    {
        $email =  filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password =  filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $userManager = new UserManager;

        if ($email && $password) {
            $userId = $userManager->validatePassword($email, $password);
            if ($userId != false) {
                $session = new Session;
                $session->setUser($userManager->findOneById($userId));
                $this->redirectTo("forum");
            } else {
                $this->redirectTo("security", "login");
            }
        }
    }

    public function logout() {
        session_destroy();
        sleep(1);
        $this->redirectTo("security", "login");
    }
}
