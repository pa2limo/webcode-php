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
                    <a class="navbar-brand" href="<?php echo URL; ?>home/"><span>WebCode</span></a>
                </div>

                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo URL; ?>home/" target="_blank"><h4>Home</h4></a></li>
                        <li><a href="<?php echo URL; ?>blogs/"><h4>Blogs</h4></a></li>
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
		<div class="row"><img src="<?php echo ASSET ; ?>img/blog/headerblog9.jpg" alt="" />		
			<div class="col-lg-8">	
				<article> 
					<div class="page-title"> 
						<h3 class="text-shadow">Privacy Policy</h3><br> 
						<p>This is a privacy policy for WebCode your privacy. Below is an outline of the information that WebCode gathers, 
							how it’s used, and how you can “opt-out”.</p>
						<p><strong><h4>Site Visits:</h4></strong></p>
						<p>Whenever you request a page through your browser, navigation and clickstream data such as:<br>
						•	your IP address,<br>
						•	browser and version,<br>
						•	operating system,<br>
						•	date and time and<br>
						•	the site from which you came are stored in a log file and/or database.</p>
						<p>Any search terms that you enter into the WebCode Site Search are also logged. 
							This information cannot be used to identify specific individuals, and is only used for:<br>
						•	Website and system administration,<br>
						•	research and development,<br>
						•	anonymous user analysis, and<br>
						•	to provide accurate statistics in the form of aggregated data.<br>
						This information is kept on a secure dedicated server hosted by Techscape as well as servers within the WebCode offices.</p>
						<p><strong><h4>Email addresses:</h4></strong></p>
						<p>The email addresses collected from subscriptions to the WebCode are not sold, or disclosed to any third parties. 
							You will not receive any mailings you did not request. The email addresses collected at WebCode are stored on a server hosted by Techscape.</p>
						<p><strong><h4>Posts:</h4></strong></p>
						<p>Any postings in our Tuts, Snippets or Blogs should be considered public knowledge and will be accessible by search engine spiders. 
						This includes any information you provide in the “profile” associated with any accounts you have at WebCode. 
						WebCode will not retroactively edit your username, profile or posted messages.</p>
						<p><strong><h4>Messages:</h4></strong></p>
						<p>Any messages sent through WebCode’s servers, including person-to-person communcations, are unencrypted and may be accessed by WebCode Administrator.
						WebCode complies with all law enforcement agency requests for information. Any data collected will be used by ourselves. 
						If you have questions regarding our privacy policies, or require assistance in opting out of our email lists, please contact privacy at webcode.or.id</p>

					</div><br>
					<hr> 
					<div class="page-title"> 
						<h3 class="text-shadow">Terms and Conditions</h3><br> 
						<p>1. The materials displayed on this website, including without limitation, all editorial materials, information, photographs, illustrations, 
							artwork and other graphic materials, and names, logos and trade marks, are protected by copyright, trade mark and other intellectual property laws. 
							Any such content may be displayed and printed solely for your personal, non-commercial use within your organization only. 
							You agree not to reproduce, retransmit, distribute, disseminate, sell, publish, broadcast or circulate any such material to any third party 
							without the express prior written consent of WebCode.Save for the above, WebCode does not grant any license or right in, or assign all or part of, its intellectual property rights in the content or applications incorporated into the website or in the user interface of the website.</p>
						<p>2. You acknowledge and accept that the information contained on this website (the website information) may include technical inaccuracies. 
							You acknowledge and accept that the website information is subject to change at any time and may not necessarily be up to date or accurate at the time you view it. 
							You should enquire with us directly to ensure the accuracy and currency of the material you seek to rely upon.</p>
						<p>3. To the extent permitted by law, WebCode disclaims all warranties with regard to the information and applications contained on the website and your use of the website, 
							including all implied warranties of merchantability and fitness. 
							These Terms and Conditions do not exclude warranties or conditions which WebCode cannot, by law, exclude. 
							These Terms and Conditions do not exclude any liability which any law requires WebCode to accept.</p>
						<p>4. This website and the materials displayed on it may not be accessible from time to time due to act of God or other force majeure events, including inability to obtain or shortage of necessary materials, equipment facilities, power or telecommunications, lack of telecommunications equipment or facilities and failure of information technology or telecommunications equipment or facilities.</p>
						<p>5. You must not attempt to change, add to, remove, deface, hack or otherwise interfere with this website or any material or content displayed on this website.</p>
						<p>6. In the event that a dispute arises from these terms and Conditions, you agree to submit to the non-exclusive jurisdiction of the courts of Indonesia.</p>
					</div>
				</article> 
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
					<p>
	            		<img src="<?php echo ASSET ; ?>img/blog/widget0.jpg" class="pull-left" alt="" />
	            	</p>
	            </div>
				</aside>
			</div>
		</div>
	</div>
	</section><!-- /Start Main Content -->
</div>
