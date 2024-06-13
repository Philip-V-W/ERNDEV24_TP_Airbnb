<?php

namespace App\Controller;

use Core\Controller\Controller;
use Core\View\View;

class ResidenceController extends Controller
{
    /**
     * Displays the home page.
     * @return void
     */
    public function home(): void
    {
        // Create a new view for the home page
        $view = new View('home/home');
        // Render the view
        $view->render();
    }
}