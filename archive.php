<?php get_header(); ?>
        <section class="main archive-template">
            <div class="container">
                <div class="row">
                    <div class="col-2-3 content-area">
                        <?php $post = $posts[0]; // hack: set $post so that the_date() works ?>
                        <?php if (is_category()): ?>
                            <h1><?php single_cat_title(); ?></h1>
                        <?php elseif(is_tag()): ?>
                            <h1>Posts Tagged &ldquo;<?php single_tag_title(); ?>&rdquo;</h1>
                        <?php elseif (is_day()): ?>
                            <h1>Posts from <?php the_time('F jS, Y'); ?></h1>
                        <?php elseif (is_month()): ?>
                            <h1>Posts from <?php the_time('F, Y'); ?></h1>
                        <?php elseif (is_year()): ?>
                            <h1>Posts From <?php the_time('Y'); ?></h1>
                        <?php elseif (is_author()): ?>
                            <h1>Author Archive</h1>
                        <?php endif; ?>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <article>
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="featured-img">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div><!-- /.featured-img -->
                                <?php endif; ?>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="article-meta">
                                    By: <?php the_author(); ?> | Category: <?php the_category(', '); ?> | <?php the_tags(); ?>
                                </div><!-- /.article-meta -->
                                <div class="article-content">
                                    <?php the_excerpt(); ?>
                                </div><!-- /.article-content -->
                            </article>
                        <?php endwhile; endif; ?>
                        <?php rgc_pagination(); ?>
                    </div><!-- /.col-2-3.content-area -->
                    <div class="col-1-3 sidebar-area">
                        <?php get_sidebar(); ?>
                    </div><!-- /.col-1-3.sidebar-area -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.main -->
<?php get_footer(); ?>