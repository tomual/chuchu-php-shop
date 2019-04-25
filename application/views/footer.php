		</main>
		<footer>
			<div class="text-muted small text-center p-5">
				&copy; 2019 Company Name
				<span class="mx-2">|</span>
				<a href="">Privacy Policy</a>
				<span class="mx-2">|</span>
				<a href="">Terms & Conditions</a>
				<span class="mx-2">|</span>
				<a href="">Contact Us</a>
			</div>
		</footer>
		<script src="<?php echo base_url('js/vendor/jquery-2.1.0.min.js') ?>"></script>
		<script src="<?php echo base_url('js/helper.js') ?>"></script>
		<script src="<?php echo base_url('js/main.js') ?>"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

	    <link href="<?php echo base_url('css/lightgallery.css') ?>" rel="stylesheet">
	    <link href="<?php echo base_url('css/lightslider.css') ?>" rel="stylesheet">
		<script src="<?php echo base_url('js/vendor/lightgallery.js') ?>"></script>
		<script src="<?php echo base_url('js/vendor/lightslider.js') ?>"></script>
		<script type="text/javascript">
			var base_url = '<?php echo base_url() ?>';
			$(document).ready(function() {
			    $('#imageGallery').lightSlider({
			        gallery:true,
			        item:1,
			        loop:true,
			        thumbItem:4,
	        		thumbnail: true,
			        slideMargin:0,
			        enableDrag: false,
			        currentPagerPosition:'left',
			        onSliderLoad: function(el) {
			            el.lightGallery({
			                selector: '#imageGallery .lslide',
			                download: false,
			            });
			        }   
			    });  
			  });
		</script>

		<script src="https://js.stripe.com/v3/"></script>
		<script src="<?php echo base_url('js/stripe.js') ?>"></script>

	</body>
</html>