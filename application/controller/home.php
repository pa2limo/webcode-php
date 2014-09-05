<?php
/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load model to get raw data from soma database
        $news_model = $this->loadModel('homeModel');
        $news = $news_model->homenews(); 

        $pen_model = $this->loadModel('home_pentingModel');
        $pen = $pen_model->showpenting();  

        $ag_model = $this->loadModel('home_agendaModel');
        $ag = $ag_model->showAgenda(); 
        
        // load view to generate html
        require 'application/views/_templates/homeheader.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }
   
}
