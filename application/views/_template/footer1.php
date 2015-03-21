<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="widget">
					<h5 class="widgetheading">Get in touch with us</h5>
					<address>
					<strong>Webcode <span class="koneng">Nusantara</span> Group</strong><br>
					 KH Wachid Hasyim No. 375, Kode Pos 64483<br>
					 Tanjunganom - Nganjuk<br>
					 <strong>INDONESIA</strong></address>
					<p>
						<i class="fa fa-phone"></i> +62 358-554323<br>
						<i class="fa fa-envelope"></i> tech@webcode.or.id
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="widget">
					<h5 class="widgetheading">Pages</h5>
					<ul class="link-list">
						<li><a href="<?php echo URL; ?>legalterms/" target="_blank">Privacy Policy</a></li>
						<li><a href="<?php echo URL; ?>blogs/" target="_blank">Blog Post - Web Technology</a></li>
                        <li><a href="<?php echo URL; ?>snippets/" target="_blank">Snippet - PHP and Bootstrap 3</a></li>
                        <li><a href="<?php echo URL; ?>tutors/" target="_blank">Tutorial</a></li>
                        <li><a href="<?php echo URL; ?>webtemplates/" target="_blank">Web Templates</a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="widget">
					<h5 class="widgetheading">Flickr photostream</h5>
					<div class="flickr_badge">
						<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=34178660@N03">
						</script>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-lg-8">
					<div class="copyright">
						<p><span class="koneng">&copy; WEBCODE 2014</span> All right reserved. 
							<a href="http://www.webpagetest.org/result/150309_G8_R66/" target="_blank">
								<img src="<?php echo ASSET.'img/home/wpt.png';?>" alt="WEBpageTest"></a>
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<ul class="company-social">
					  <li class="social-facebook"><a href="https://www.facebook.com/webcode.nusantara.group" target="_blank"><i class="fa fa-facebook"></i></a></li>
					  <li class="social-twitter"><a href="https://twitter.com/web_cod" target="_blank"><i class="fa fa-twitter"></i></a></li>
					  <li class="social-github"><a href="https://github.com/pa2limo/webcode-php" target="_blank"><i class="fa fa-github"></i></a></li>
					  <li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	            	</ul>
				</div>
			</div>
	</div>
</footer>
<!--<p><a href="http://validator.w3.org/check?uri=http://.........." target="_blank"><small>HTML</small><sup>5</sup></a></p>-->
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<script src="<?php echo ASSET; ?>js/jquery.fancybox.pack.js"></script>
<!--<script src="<?php // echo ASSET; ?>js/jquery.fancybox-media.js"></script>-->
<script src="<?php echo ASSET; ?>js/jquery.flexslider.js"></script>
<script src="<?php echo ASSET; ?>js/animate.js"></script>
<script src="<?php echo ASSET; ?>js/custom.js"></script>

<script type="text/javascript">
$(document).ready(function() {  
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');
    allWells.hide();
    navListItems.click(function(e){
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    $('ul.setup-panel li.active a').trigger('click');
    
    /*DEMO ONLY 
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    }) */ 
}); 
</script> 
</body>
</html>
