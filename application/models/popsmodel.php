<?php

class PopsModel {
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
    public function getAllpop() {
        $sql = 'SELECT ' .TBLOG.' blog_type = "post" ORDER BY blog_read DESC LIMIT 3';             
                          // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
} 
