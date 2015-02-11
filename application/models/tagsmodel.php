<?php

class TagsModel {
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
     * Get all tag from database
     */
    public function getAlltag() {

        $sql = "SELECT tag_id, 
                       tag_name, 
                       blog_count 
                       FROM tag ORDER BY tag_id ASC";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getTag($tid, $tname) {    

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
