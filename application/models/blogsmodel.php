<?php

class BlogsModel {
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
 
    public function getAllblogs()  {
    //  ===== Show All Blog Post ============================================= // 
        $sql = "SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       blog_type, 
                       comment_count,
                       blog_read,
                       blog_like
                       FROM blog WHERE blog_type = 'post' ORDER BY blog_id DESC";                     
                       // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql); // Standard Class PDO::prepare ()
        $query->execute(); // Standard PDOStatement::execute

        return $query->fetchAll(); // Standard PDOStatement::fetchAll — Returns an array containing all of the result set rows
                               
    }

    public function getLatest() {
    //  ===== Show 4 Latest Blog Post ============================================= // 
        $sql = 'SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       blog_type, 
                       comment_count,
                       blog_mime_type,
                       blog_read,
                       blog_like
                       FROM blog WHERE blog_type = "post" ORDER BY blog_id DESC LIMIT 4';              
                       // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    /**
     *  Show a Blog from database
     */
    public function show($id, $slug) {  
    // =====  Set Blog read Counts ==================================================== //
        $stmt = 'UPDATE blog SET blog_read = blog_read + 1  WHERE blog_id = :id';  
        $sth = $this->db->prepare($stmt);                                          
        $sth->execute(array(':id' => $id));    

    // ===== Show One Blog Post By Blog_id============================================= //            
        $sql = 'SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       comment_count,
                       blog_like,
                       blog_read FROM blog WHERE blog_id = :id';

        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();

    } 
  
    public function getCatblogs($cid, $cname) { 
    //  ===== Show All Blog Post Filter By Cat_id ====================== //        
        $sql = 'SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       blog_type, 
                       comment_count,
                       blog_like
                       FROM blog WHERE cat_id = :cid ORDER BY blog_id DESC';

        $query = $this->db->prepare($sql);
        $query->execute(array(':cid' => $cid));

        return $query->fetchAll();
    } 


    public function getTagblogs($tid, $tname) { 
    //  ===== Show All Blog Post By tat_id =============================== //        
        $sql = 'SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       blog_type, 
                       comment_count,
                       blog_like
                       FROM blog WHERE tag_id = :tid ORDER BY blog_id DESC';

        $query = $this->db->prepare($sql);
        $query->execute(array(':tid' => $tid));

        return $query->fetchAll();
    } 

    public function deleteBlog($id) {
        // ===== Delete Post By id =================== //
        $sql = 'DELETE FROM blog WHERE blog_id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }
    
    public function addLikes($id, $slug, $conts) {
        // ===== Add like from user to Blog  ========================== //
        $sql = 'UPDATE blog SET blog_like = :conts WHERE blog_id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':conts' => $conts, ':id' => $id));

        return $query->fetch();
               
    }

    public function addCounts($id, $comm_count) {
        // ===== Set Blog Comment Counts ======= //
        $comm_count = strip_tags($comm_count);
        $sql = 'UPDATE blog SET comment_count = :comm_count WHERE blog_id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':comm_count' => $comm_count, ':id' => $id));

        return $query->fetch();
    }
    
}    
