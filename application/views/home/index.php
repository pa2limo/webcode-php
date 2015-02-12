/* This home/index.php 
 * 
 * strat application here
 * purpose to view main menu
 * 
 */
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
                    <a class="navbar-brand" href="<?php echo URL; ?>home/index.php"><span>Web</span>Code</a>
                </div>

                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo URL; ?>/home/index.php"><h4>Home</h4></a></li>
                        <li><a href="<?php echo URL; ?>/blogs/index.php" target="_blank"><h4>Blogs</h4></a></li>
                        <li><a href="<?php echo URL; ?>/snippets/index.php" target="_blank"><h4>Snippet</h4></a></li>
                        <li><a href="<?php echo URL; ?>/tutors/index.php" target="_blank"><h4>Tutorial</h4></a></li>
                        <li><a href="<?php echo URL; ?>/webtemplates/index.php" target="_blank"><h4>Template</h4></a></li>
                    </ul>
                </div>

           </div> 
        </div>
	</header> <!-- end header -->

    <!-- SEGMEN-1 carousel slider -->
	<section id="featured"> <!-- start slider -->
		<div class="container"> 
			<div class="row">
				<div class="col-lg-12"> 
	        		<div id="main-slider" class="flexslider"><!-- Slider -->	
	            		<ul class="slides">
			              <li>
			                <img src="<?php echo ASSET; ?>img/slides/6.jpg" alt="" />
			                <div class="flex-caption">
			                		<ul class="company-social">
					  <li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
					  <li class="social-twitter"><a href="https://twitter.com/web_cod" target="_blank"><i class="fa fa-twitter"></i></a></li>
					  <li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
					  <li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	            	</ul>
			                    <h3>Tutorial Center</h3> 
								<p>Rich learning resources to boost your skill, build PHP based webapp quickly. </p> 
								<a href="<?php echo URL; ?>tutorials/index.php" class="btn btn-theme">Learn More</a>
			                </div>
			              </li>
			              <li>
			                <img src="<?php echo ASSET; ?>img/slides/10ss.jpg" alt="" />
			                <div class="flex-caption">
			                    <ul class="company-social">
				<li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li class="social-twitter"><a href="https://twitter.com/web_cod" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
				<li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
					            	</ul>
			                    <h3>Webtech Blog</h3> 
								<p>Tips and Tricks from Web Master around the world. PHP within lib packages the simplest way.</p> 
								<a href="<?php echo URL; ?>blogs/index.php" class="btn btn-theme">Learn More</a>
			                </div>
			              </li>
			              <li>
			                <img src="<?php echo ASSET; ?>img/slides/123.jpg" alt="" />
			                <div class="flex-caption">
			                    
			                    <ul class="company-social">
			        <li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li class="social-twitter"><a href="https://twitter.com/web_cod" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
				<li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						            </ul> 		                	
									<h3>Web Template</h3>
								    <p>Provide more webpage template make you should only focus on logic scheme coding.</p>
								    <a href="<?php echo URL; ?>webtemplates/index.php" class="btn btn-theme">Learn More</a> 
					           </div>
			              </li>

			            <li>
			                <img src="<?php echo ASSET; ?>img/slides/18.jpg" alt="" />
			                <div class="flex-caption">
			                    
			                    <ul class="company-social">
				<li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li class="social-twitter"><a href="https://twitter.com/web_cod" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
				<li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						        </ul> 		                	
								<h3>Code Snippets</h3>
								<p>Usefull PHP snippets with more tips and tricks powered by MVC skeleton.</p>
								<a href="<?php echo URL; ?>snippets/index.php" class="btn btn-theme">Learn More</a> 
					        </div>
			            </li>
	            		</ul>
	        		</div> <!-- end slider -->
				</div>
				<h2 class="text-shadow aligncenter">FREE WEB-TECHNOLOGY LEARNING RESOURCES</h2>
			</div>
		</div>
</section>

<div class="solidline"></div>
<h3 class="text-shadow aligncenter">LATEST POST</h3>
<section id="content">
	<div class="container">
		<!-- SEGMEN-3.1 -->
		<div class="row"> <!-- row outer -->
			<?php 	 
		 	foreach ($blogs as $homes)
		 	{ 
		 	if (isset($homes->blog_img)) $img=$homes->blog_img;
		 	if (isset($homes->blog_title)) $slug=create_slug($homes->blog_title);
		 	?>
			<div class="col-xs-12 col-sm-6 col-md-3">
		 		<div class="thumbnail">
		 			<img src="<?php echo ASSET;?>img/home/<?php echo ($homes->blog_mime_type); ?>" alt="Latest Post">
              		<div class="caption"> 
              			<?php 
						if (isset($homes->blog_id)) $id=$homes->blog_id;
						if (isset($homes->blog_title)) 
						{
							$jud = get_words ($homes->blog_title, 3 ) ;
							echo "<h5>", ($jud),"</h5>";
						} 
						if (isset($homes->blog_date)) 
						{
						   	$tgl=tanggal_id($homes->blog_date); 	   		 
				  		}		   		 
			            if (isset($homes->blog_content)) 
			            {
			             	$t=$homes->blog_content;
			            	$tampil= get_words($t, 20);
			            	echo "<p><h6>", ($tampil),"</h6></p>";
			            } ?>		           
			            <p><span class="label label-primary"><?php echo ($tgl);?></span> 
			            <span class="label label-warning"><a href="<?php echo URL.'/blogs/show/'.$id.'/'.$slug ; ?>">Read More...</a></span></p>

			        </div><!-- /caption -->
		 		</div><!-- /thumbnail -->
		 	</div><!-- /col-xs-12 col-sm-6 col-md-3 -->
	<?php } ?>   

		</div><!-- /row -->
	
		<div class="solidline"></div>
		
		<div class="col-lg-12">
				<div id="pagination">
			    	<div class="row setup-content" id="step-1">
			            <h2 class="text-shadow aligncenter"><p class="biruku">The Perfect Storm: Internet Boom of the Early 1990s</p></h2>
						<p>Building on Tim Berner-Lee’s initial browser prototype, a team at the <strong>National Center
						of Supercomputing Applications (NCSA)</strong> decided to implement their own version. With
						that, the first popular browser was born: NCSA Mosaic. One of the programmers on
						the NCSA team, Marc Andreessen, partnered with Jim Clark to found Mosaic Communications in October 1994. The company was later renamed <strong>Netscape</strong>, and it shipped
						Netscape Navigator 1.0 in December 1994. By this point, it was already clear that the
						World Wide Web was bound to be much morethan just an academic curiosity.</p>
						<p>In fact, that same year the first World Wide Web conference was organized in Geneva,
						Switzerland, which led to the creation of the World Wide Web Consortium (<strong>W3C</strong>) to
						help guide the evolution of HTML. Similarly, a parallel HTTP Working Group (HTTPWG) was established within the <strong>IETF</strong> to focus on improving the HTTP protocol. Both
						of these groups continue to be instrumental to the evolution of the Web.
						Finally, to create the perfect storm, CompuServe, AOL, and Prodigy began providing
						<strong>dial-up Internet access</strong> to the public within the same 1994–1995 time frame. Riding on
						this wave of rapid adoption, Netscape made history with a wildly successful IPO on
						August 9, 1995—the Internet boom had arrived, and everyone wanted a piece of it!</p> <br>
			    	</div>

			    	<div class="row setup-content" id="step-2">
			            <h2 class="text-shadow aligncenter"><p class="ijoku">Hypertext, Web Pages, and Web Applications</p></h2>
						<p>The evolution of the Web over the course of the last few decades has given us at least
						three different classes of experience: the hypertext document, rich media web page, and
						interactive web application. Admittedly, the line between the latter two may at times be
						blurry to the user, but from a performance point of view, each requires a very different
						approach to our conversation, metrics, and the definition of performance.</p>
						<strong>Hypertext documents</strong> were the genesis of the World Wide Web, the plain text version with 
						some basic formatting and support for hyperlinks. This may not sound exciting by modern standards.<br>
						<strong>Web page</strong> The HTML working group and the early browser vendors extended the definition
						of hypertext to support additional hypermedia resources, such as images and audio,
						and added many other primitives for richer layouts. The era of the  web page  has
						arrived, allowing us to produce visual layouts with various media types.<br>
						<strong>Web application</strong> Addition of JavaScript and later revolutions of Dynamic HTML and 
						AJAX shook things up once more and transformed the simple web page into an interactive web application, 
						which allowed it to respond to the user directly within the browser.<br><br>
			    	</div>

			    	<div class="row setup-content" id="step-3"> 
			    		<h2 class="text-shadow aligncenter"><p class="coklat">Intertwined History of TCP and IP Protocols</p></h2>
						We are all familiar with <strong>IPv4 and IPv6</strong>, but what happened to IPv{1,2,3,5}? The 4 in IPv4
						stands for the version 4 of the TCP/IP protocol, which was published in September 1981.
						The original TCP/IP proposal coupled the two protocols, and it was the v4 draft that
						officially split the two into separate RFCs. Hence, the v4 in IPv4 is a heritage of its
						relationship to TCP: there were no prior, standalone IPv1, IPv2, or IPv3 protocols.
						When the working group began work on “Internet Protocol next generation” (IPng) in
						1994, a new version number was needed, but v5 was already assigned to another experimental protocol: Internet Stream Protocol (ST). As it turns out, ST never took off,
						which is why few ever heard of it. Hence the 6 in IPv6. IPv4 has 32-bit addressing code equally to four billion address. 
						Recently years, IPv4 addressing capacity has not enough. 
			    	</div>

			    	<div class="row setup-content" id="step-4">  
			          	<h2 class="text-shadow aligncenter"><p class="oranye">PHP History</p></h2> 
						PHP development began in 1994 when <strong>Rasmus Lerdorf</strong> wrote a series of Common Gateway Interface (<strong>CGI</strong>) binaries in <strong>C Language</strong>, 
						which he used to maintain his personal homepage. He extended them to add the ability to work with web forms and to communicate with databases, and called this implementation "Personal Home Page/Forms Interpreter" or PHP/FI.
						PHP/FI could be used to build simple, dynamic web applications. Lerdorf initially announced the release of PHP/FI as "Personal Home Page Tools (PHP Tools) version 1.0" publicly to accelerate bug location and improve the code, 
						on the Usenet discussion group comp.infosystems.www.authoring.cgi on June 8, 1995. While PHP originally stood for Personal Home Page, it now stands for <strong>PHP: Hypertext Preprocessor</strong>, which is a recursive backronym.
						This release already had the basic functionality that PHP has as of 2013. This included Perl-like variables, form handling, and the ability to embed HTML. The syntax resembled that of Perl but was simpler, more limited and less consistent
						Early PHP was not intended to be a new programming language, and grew organically, with Lerdorf noting in retrospect: "I don’t know how to stop it, there was never any intent to write a programming language […] 
						I have absolutely no idea how to write a programming language, I just kept adding the next logical step on the way."
						A development team began to form and, after months of work and beta testing, officially released PHP/FI 2 in November 1997.
						<strong>Zeev Suraski and Andi Gutmans</strong> rewrote the parser in 1997 and formed the base of PHP 3, changing the language's name to the recursive acronym PHP: Hypertext Preprocessor
						Afterwards, public testing of PHP 3 began, and the official launch came in June 1998. Suraski and Gutmans then started a new rewrite of PHP's core, producing the Zend Engine in 1999.
						They also founded Zend Technologies in Ramat Gan, Israel.
						In 2008 PHP 5 became the only stable version under development. Late static binding had been missing from PHP and was added in version 5.3, included new features such as improved support for object-oriented programming.
						Stable Version with security fixed are availiable at official PHP website <strong>php.net, recommended to use</strong> Version : 5.4.34, 5.5.18 and latest stable 5.6.2.
             		</div>

			    	<div class="row setup-content" id="step-5"> 
			    		<h2 class="text-shadow aligncenter"><p>TOP 10 Countries with Most Internet Connection Speeding</p></h2>
			    		<strong>Akamai Technologies</strong>, a provider of cloud services and internet monitoring, released the State of the <strong>Internet report second quarter 2014</strong> One revealed in the report is about the speed of Internet access statistical globally. 
						Based on the data gathered from the Akamai Intelligent Platform, revealed that the average speed of internet access across the world have increased 21% compared to the first quarter of 2014, from the original 3.9 Mbps to 4.6 Mbps. 
						<p>According to Akamai, the average speed of the global Internet for the first time has exceeded the threshold speed of 4 Mbps Akamai categorized as broadband internet. 
						The largest increases experienced by Hong Kong.</p> 
						<p>The average speed Internet access in Hong Kong rose 18 percent with an average connection of 15.7 Mbps. Japanese displaced from position two to four with an average speed of 14.9 Mbps internet. 
						The third rank is occupied Switzerland with an average connection speed of 14.9 Mbps as well.</p> 
						• <strong>South Korea 24.6 Mbs</strong><br>
						• Hongkong 15.7 Mbs<br>
						• Switzerland 14.9 Mbs<br>
						• Japan 14.9 Mbs<br>
						• Netherland 14.3 Mbs<br>
						• Sweden 13.6 Mbs<br>
						• Latvia 13.5 Mbs<br>
						• Ireland 12.6 Mbs<br>
						• Cech Republic 12.6 Mbs<br>
						• Romania 11.8 Mbs<br>
						</p>  
			    	</div>

			    	<div class="row setup-content" id="step-6">  
			          	<h2 class="text-shadow aligncenter"><p>Better done than perfect</p></h2>  
						Often we need to revise repeated many times until you are happy before submitting your work. The reason is simple: you consider your work 'less than perfect'. 
						In fact, perfection requires time. While you will not have more time. So, much better you finish your work rather than having to wait for them perfectly. You will be more productive. 
						Your work will be more complete. Well buddy Studentpreneur, what other way do you use to be more productive? Build the best web application not just have full skilled bullets on hand. 
						Perfect works just imagine. Daily stuffs should be correct properly, break more time on our social communities. We are invest time to completly our pojects.       
			    	</div>

			    	<ul class="pagination pagination-sm setup-panel">					  
						  <li class="active"><a href="#step-1">1</a></li>
						  <li class="disable"><a href="#step-2">2</a></li>
						  <li class="disable"><a href="#step-3">3</a></li>
						  <li class="disable"><a href="#step-4">4</a></li>
						  <li class="disable"><a href="#step-5">5</a></li>
						  <li class="disable"><a href="#step-6">6</a></li>
						  <li class="disable"><a href="#step-1">WEB HISTORY NOTES</a></li>
					</ul>
					
				</div><!-- /paginator -->
			</div><br> <!-- /col-lg-12 -->	
	</div><!-- /container pagination -->
	
	<div class="solidline"></div><!-- SEGMEN-3 end -->
	
	<div class="container"><!-- SEGMEN-4 Portfolio Projects -->
		<div class="row">
			<div class="col-lg-12">
				<h2 class="text-shadow aligncenter">Free PHP-MySQL Website with Bootstrap</h2>
				<div class="col-lg-3 aligncenter">
					<a href="#"><img src="<?php echo ASSET; ?>img/works/webcode.jpg" alt="" />
					<strong>Webcode Site</strong></a>
				</div>
				<div class="col-lg-3 aligncenter">
					<a href="#"><img src="<?php echo ASSET; ?>img/works/webcode2.jpg" alt="" />
					<strong>Pomosda Site</strong></a>
				</div>
				<div class="col-lg-3 aligncenter">
					<a href="#"><img src="<?php echo ASSET; ?>img/works/3.jpg" alt="" />
					<strong>Web-3 Site</strong></a>
				</div>
				<div class="col-lg-3 aligncenter">
					<a href="#"><img src="<?php echo ASSET; ?>img/works/4.jpg" alt="" />
					<strong>Web-4 Site</strong></a>
				</div>
			</div>	<!-- /col-lg-12 -->		
		</div>	<!-- /row -->
	</div> <!-- /container -->				
		
	</section><!-- /Section END -->
</div> <!-- /wrapper -->
