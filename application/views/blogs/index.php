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
                        <li><a href="<?php echo URL; ?>"><h4>Home</h4></a></li>
                        <li class="active"><a href="<?php echo URL; ?>blogs/"><h4>Blogs</h4></a></li>
                        <li><a href="<?php echo URL; ?>snippets/" target="_blank"><h4>Snippet</h4></a></li>
                        <li><a href="<?php echo URL; ?>tutorials/" target="_blank"><h4>Tutorial</h4></a></li>
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
		<div class="row">
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
			<img src="<?php echo ($images);?>" alt="" />
			<div class="col-lg-8">	

			<?php    
			$index=0;
			$pages=1; ?> 
			<div class="row setup-content" id="step-<?php echo ($pages) ; ?>"> <!-- initial <div class="row setup-content" id="step-1 --> 
			<?php 
			foreach ($blogs as $pag)	
			{  
				if (isset($pag->blog_title)) $slug=create_slug($pag->blog_title);
				if (isset($pag->blog_id)) $id=$pag->blog_id;					
				if (isset($pag->blog_img)) $img=$pag->blog_img;	
				// if (isset($pag->cat_name)) $cname=$pag->cat_name;	
				++$index;
				?> 
					<article>  
						<div class="page-title"> 
							<h3 class="text-shadow"><?php echo ($pag->blog_title); ?></h3>
							<br> 
						</div>
						<?php if (isset($pag->blog_content)) echo get_words($pag->blog_content, 70) ; ?>
						<div class="bottom-article">
							<ul class="meta-post">
								<li><span class="glyphicon glyphicon-time"></span>
								<?php if (isset($pag->blog_date)) {
									 $dates=date_create($pag->blog_date);
									 echo " ", (date_format($dates,'d M Y')); 
							     }  ?>
							    </li>
								<li><span class="glyphicon glyphicon-user"></span><?php if (isset($pag->user_name)) echo " ",($pag->user_name); ?></li>
							    <li><span class="glyphicon glyphicon-th-list"></span><?php if (isset($pag->cat_id)) echo " ", get_catname($pag->cat_id); ?> </li>
							    <li><span class="glyphicon glyphicon-eye-open"></span><?php if (isset($pag->blog_read)) echo " ",($pag->blog_read)," Read"; ?></li>
								<li><span class="glyphicon glyphicon-comment"></span><?php if (isset($pag->comment_count)) echo " ",($pag->comment_count)," "; ?> Comments</li>
							</ul>
							<a href="<?php echo URL.'blogs/show/'.$id.'/'.$slug ; ?>" class="pull-right"><strong>READ MORE</strong> </a>
						</div>
					</article> 

				<?php 
				// Set four blogs for one page
				if($index > 3) 
				{	
					$index=0;
					++$pages; 
					?>
				    </div><!-- /close <div class="row setup-content" id="step-[$pages-1]	-->
					<div class="row setup-content" id="step-<?php echo ($pages) ; ?>"> 
					<?php	

				} 
			} // end for each
			?>
			</div><!-- /close <div class="row setup-content" id="step-[latest $pages]-->
			<ul class="pagination pagination-sm setup-panel">	
				<li class="disable"><a href="#step-1">&laquo;</a></li>
				<li class="active"><a href="#step-1">1</a></li>
				<?php
				for ($i=2; $i === $pages; $i++)				  
				{ ?>
					<li class="disable"><a href="#step-<?php echo ($i); ?>"><?php echo ($i); ?></a></li> <?php	
				} ?>
					<li class="disable"><a href="#step-<?php echo ($pages); ?>">&raquo;</a></li>
				</ul>
			<!--</div> pagination-->	
			</div><!--  class="col-lg-8">	-->		

			<!-- Start side page -->
			<div class="col-lg-4">
				<aside class="right-sidebar">
				<br>
				<div class="widget">
					<form class="form-search">
						<input class="form-control" type="text" placeholder="Search..">
					</form>
				</div>

				<div class="widget">
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
						<p><?php if (isset($pop->blog_content)) echo get_words($pop->blog_content, 11), "</p>";	
						$gbr++;
					}?>
					</ul>
				</div>

				<div class="widget">
					<h5 class="widgetheading">Social Network</h5>
					<ul class="company-social">
					  <li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
					  <li class="social-twitter"><a href="https://twitter.com/web_cod" target="_blank"><i class="fa fa-twitter"></i></a></li>
					  <li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
					  <li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	            	</ul>
				</div>

				<div class="widget">
					<?php
					srand( microtime() * 8000 );
					  $num = rand( 1, 4 );					   
					  switch( $num )  {
					  	  case 1: $image_file = ASSET.'img/blog/widget2.jpg';
						          break;
						  case 2: $image_file = ASSET.'img/blog/widget3.jpg';
						          break;
						  case 3: $image_file = ASSET.'img/blog/widget4.jpg';
						          break;
						  case 4: $image_file = ASSET.'img/blog/widget5.jpg';
						          break;
					  }	?>
					<p><img src="<?php echo ($image_file) ; ?>" class="pull-left" alt="" /></p>
	            </div>
	            
				</aside>
			</div>
		</div>
	</div>
	</section><!-- /Start Main Content -->
</div>
