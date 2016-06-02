<?php get_header(); ?>




<?php get_template_part('_part-carousel'); ?>




<section class="two-col">
    <div class="container">
        <div class="row align-vert">
            <div class="col-1-2">
                <div>
                    <h2>Secondary Heading</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates error in velit accusamus sapiente, ducimus dolor officiis fuga non eum animi repellendus, illo, magnam explicabo facere quidem adipisci, rerum repudiandae!</p>
                    <a href="#" class="button">Button Text Here</a>
                </div>
            </div><!-- col-1-2 -->
            <div class="col-1-2">
                <img src="<?php bloginfo('template_directory') ?>/assets/sketches.jpg">
            </div><!-- col-1-2 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.two-col -->





<section class="three-col text-center">
    <div class="container">
        <div class="row">
            <div class="col-1-3">
                <div>
                    <a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/circle-1.png" alt=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis et temporibus aspernatur aperiam illum dicta neque eum dolore ad atque, fuga animi id nesciunt, magnam odit error dolorem quia itaque?</p>
                    <a href="#" class="button">Button Text Here</a>
                </div>
            </div><!-- /.col-1-3 -->
            <div class="col-1-3">
                <div>
                    <a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/circle-2.png" alt=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis et temporibus aspernatur aperiam illum dicta neque eum dolore ad atque, fuga animi id nesciunt, magnam odit error dolorem quia itaque?</p>
                    <a href="#" class="button">Button Text Here</a>
                </div>
            </div><!-- /.col-1-3 -->
            <div class="col-1-3">
                <div>
                    <a href="#"><img src="<?php bloginfo('template_directory') ?>/assets/circle-3.png" alt=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis et temporibus aspernatur aperiam illum dicta neque eum dolore ad atque, fuga animi id nesciunt, magnam odit error dolorem quia itaque?</p>
                    <a href="#" class="button">Button Text Here</a>
                </div>
            </div><!-- /.col-1-3 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-1-1">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore at eum natus ipsam, iusto, expedita quidem. Ab illum, ipsam nobis, est eum cum sunt accusantium pariatur deserunt quaerat voluptatem blanditiis! Ab illum, ipsam nobis, est eum cum sunt accusantium pariatur deserunt quaerat voluptatem blanditiis! Ab illum, ipsam nobis, est eum cum sunt accusantium pariatur deserunt quaerat voluptatem blanditiis! Ab illum, ipsam nobis, est eum cum sunt accusantium pariatur deserunt quaerat voluptatem blanditiis!</p>
            </div><!-- /.col-1-1 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.three-col -->





<section class="image-text-overlay">
    <div class="container">
        <div class="row">
            <div class="col-1-1">
                <div class="overlay-wrap">
                    <img src="<?php bloginfo('template_directory') ?>/assets/gears.jpg">
                    <div class="text-overlay">
                        <div>
                            <h2>Heading text goes here</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet dolorem eligendi quia, expedita velit doloribus maxime asperiores ipsa nam earum at amet, ducimus aspernatur laudantium dolor temporibus corporis cupiditate. Magnam?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis eligendi assumenda laboriosam fugiat doloremque perspiciatis, necessitatibus ut odio quaerat autem debitis maxime recusandae distinctio neque, unde amet exercitationem voluptates quia.</p>
                            <a href="#" class="button">Button Text Here</a>
                        </div>
                    </div><!-- /.text-overlay -->
                </div><!-- /.overlay-wrap -->
            </div><!-- /.col-1-1 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.image-text-overlay -->






<section class="acf-gallery text-center" id="lightgallery">
    <div class="container">
        <div class="row wrap">
            <?php 
            $images = get_field('gallery', 'options');
            if( $images ): ?>
                <?php foreach( $images as $image ): ?>
                    <div class="col-1-5">
                        <a href="<?php echo $image['url']; ?>" data-sub-html="<?php echo $image['caption']; ?>">
                            <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>"  />
                        </a>
                        <?php if($image['caption']): ?>
                            <div class="wp-caption-text"><?php echo $image['caption']; ?></div>
                        <?php endif; ?>
                    </div><!-- /.col-1-5 -->
                <?php endforeach; ?>
                <div class="col-1-5">
                    <a href="https://www.youtube.com/watch?v=meBbDqAXago">
                        <img src="<?php bloginfo('template_directory') ?>/assets/video-thumb.jpg" alt="">
                    </a>
                </div>
            <?php endif; ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.acf-gallery -->





<section class="column-text">
    <div class="container">
        <div class="row">
            <div class="col-1-1">
                <h2>CSS column Text here</h2>
                <div class="css-col-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla odit odio facere unde optio eum illum quisquam ducimus accusamus, ea fuga esse, suscipit maxime animi, fugiat facilis natus enim quam.</p>
                </div>
            </div><!-- /.col-1-1 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.column-text -->


<?php get_footer(); ?>