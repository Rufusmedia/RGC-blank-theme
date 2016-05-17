<?php get_header(); ?>
        <section class="main single-template">
            <div class="container">
                <div class="row">
                    <div class="col-2-3 content-area">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <article>
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="featured-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div><!-- /.featured-img -->
                                <?php endif; ?>
                                <h1><?php the_title(); ?></h1>
                                <div class="article-meta">
                                    By: <?php the_author(); ?> | Category: <?php the_category(', '); ?> | <?php the_tags(); ?>
                                </div><!-- /.article-meta -->
                                <div class="article-content">
                                    <?php the_content(); ?>
                                </div><!-- /.article-content -->
                            </article>
                            <?php wp_link_pages(); ?>
                        <?php endwhile; endif; ?>
                    </div><!-- /.col-2-3.content-area -->
                    <div class="col-1-3 sidebar-area">
                        <?php get_sidebar(); ?>
                    </div><!-- /.col-1-3.sidebar-area -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.main -->
<?php get_footer(); ?>