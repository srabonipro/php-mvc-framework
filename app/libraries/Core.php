<?php
// Core App Class
class Core
{
    protected $currentController = 'PagesController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        // Looks in 'controller' for first value
        // ucwords() will capitalize first letter
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // Will set a new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            // Allows to filter variables as string/number 
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Breaking it into an array
            $url = explode('/', $url);
            return $url;
        }
    }
}
