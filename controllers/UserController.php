<?php

/**
 * UserController
 */
class UserController
{
    /**
     * Action for registration page
     */
    public function actionRegister()
    {
        // vars for a form
        $email = false;
        $password = false;
        $result = false;

        // form processing
        if (isset($_POST['submit'])) {
            // if form sended 
            // getting data from form
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Validate email
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            
            //Validate password
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == false) {
                $result = User::register($email, $password);
            }
        }

        require_once(ROOT . '/views/user/register.php');
        return true;
    }
    
    /**
     * 
     * @return boolean
     */
    public function actionLogin()
    {
        $email = false;
        $password = false;
        
        if (isset($_POST['submit'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Check for user existing 
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                // If data is wrong - show error text
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // If data is right save user in session
                User::auth($userId);

                //Redirect user to main page
                header("Location: /");
            }
        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Delete user from session
     */
    public function actionLogout()
    {
        session_start();
        
        unset($_SESSION["user"]);
        if(isset($_SESSION["search"])) {
            unset($_SESSION["search"]);
        }
        
        
        // redirect user to main page
        header("Location: /");
        return true;
    }

}