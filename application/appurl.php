<?php
class Appurl {
    /** @var all null  */
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();
    /** "Boots Up" the application:  */
    public function __construct() {
        
        $this->splitUrl(); // create array with URL parts in $url       
        if (!$this->url_controller) { // check for controller: no controller given ? load home
            require './application/controller/home.php';
            $page = new Home();
            $page->index(); 
        }elseif (file_exists('./application/controller/'. $this->url_controller .'.php')) { // check for controller            
            require './application/controller/' . $this->url_controller . '.php'; // load file, create controller
            $this->url_controller = new $this->url_controller();
            if (method_exists($this->url_controller, $this->url_action)) { // check for method exist?
                if(!empty($this->url_params)) { // Call the method and pass arguments to it                    
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    $this->url_controller->{$this->url_action}(); // No parameters given? call without parameter
                }
            } else {
                if(strlen($this->url_action) == 0) {
                    $this->url_controller->index(); // no action? call the default index() method of a selected controller
                }
                else {
                    require './application/controller/errors.php'; // defined action not existent: show the error page
                    $pg = new Errors();
                    $pg->index();
                }
            }
        // here we redirect to errors controller if no matched controller name
        } else {
            require './application/controller/errors.php';
            $pg = new Errors();
            $pg->index();
        }
    }
    /** Get and split the URL */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {   // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // Put URL parts into according properties
            $this->url_controller = isset($url[0]) ? $url[0] : null; 
            $this->url_action = isset($url[1]) ? $url[1] : null;
            // Remove controller and action from split URL
            unset($url[0], $url[1]); 
            // Rebase array keys and store the URL params
            $this->url_params = array_values($url); 
        }
    }
}
