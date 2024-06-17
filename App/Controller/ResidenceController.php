<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Form\FormSuccess;
use Core\Session\Session;
use Core\View\View;
use Laminas\Diactoros\ServerRequest;

class ResidenceController extends Controller
{
    /**
     * Displays the home page.
     * @return void
     */
    public function home(): void
    {
        // Create a new view for the home page
        $view = new View('home/index');
        // Render the view
        $view->render();
    }

    /**
     * Displays the home page.
     * @return void
     */
    public function results(): void
    {
        // Create a new view for the home page
        $view = new View('home/results');
        // Render the view
        $view->render();
    }

    /**
     * Displays the home page.
     * @return void
     */
    public function rooms(): void
    {
        // Create a new view for the home page
        $view = new View('home/rooms');
        // Render the view
        $view->render();
    }

    /**
     * Displays the home page.
     * @return void
     */
    public function test(): void
    {
        // Create a new view for the home page
        $view = new View('home/test');
        // Render the view
        $view->render();
    }
}