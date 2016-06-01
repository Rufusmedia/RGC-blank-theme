<?php get_header(); ?>
<?php get_template_part('_part-carousel'); ?>
        <section class="main page-template">
            <div class="container">
                <div class="row">
                    <div class="col-1-1 content-area">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <article>
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="featured-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div><!-- /.featured-img -->
                                <?php endif; ?>
                                <h1><?php the_title(); ?></h1>
                                <div class="article-content">
                                    <?php the_content(); ?>
                                </div><!-- /.article-content -->
                            </article>
                            <?php wp_link_pages(); ?>
                        <?php endwhile; endif; ?>
                    </div><!-- /.col-2-3.content-area -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.main -->
<?php get_footer(); ?>