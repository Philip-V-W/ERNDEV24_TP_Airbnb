<?php

namespace App\Controller;

use App\AppRepoManager;
use App\Model\User;
use Core\Controller\Controller;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\View\View;
use Couchbase\User;
use Laminas\Diactoros\ServerRequest;

class AuthController extends Controller
{
    /**
     * Displays the login form.
     * @return void
     */
    public function loginForm(): void
    {
        // Create a new view for the login form
        $view = new View('auth/login');
        // Prepare view data with form result from the session
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];
        // Render the view with the prepared data
        $view->render($view_data);
    }

    /**
     * Displays the registration form.
     * @return void
     */
    public function registerForm(): void
    {
        // Create a new view for the registration form
        $view = new View('auth/register');
        // Prepare view data with form result from the session
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];
        // Render the view with the prepared data
        $view->render($view_data);
    }

    /**
     * Handles the registration process.
     * @param ServerRequest $request The server request containing form data.
     * @return void
     */
    public function register(ServerRequest $request): void
    {
        // Get form data from the request
        $data_form = $request->getParsedBody();

        // Create a new form result to store errors or success messages
        $form_result = new FormResult();

        // Create a new user instance
        $user = new User();

        // Validate the form data
        if (empty($data_form['email'])
            || empty($data_form['password'])
            || empty($data_form['password_confirm'])
            || empty($data_form['lastname'])
            || empty($data_form['firstname'])
            || empty($data_form['phone'])) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        } elseif ($data_form['password'] !== $data_form['password_confirm']) {
            $form_result->addError(new FormError('Les mots de passe ne correspondent pas'));
        } elseif (!$this->validEmail($data_form['email'])) {
            $form_result->addError(new FormError('L\'email n\'est pas valide'));
        } elseif (!$this->validPassword($data_form['password'])) {
            $form_result->addError(new FormError('Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre'));
        } elseif ($this->userExist($data_form['email'])) {
            $form_result->addError(new FormError('Cet utilisateur existe déjà'));
        } else {
            // Prepare user data for insertion
            $data_user = [
                'email' => strtolower($this->validInput($data_form['email'])),
                'password' => password_hash($this->validInput($data_form['password']), PASSWORD_BCRYPT),
                'lastname' => $this->validInput($data_form['lastname']),
                'firstname' => $this->validInput($data_form['firstname']),
                'phone' => $this->validInput($data_form['phone'])
            ];

            // Add the user to the database
            AppRepoManager::getRm()->getUserRepository()->addUser($data_user);
        }

        // Handle form result
        if ($form_result->hasErrors()) {
            // If there are errors, save them in the session and redirect to the registration form
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/inscription');
        }

        // Clear the password for security reasons and save the user in the session
        $user->password = '';
        Session::set(Session::USER, $user);
        Session::remove(Session::FORM_RESULT);
        self::redirect('/');
    }

    /**
     * Handles the login process.
     * @param ServerRequest $request The server request containing form data.
     * @return void
     */
    public function login(ServerRequest $request): void
    {
        // Get form data from the request
        $data_form = $request->getParsedBody();

        // Create a new form result to store errors or success messages
        $form_result = new FormResult();

        // Create a new user instance
        $user = new User();

        // Validate the form data
        if (empty($data_form['email']) || empty($data_form['password'])) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        } elseif (!$this->validEmail($data_form['email'])) {
            $form_result->addError(new FormError('L\'email n\'est pas valide'));
        } else {
            // Sanitize and find the user by email
            $email = strtolower($this->validInput($data_form['email']));
            $user = AppRepoManager::getRm()->getUserRepository()->findUserByEmail($email);
            // Verify the password
            if (is_null($user) || !password_verify($this->validInput($data_form['password']), $user->password)) {
                $form_result->addError(new FormError('Email ou mot de passe incorrect'));
            }
        }

        // Handle form result
        if ($form_result->hasErrors()) {
            // If there are errors, save them in the session and redirect to the login form
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/connexion');
        }

        // Clear the password for security reasons and save the user in the session
        $user->password = '';
        Session::set(Session::USER, $user);
        Session::remove(Session::FORM_RESULT);
        self::redirect('/');
    }

}