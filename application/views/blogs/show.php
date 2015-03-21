<body>
<div id="wrapper">
	<!-- start header -->
	<header>
		<div class="container">
        	<div class="navbar navbar-default navbar-static-top">
          
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo URL; ?>"><span>WebCode</span>/BLOG</a>
                </div>

                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">                                    
                        <li><a href="<?php echo URL; ?>" target="_blank"><h4>Home</h4></a></li>
                        <li class="active"><a href="<?php echo URL; ?>blogs/"><h4>Blogs</h4></a></li>
                        <li><a href="<?php echo URL; ?>snippets/" target="_blank"><h4>Snippet</h4></a></li>
                        <li><a href="<?php echo URL; ?>tutors/" target="_blank"><h4>Tutorial</h4></a></li>
                        <li><a href="<?php echo URL; ?>webtemplates/" target="_blank"><h4>Template</h4></a></li>
                    </ul>
                </div>

           </div> 
        </div>
	</header> <!-- end header -->

	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!--<ul class="breadcrumb">
						<li><a href="<?php // echo URL; ?>home/index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
						<li class="active">Blog</li>
					</ul>-->
				</div>
			</div>
		</div>
	</section>

	<!-- Start Main Content -->
	<section id="content">
	<div class="container">
		<?php
					srand( microtime() * 10000 );
					  $num = rand( 1, 4 );					   
					  switch( $num )  {
					  	  case 1: $images = ASSET.'img/blog/headerblog1.jpg';
						          break;
						  case 2: $images = ASSET.'img/blog/headerblog11.jpg';
						          break;
						  case 3: $images = ASSET.'img/blog/headerblog2.jpg';
						          break;
						  case 4: $images = ASSET.'img/blog/headerblog10.jpg';
						          break;
					  }
					  //echo "Random Image : <img src=$image_file />"; 

					?>
		<div class="row"><img src="<?php echo ($images);?>" alt="" />
			<div class="col-lg-8">
			<?php 
			if (isset($blogs->blog_id)) $id=$blogs->blog_id; 
			if (isset($blogs->comment_count)) $comm_count=$blogs->comment_count;
			else 
				{
					echo "<h1>error url : manual url format should be written like this</h1>  [show/id_number/slug_text] i.e <strong>show/1/Whats-New-in-PHP</strong>";?>
					<button class="btn btn-xs btn-success" data-toggle="modal" data-target=".slacker-modal"><?php echo ($comens)," "; ?>Go Back</button> <?php
				}
			?> 
			<article>  
				<div class="page-title"> 
					<h3 class="text-shadow">
					<?php if (isset($blogs->blog_title)) {
						echo ($blogs->blog_title) ; 
						$slug =create_slug($blogs->blog_title);
					}?>
					</h3>
					<img class="img-circle" src="<?php echo IMG;?>user/<?php echo ($blogs->blog_img);?>"  alt="pomosda" /><?php echo "  ",($blogs->user_name);?>
					<br><br> 
				</div>

				<?php if (isset($blogs->blog_content)) echo ($blogs->blog_content) ; ?>
				<div class="bottom-article">
					<ul class="meta-post">
						<li><span class="glyphicon glyphicon-time"></span>
					    <?php if (isset($blogs->blog_date)) {
						         $dates=date_create($blogs->blog_date);
								 echo " ", (date_format($dates,'d M Y'));
						      }  ?>	
						</li>
						<li><span class="glyphicon glyphicon-user"></span><?php if (isset($blogs->user_name)) echo " By ",($blogs->user_name); ?></li>
						<li><span class="glyphicon glyphicon-th-list"></span><?php if (isset($blogs->cat_id)) echo " ", get_catname($blogs->cat_id); ?></li>
						<li><span class="glyphicon glyphicon-eye-open"></span><?php if (isset($blogs->blog_read)) echo " ",($blogs->blog_read)," Read"; ?></li>
						<button class="btn btn-xs btn-success">
							<span class="glyphicon glyphicon-comments"></span><?php if (isset($blogs->comment_count)) echo " ",($blogs->comment_count)," "; ?>Comments
						</button>

					</ul>	
				</div>
			</article>

			<article>
			<div class="row">
				<div class="col-sm-12">
					<p class="text-left"><h4>Add Comment</h4></p><hr>
				</div>
				<?php 
				// if ((ctype_alnum($string1) == false) or (ctype_alnum($string2) == false)) {
				//	die("Sorry, you must enter alphanumerik.");
				?>

				<form id="commentForm" action="<?php echo URL.'blogs/komentar/'; ?>" method="post">
					<div class="col-sm-6">
						<input class="form-control" type="text" placeholder="Name is required" name="com_name">
					</div>
					<div class="col-sm-6">
						<input class="form-control" type="text" placeholder="Email is required" name="com_email">
					</div>
					<input type="hidden" name="com_slug" value="<?php echo ($slug); ?>">
		            <input type="hidden" name="com_id" value="<?php echo ($blogs->blog_id); ?>">
		            <input type="hidden" name="comm_count" value="<?php echo ($blogs->comment_count); ?>">
					<div class="col-sm-12">
						<br>
						<textarea class="form-control" placeholder="Type your message here... is required" rows="5" name="<?php echo 'com_content'; ?>" ></textarea><br>
						<button class="btn btn-primary" type="submit" name="submit_komentar"><i class="fa fa-reply"></i> Submit</button>
						<!--<p class="pull-right"><a href="" class="btn btn-xs btn-success" role="button">Send Message</a></p>-->
					</div>
					
				
			</div>
			</article>	    
			    <!--    <div class="col-lg-4">
				        <input type="text" class="form-control" placeholder="Name" name="com_name" />
				    </div>

				    <div class="col-lg-4">
				        <input type="text" class="form-control" placeholder="Email" name="com_email" />
				    </div>
				    <div class="form-group">
				        <textarea class="form-control" placeholder="Write comment here..." name="com_content" rows="5"></textarea>
				    </div>-->	
				    
				</form>
			
					 
			</div><!--  class="col-lg-8">-->		

			<!-- Start side page -->
			<div class="col-lg-4">
				<aside class="right-sidebar">

				<div class="widget"><br>
					<h5 class="widgetheading">Categories</h5>
					<ul class="tags">
						<?php 
						foreach ($category as $cats)	
						{  
							if (isset($cats->cat_id)) $cid=$cats->cat_id;
							if (isset($cats->cat_name)) $cname=create_slug($cats->cat_name); 
							?>
							<li><a href="<?php echo URL.'blogs/show_cat/'.$cid.'/'.$cname ; ?>"><span>
							<?php  echo ($cname),' (', ($cats->blog_count),')' ; ?> </span></a></li><?php
					    } ?>
					</ul>
				</div>

				<div class="widget">
					<h5 class="widgetheading">Most Read</h5>
					<ul class="recent">
					<?php 
					$gbr=1;
					foreach ($pops as $pop)	
					{  	
				        if (isset($pop->blog_img)) $img=$pop->blog_img;	
				        if (isset($pop->cat_name)) $cname=$pop->cat_name;
				        if (isset($pop->blog_id)) $id=$pop->blog_id; ?>			
							<li>   
							<img src="<?php echo ASSET ; ?>img/dummies/blog/65x65/thumb<?php echo $gbr ; ?>.jpg" class="pull-left" alt="" />
							<?php
							if (isset($pop->blog_title)) {
								$slug=create_slug($pop->blog_title);
							} ?>
						
						<h6><a href="<?php echo URL.'blogs/show/'.$id.'/'.$slug ; ?>">   
						     <?php echo get_words($pop->blog_title, 4); ?></a>
						</h6>
						<p><?php if (isset($pop->blog_content)) echo get_words($pop->blog_content, 11);	
						$gbr++;
					} ?></p>
					</ul>
				</div>
				
				<div class="widget">
					<h5 class="widgetheading">Social Network</h5>
						<ul class="company-social">
					        <li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
					        <li class="social-twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
					        <li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
				        <li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	            	</ul>
				</div>

				<div class="widget">
					<h5 class="widgetheading">Last Comments</h5>
					
						<?php 
						foreach ($comments as $coms)	
						{ ?>
							<p><span class="glyphicon glyphicon-user"></span> <strong><?php if (isset($coms->com_name)) echo "  ",($coms->com_name), ",   "; ?></strong>
							<span class="glyphicon glyphicon-time"></span>
							<?php 
							if (isset($coms->created_at)) {
							   $dt=date_create(($coms->created_at)); 
							   echo " ", (date_format($dt,'d M Y'));
							} ?></p>
							<p><em><?php if (isset($coms->com_content)) echo ($coms->com_content); ?></em><p><hr>					
						<?php $dates=date_create($blogs->blog_date);
								 
					    } 
					    ?> 
			
				</div>
				</aside>
			</div>
		</div>
	</div>
	</section><!-- /Start Main Content -->
</div>
