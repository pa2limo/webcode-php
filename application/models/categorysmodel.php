<?php

class CategorysModel {
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
     * Get category from database
     */
    public function getCategory() {

        $sql = "SELECT cat_id, 
                       cat_name, 
                       blog_count 
                       FROM category ORDER BY cat_id ASC";

        $query = $this->db->prepare($sql);
        $query->execute();
 
        return $query->fetchAll();
    }
    /**
     * Get category from database
     */
    public function showCat($id, $cat) {

        $sql = "SELECT id,
                       cat_id, 
                       blog_id, 
                       snip_id, 
                       tut_id FROM category_post WHERE blog_id = :id";

        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }  
}    
