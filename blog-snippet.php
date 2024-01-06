<?php
$args = array(
	'post_type'				=>'post',
	'posts_per_page'		=> 1,
	'orderby'				=>'date',
	'order'					=>'DESC'
);

$latestPost = new WP_Query($args);

if ( $latestPost->have_posts() ) {
    while ( $latestPost->have_posts() ) { 
    $latestPost->the_post();
		$featuredUrl = wp_get_attachment_url(get_post_thumbnail_id($latestPost->ID), 'full');
		$blogExcerpt = get_the_excerpt($latestPost->ID);
		$blogTitle = get_the_title($latestPost->ID);
		$blogLink = get_permalink($latestPost->ID);

		?>
		<div class="carousel-item blog-shift" style="background-image: url(<?php echo $featuredUrl ?>); height: 509.578px;">
			<div class="carousel-item-content-wrapper padb-2 padt-2">
				<div class="col-10 offset-1 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2 padb-2 padt-2">
					<div class="row">
						<div class="col text-center primary_font">
							<h3><?php echo $blogExcerpt; ?></h3>
						</div>
					</div>
					<div class="row">
						<div class="col text-center primary_font">
							<h2><?php echo $blogTitle ?></h2>
						</div>
					</div>
					<div class="row">
						<div class="col text-center marquee-rotator-cta">
							<a href="<?php echo $blogLink; ?>" target class="btn btn-primary">Read More</a>
						</div>
					</div>
				</div>	
			</div>	
		</div>
		<?php
	}
    wp_reset_postdata();
}?>
<script>
	
	var blogShift = document.querySelector('.blog-shift');
	var blogChild = blogShift.firstElementChild;
	var blogTarget = document.getElementById('marqueeRotator');
	var carouselInner = blogTarget.querySelector('.carousel-inner');
	var carouselItem = carouselInner.querySelector('.carousel-item');
	var carouselChild = carouselItem && carouselItem.firstElementChild;
		
	if(carouselItem && blogChild){
		Array.from(carouselItem.classList).forEach(function(className){
			if (className.startsWith('padb') || className.startsWith('padt')){
				blogChild.classList.add(className);
			}
		});
	}
	
	carouselInner.insertBefore(blogShift, carouselItem.nextSibling);
	
	document.addEventListener('DOMContentLoaded', function(){
		function cloneIndicator(){
		var carouselIndicator = document.querySelector('.carousel-indicators li:last-child');
		
		if(carouselIndicator){
			var cloneIndicator = carouselIndicator.cloneNode(true);
			var targetContainer = document.querySelector('.carousel-indicators');
			
			var dataSliteTo = parseInt(cloneIndicator.getAttribute('data-slide-to')) + 1;
			cloneIndicator.setAttribute('data-slide-to', dataSliteTo);
			
			targetContainer.appendChild(cloneIndicator);
		} else {
			console.log('no indicator');
		}
	}
	cloneIndicator()
	});
	
</script>
