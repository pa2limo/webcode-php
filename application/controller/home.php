<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // create object, activate BlogsModel and established db connection 
        $sliders_model = $this->loadModel('SlidersModel');
        $sliders = $sliders_model->getSliders();
         
        $blogs_model = $this->loadModel('BlogsModel'); 
        $blogs = $blogs_model->getLatest(); 
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header1.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer1.php';
    }
}
