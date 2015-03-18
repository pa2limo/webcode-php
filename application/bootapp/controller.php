<?php

/**
 * This class "the base controller class". All other "real" controllers extend this class.
 * The main purpose that just call model class name from any custom new extend controller class
 * and handled db connection 
 */

class Controller {
    /**
     * @var null Database Connection
     */
    public $db = null; // null db connection

    /**
     * Whenever a controller is created, automaticly open a database connection via class model name. 
     * ONE connection that can be used by multiple models.
     */

    function __construct()  {
        $this->openDatabaseConnection(); 
    }

    /**
     *  Open the database connection with the credentials from application/config.php
     *  See : pre-defined data contents in application/config.php
     */

    private function openDatabaseConnection() {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
                         PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new  PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, $options);
        
    /**  EXAMPLE Use by Model File : application/models/blogsmodel.php  (examples)
      *  Class BlogsModel {
      *     function __construct($db) {
      *        try {
      *            $this->db = $db;
      *        } catch (PDOException $e) {
      *        exit('Database connection could not be established.');
      *        }
      *     }
      *     
      *     public function getAllblogs()  {
      *        $sql = 'SELECT .........  blog_type = "post" ORDER BY blog_id DESC';  
      *        $query = $this->db->prepare($sql);
      *        $query->execute();
      *        return $query->fetchAll();
      *     }
      *     ..... and another methods...
      *     .........
      *     ........
      *  }
      *  END EXAMPLE   */
    }

    /**
     * Load the model with the given name.
     * loadModel("blogsModel") would include application/models/blogsmodel.php and create the object in the blogs controller class, 
     * 
     * Examples : File application/controller/blogs.php
     * Class Blogs extend Controller {
     *      public function index() {
     *      $blogs_model = $this->loadModel('BlogsModel');
     *      $blogs = $blogs_model->getAllblogs();
     *
     * Note that the model class name is written in "CamelCase", the models filename is the same in lowercase letters
     * @param string $model_name The name of the model
     * @return object model
     */

    public function loadModel($model_name)  {
        require 'application/models/' . strtolower($model_name) . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db); // $this->db is database connection see line 40 above
    }
}
