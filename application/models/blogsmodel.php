<?php
class BlogsModel
{
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
     *  Get All Blog from database
     *
     */
    public function getLatestblogs()
    {
        $sql = "SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       blog_type, 
                       comment_count,
                       FROM blog WHERE blog_type = 'post' ORDER BY blog_id DESC LIMIT 4";
                       // Filter only where blog_type = 'post', to avoid 'draft' 
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
       
    }
    /**
     *  Show a Blog from database by ID
     */
    public function show($id, $slug)
    {  
        // ===== Count Blog read ========================================================= //
        $stmt = "UPDATE blog SET blog_read = blog_read + 1  WHERE blog_id = :id";  
        $sth = $this->db->prepare($stmt);                                          
        $sth->execute(array(':id' => $id));    

        // ===== Show One Blog Post By Blog_id============================================= //            
        $sql = "SELECT blog_id, 
                       blog_title, 
                       blog_content, 
                       blog_img, 
                       user_name, 
                       blog_date,
                       cat_id,
                       comment_count,
                       blog_like,
                       blog_read FROM blog WHERE blog_id = :id";

        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        return $query->fetch();
    } 
}    
