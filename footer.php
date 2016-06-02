        <footer>
            <div class="container">
            <div class="row align-vert">
            	<div class="col-1-2">
            		<div>
            			<h3>Footer Heading Here</h3>
            			<p>Phone: <a href="tel:<?php the_field('telephone_number', 'options'); ?>"><?php the_field('telephone_number', 'options'); ?></a></p>
            			<p>Email: <a href="Mailto:<?php the_field('email_address', 'options'); ?>"><?php the_field('email_address', 'options'); ?></a></p>
            		</div>
            	</div><!-- .col-1-2 -->
            	<div class="col-1-2">
            		<div class="footer-socials">
            			<?php if( have_rows('social_media_icons', 'options') ): ?>
						    <?php while( have_rows('social_media_icons', 'options') ): the_row(); ?>
						    	<?php 
						    		$social_icon = get_sub_field('social_media_icon');
						    	?>
						        <a href="<?php the_sub_field('social_media_url'); ?>" target="_blank"><img src="<?php echo $social_icon['url'] ?>" alt="<?php echo $social_icon['alt'] ?>" width="30" height="30"></a>
						    <?php endwhile; ?>
						<?php endif; ?>
            		</div>
            	</div><!-- .,col-1-2 -->
            </div><!-- /.row -->
            <div class="row text-center">
            	<div class="col-1-1">
            		<?php the_field('copyright_text', 'options'); ?>
            	</div><!-- /.col-1-1 -->
            </div><!-- /.row -->
            </div><!-- /.container -->
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>