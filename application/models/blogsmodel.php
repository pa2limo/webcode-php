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
    
    public function getLatest() {
    //  ===== Show 4 Latest Blog Post ============================================= // 
    // TBLOG came from config.php : define table column select
        $sql = 'SELECT '.TBLOG.' blog_type = "post" ORDER BY blog_id DESC LIMIT 4';  
        // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllblogs()  {
    //  ===== Show All Blog Post ============================================= // 

        $sql = 'SELECT '.TBLOG.' blog_type = "post" ORDER BY blog_id DESC';  
        // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(); // Standard PDOStatement::fetchAll — Returns an array containing all of the result set rows                                 // PDOStatement::rowCount    
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
        $sql = 'SELECT '.TBLOG.' blog_id = :id'; 
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    } 
  
    public function getCatblogs($cid, $cname) { 
    //  ===== Show All Blog Post Filter By Cat_id ====================== //        
        $sql = 'SELECT '.TBLOG.' cat_id = :cid ORDER BY blog_id DESC';
        $query = $this->db->prepare($sql);
        $query->execute(array(':cid' => $cid));

        return $query->fetchAll();
    } 

    public function addBlog($blog_title, $blog_content, $blog_img, $user_name, $cat_id, $tag_id, $blog_mime_type)  {
        // clean the input from javascript code for example
        $blog_title = strip_tags($blog_title);
        $blog_content = strip_tags($blog_content);
        $blog_img = strip_tags ($blog_img); // strip_tags ($text, 'Allowable HTML tags');
        $user_name = strip_tags($user_name);
        $cat_id = strip_tags($cat_id);
        $tag_id = strip_tags($tag_id);
        $blog_mime_type = strip_tags($blog_mime_type);
        $blog_date = date("Y-m-d h:i:s");

         $sql = 'INSERT INTO blog ( blog_title,
                                    blog_content,
                                    blog_img,
                                    user_name,
                                    blog_date,
                                    cat_id,
                                    tag_id,
                                    blog_mime_type) VALUES (:blog_title,
                                                            :blog_content,
                                                            :blog_img,
                                                            :user_name,
                                                            :blog_date,
                                                            :cat_id,
                                                            :tag_id,
                                                            :blog_mime_type)'; 
        // queries
        $query = $this->db->prepare($sql);
        $query->execute(array(':blog_title' => $blog_title,
                              ':blog_content' => $blog_content,
                              ':blog_img' => $blog_img, 
                              ':user_name' => $user_name,
                              ':blog_date' => $blog_date,
                              ':cat_id' => $cat_id,
                              ':tag_id' => $tag_id,
                              ':blog_mime_type' => $blog_mime_type));
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

    public function draftBlog($id) {
        // ===== Change Blog Post to Draft  ========================== //
        $sql = 'UPDATE blog SET blog_type = "draft" WHERE blog_id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();             
    }

    public function addCounts($id, $comm_count) {
        // ===== Set Blog Comment Counts ======= //
       
        $sql = 'UPDATE blog SET comment_count = :comm_count WHERE blog_id = :id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':comm_count' => $comm_count, ':id' => $id));

        return $query->fetch();
    }  
     
} // end class BlogsModel  
