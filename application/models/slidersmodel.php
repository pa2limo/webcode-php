<?php

class SlidersModel {
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection.
     *
     * Notes : This php file call and activated by Controller Class
     *         via individual file php located at folder controller.
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    
    public function getSliders()  {
    //  ===== Show All Blog Post ============================================= // 

        $sql = 'SELECT slide_id,
                       slide_title,
                       slide_content,
                       slide_url,
                       slide_img
                       FROM sliders WHERE slide_type = 1 ORDER BY slide_id DESC';  
        // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(); // Standard PDOStatement::fetchAll — Returns an array containing all of the result set rows                                 // PDOStatement::rowCount    
    }
} // end class BlogsModel  
