<?php

namespace App\Controller;

use App\AppRepoManager;
use App\Model\User;
use Core\Controller\Controller;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\View\View;
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
            $form_result->addError(new FormError('Please fill in all fields'));
        } elseif ($data_form['password'] !== $data_form['password_confirm']) {
            $form_result->addError(new FormError('Passwords do not match'));
        } elseif (!$this->validEmail($data_form['email'])) {
            $form_result->addError(new FormError('The email is not valid'));
        } elseif (!$this->validPassword($data_form['password'])) {
            $form_result->addError(new FormError('The password is not strong enough'));
        } elseif ($this->userExist($data_form['email'])) {
            $form_result->addError(new FormError('This email is already registered'));
        } elseif (strlen($data_form['phone']) < 10) {
            $form_result->addError(new FormError('The phone number is not long enough'));
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
            $user = AppRepoManager::getRm()->getUserRepository()->addUser($data_user);
        }

        // Handle form result
        if ($form_result->hasErrors()) {
            // If there are errors, save them in the session and redirect to the registration form
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/register-form');
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
            self::redirect('/login-form');
        }

        // Clear the password for security reasons and save the user in the session
        $user->password = '';
        Session::set(Session::USER, $user);
        Session::remove(Session::FORM_RESULT);
        self::redirect('/');
    }

    /**
     * Validates the email format.
     * @param string $email The email to validate.
     * @return bool True if the email is valid, false otherwise.
     */
    public function validEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validates the password strength.
     * @param string $password The password to validate.
     * @return bool True if the password is strong, false otherwise.
     */
    public function validPassword(string $password): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password);
    }

    /**
     * Checks if a user exists by email.
     * @param string $email The email to check.
     * @return bool True if the user exists, false otherwise.
     */
    public function userExist(string $email): bool
    {
        $user = AppRepoManager::getRm()->getUserRepository()->findUserByEmail($email);
        return !is_null($user);
    }

    /**
     * Sanitizes input data.
     * @param string $data The data to sanitize.
     * @return string The sanitized data.
     */
    public function validInput(string $data): string
    {
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Checks if a user is authenticated.
     * @return bool True if the user is authenticated, false otherwise.
     */
    public static function isAuth(): bool
    {
        return !is_null(Session::get(Session::USER));
    }

    /**
     * Logs out the user.
     * @return void
     */
    public function logout(): void
    {
        // Remove the user from the session
        Session::remove(Session::USER);
        // Redirect to the home page
        self::redirect('/');
    }
}