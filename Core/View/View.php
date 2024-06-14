<?php

namespace Core\View;

use App\Controller\AuthController;

// This class is responsible for rendering views.
class View
{
    // Define constants for paths to views and partial templates
    public const PATH_VIEW = PATH_ROOT . 'views' . DS;
    public const PATH_PARTIALS = self::PATH_VIEW . '_templates' . DS;

    // Default title for the view
    public string $title = 'TP Airbnb';

    // Constructor to initialize view name and completeness flag
    public function __construct(private string $name, private bool $is_complete = true)
    {

    }

    // Method to get the path to the required view file
    private function getRequirePath(): string
    {
        // Split the view name to get category and name
        $arr_name = explode('/', $this->name);

        $category = $arr_name[0];
        $name = $arr_name[1];

        // Prefix view name with an underscore if it's not a complete view
        $name_prefix = $this->is_complete ? '' : '_';

        // Return the full path to the view file
        return self::PATH_VIEW . $category . DS . $name_prefix . $name . '.html.php';
    }

    // Method to render the view
    public function render(?array $view_data = [])
    {
        // Alias for AuthController class
        $auth = AuthController::class;

        // Extract view data variables if provided
        if (!empty($view_data)) {
            extract($view_data);
        }

        // Start output buffering
        ob_start();

        // Include header partial if the view is complete
        if ($this->is_complete) {
            require self::PATH_PARTIALS . '_header.html.php';
        }

        // Include the main view file
        require_once $this->getRequirePath();

        // Include footer partial if the view is complete
        if ($this->is_complete) {
            require self::PATH_PARTIALS . '_footer.html.php';
        }

        // Flush the output buffe
        ob_end_flush();
    }
}