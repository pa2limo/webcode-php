<?php

class CommentsModel {
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    /**
     * Get blog comments from database load by blog_id
     * @param string $id as blog_id 
     */       
    public function getBlogcom($id, $slug) {

        $sql = "SELECT com_id, 
                       com_content, 
                       com_img, 
                       com_email,
                       blog_id,
                       com_name,
                       created_at FROM comment WHERE blog_id = :id and is_published = 1 ORDER BY com_id DESC LIMIT 8";
        // queries            
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetchAll();
    }
     
    /**
     * Add a blog comment to database
     * @param string $com_name  user name 
     * @param string $com_email  user email
     * @param string $com_content user comment
     * @param string $com_id comment id
     */
    public function addBlogcom($com_name, $com_email, $com_content, $com_slug, $com_id)  {
        // clean the input from javascript code for example
        $com_name = strip_tags($com_name);
        $com_email = strip_tags($com_email);
        $com_content = strip_tags($com_content, '<p>'); // strip_tags ($text, 'Allowable HTML tags');
        $com_id = strip_tags($com_id);
        $created_at = date("Y-m-d h:i:s");

        $sql = "INSERT INTO comment (com_name,
                                     com_email, 
                                     com_content,
                                     blog_id,
                                     created_at) VALUES (:com_name,                                    
                                                         :com_email,
                                                         :com_content,
                                                         :com_id,
                                                         :created_at)"; 
        // queries
        $query = $this->db->prepare($sql);
        $query->execute(array(':com_name' => $com_name,
                              ':com_email' => $com_email,
                              ':com_content' => $com_content, 
                              ':com_id' => $com_id,
                              ':created_at' => $created_at));

     }
   
    /**
     * Delete comment from database handled by blog_id
     * @param string $id as blog_id 
     * This method is only enable to admin users
     */ 
    public function deleteBlogcom($id) {

        $sql = "DELETE FROM comment WHERE com_id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }

    /**
     * Get blog comments from database load by blog_id
     * @param string $id as blog_id 
     */       
    public function getTutcom($id, $slug) {

        $sql = "SELECT com_id, 
                       com_content, 
                       com_img, 
                       com_email,
                       tut_id,
                       com_name,
                       created_at FROM com_tut WHERE tut_id = :id ORDER BY com_id DESC";
        // queries            
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetchAll();
    }
     
    public function addTutcom($com_name, $com_email, $com_content, $com_slug, $com_id) {
        // clean the input from javascript code for example
        $com_name = strip_tags($com_name);
        $com_email = strip_tags($com_email);
        $com_content = strip_tags($com_content);
        $com_id = strip_tags($com_id);
        $created_at = date("Y-m-d h:i:s");

        $sql = "INSERT INTO com_tut (com_name,
                                     com_email, 
                                     com_content,
                                     tut_id,
                                     created_at) VALUES (:com_name,                                    
                                                         :com_email,
                                                         :com_content,
                                                         :com_id,
                                                         :created_at)"; 
        // queries
        $query = $this->db->prepare($sql);
        $query->execute(array(':com_name' => $com_name,
                              ':com_email' => $com_email,
                              ':com_content' => $com_content, 
                              ':com_id' => $com_id,
                              ':created_at' => $created_at));

    }
   
    
    public function deleteTutcom($id) {
        
        $sql = "DELETE FROM com_tut WHERE com_id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }
}
