<section class="carousel">
	<div class="container">
		<?php if( have_rows('carousel_images', 'options') ): ?>
			<div class="flexslider">
				<ul class="slides">
				    <?php while( have_rows('carousel_images', 'options') ): the_row(); ?>
				    	<?php
				    		$carousel_image =  get_sub_field('carousel_image');
				    		$overlay_content = get_sub_field('overlay_text');
				    	?>
				        	<li>
								<img src="<?php echo $carousel_image['url'] ?>" alt="<?php echo $carousel_image['alt'] ?>">
								<?php if($overlay_content): ?>
									<div class="overlay">
										<div class="overlay-content">
											<?php echo $overlay_content; ?>
										</div><!-- /.overlay-content -->
									</div><!-- /.overlay -->
								<?php endif; ?>
							</li>
				    <?php endwhile; ?>
		    	</ul>
			</div><!-- /.flexslider -->
		<?php endif; ?>
	</div><!-- /.container -->
</section><!-- /.section -->