<?php

namespace App;

use App\Controller\AuthController;
use App\Controller\ReservationController;
use App\Controller\ResidenceController;
use App\Controller\UserController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

// Main application class that configures the database and router, and handles application startup.
class App implements DatabaseConfigInterface
{
    // Singleton instance of the application
    private static ?self $instance = null;

    /**
     * Gets the singleton instance of the application.
     * @return self The application instance.
     */
    public static function getApp(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Router instance
    private Router $router;

    /**
     * Gets the router instance.
     * @return Router The router instance.
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
        // Initialize the router
        $this->router = Router::create();
    }

    /**
     * Starts the application.
     * Initializes the session, registers routes, and starts the router.
     * @return void
     */
    public function start(): void
    {
        session_start();
        $this->registerRoutes();
        $this->startRouter();
    }

    /**
     * Registers the routes for the application.
     * @return void
     */
    private function registerRoutes(): void
    {
        // Define route pattern
        $this->router->pattern('id', '[0-9]\d*'); // we only authorize numbers for the id
        $this->router->pattern('order_id', '[0-9]\d*'); // we only authorize numbers for the order_id

        // AUTHENTIFICATION SECTION:
        $this->router->get('/login-form', [AuthController::class, 'loginForm']);
        $this->router->post('/login', [AuthController::class, 'login']);
        $this->router->get('/register-form', [AuthController::class, 'registerForm']);
        $this->router->post('/register', [AuthController::class, 'register']);
        $this->router->get('/logout', [AuthController::class, 'logout']);

        // RESIDENCE SECTION:
        $this->router->get('/', [ResidenceController::class, 'viewHomepage']);
        $this->router->get('/results', [ResidenceController::class, 'viewResults']);
        $this->router->get('/rooms/{id}', [ResidenceController::class, 'viewRooms']);
        $this->router->get('/residence', [ResidenceController::class, 'viewResidenceForm']);
        $this->router->post('/addResidenceForm', [ResidenceController::class, 'addResidenceForm']);
        $this->router->get('/user/edit-residence/{id}', [ResidenceController::class, 'editResidence']);
        $this->router->post('/user/edit-residence/{id}', [ResidenceController::class, 'editResidence']);
        $this->router->post('/user/delete-residence/{id}', [ResidenceController::class, 'deleteResidence']);

        // RESERVATION SECTION:
        $this->router->post('/submit-reservation', [ReservationController::class, 'submitReservation']);


        // USER SECTION:
        $this->router->get('/manage-listings', [UserController::class, 'manageListings']);

        // TEST SECTION:
        $this->router->get('/become_host', [UserController::class, 'becomeHost']);
        $this->router->get('/edit_property', [UserController::class, 'editProperty']);
        $this->router->get('/index', [UserController::class, 'index']);
        $this->router->get('/message', [UserController::class, 'message']);
        $this->router->get('/photo', [UserController::class, 'photo']);
        $this->router->get('/profile', [UserController::class, 'profile']);
        $this->router->get('/search', [UserController::class, 'search']);
        $this->router->get('/show', [UserController::class, 'show']);
        $this->router->get('/sponsor_form', [UserController::class, 'sponsorForm']);
        $this->router->get('/sponsor_form_update', [UserController::class, 'sponsorFormUpdate']);
        $this->router->get('/stats', [UserController::class, 'stats']);

    }

    /**
     * Starts the router to handle incoming requests.
     * @return void
     */
    private function startRouter(): void
    {
        try {
            $this->router->dispatch();
        } catch (RouteNotFoundException $e) {
            echo $e;
        } catch (InvalidCallableException $e) {
            echo $e;
        }
    }

    /**
     * Gets the database host.
     * @return string The database host.
     */
    public function getHost(): string
    {
        return DB_HOST;
    }

    /**
     * Gets the database name.
     * @return string The database name.
     */
    public function getName(): string
    {
        return DB_NAME;
    }

    /**
     * Gets the database user.
     * @return string The database user.
     */
    public function getUser(): string
    {
        return DB_USER;
    }

    /**
     * Gets the database password.
     * @return string The database password.
     */
    public function getPass(): string
    {
        return DB_PASS;
    }
}

//INFO: si on veut renvoyer une vue à l'utilisateur => route en "get"
//INFO: si on veut traiter des données d'un formulaire => route en "post"
