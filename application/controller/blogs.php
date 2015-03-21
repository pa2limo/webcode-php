<?php

/**
 * Class Blogs
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Blogs extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/blogs/index
     */
    public function index() {
        // Open 3 model simultanously
        $blogs_model = $this->loadModel('BlogsModel'); // call Parent Controller Class method loadModel(BlogsModel 
        $blogs = $blogs_model->getAllblogs();          // open db method and call BlogsModel method getAllblogs()
        
        $category_model = $this->loadModel('CategorysModel');
        $category = $category_model->getCategory(); 

        $pops_model = $this->loadModel('PopsModel'); 
        $pops = $pops_model->getAllpop();

        require 'application/views/_templates/header2.php';
        require 'application/views/blogs/index.php';
        require 'application/views/_templates/footer2.php'; 
    }

    /**
     * ACTION: show individual blog
     * This method handles what happens when you move to http://yourproject/blogs/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on blogs/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to blogs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function show($id, $slug) {
    
        $blogs_model = $this->loadModel('BlogsModel');
        $blogs = $blogs_model->show($id, $slug);
              
        $comments_model = $this->loadModel('CommentsModel');
        $comments = $comments_model->getBlogcom($id, $slug);

        $category_model = $this->loadModel('CategorysModel'); 
        $category = $category_model->getCategory(); 

        $pops_model = $this->loadModel('PopsModel'); 
        $pops = $pops_model->getAllpop();

        require 'application/views/_templates/header3.php';
        require 'application/views/blogs/show.php';
        require 'application/views/_templates/footer3.php'; 
    }


    public function show_Cat($cid, $cname)  {

        $blogs_model = $this->loadModel('BlogsModel');
        $blogs = $blogs_model->getCatblogs($cid, $cname);
        
        $category_model = $this->loadModel('CategorysModel');
        $category = $category_model->getCategory();

        $pops_model = $this->loadModel('PopsModel'); 
        $pops = $pops_model->getAllpop();
              
        require 'application/views/_templates/header2.php';
        require 'application/views/blogs/index.php';
        require 'application/views/_templates/footer2.php';
    }

    public function likes($id, $slug, $likes) { 

        ++$likes;
        $blogs_model = $this->loadModel('BlogsModel');
        $blogs = $blogs_model->addLikes($id, $slug, $likes);
        
        header('location: ' .URL. 'blogs/show/'.$id.'/'.$slug.'/likes+'.$likes);      
    }   

    public function komentar() {
        $slug=$_POST["com_slug"]; 
        $id=$_POST["com_id"];
        $comm_count=$_POST["comm_count"];
       
        $pesan="thanks-for-your-comments"; 
        
        if (!empty($_POST["com_name"]) AND !empty($_POST["com_email"]) AND !empty($_POST["com_content"])) {
            //$comments_model = $this->loadModel('CommentsModel');
            $comments_model = $this->loadModel('CommentsModel');
            $comments_model->addBlogcom( $_POST["com_name"], 
                                         $_POST["com_email"], 
                                         $_POST["com_content"], 
                                         $_POST["com_slug"], 
                                         $_POST["com_id"]); 
            ++$comm_count; // update table blog comment counts
            $blogs_model = $this->loadModel('BlogsModel');
            $blogs = $blogs_model->addCounts($id, $comm_count);

            header('location: ' .URL. 'blogs/show/'.$id.'/'.$slug.'/'.$pesan);
        }
        else  {    
            $pesan="error-invalid-form-input";
            header('location: ' .URL. 'blogs/show/'.$id.'/'.$slug.'/'.$pesan);
        }
    }
}

