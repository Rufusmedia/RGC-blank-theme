<?php get_header(); ?>
        <section class="main search-template">
            <div class="container">
                <div class="row">
                    <div class="col-2-3 content-area">
                        <h1>Search Results for &ldquo;<?php the_search_query(); ?>&rdquo;</h1>
                        <ol>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <li>
                                    <article>
                                        <?php if(has_post_thumbnail()): ?>
                                            <div class="featured-img">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </div><!-- /.featured-img -->
                                        <?php endif; ?>
                                        <p><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></p>
                                        <div class="article-meta">
                                            By: <?php the_author(); ?> | Category: <?php the_category(', '); ?> | <?php the_tags(); ?>
                                        </div><!-- /.article-meta -->
                                        <div class="article-content">
                                            <?php the_excerpt(); ?>
                                        </div><!-- /.article-content -->
                                    </article>
                                </li>
                            <?php endwhile; endif; ?>
                        </ol>
                        <?php rgc_pagination(); ?>
                    </div><!-- /.col-2-3.content-area -->
                    <div class="col-1-3 sidebar-area">
                        <?php get_sidebar(); ?>
                    </div><!-- /.col-1-3.sidebar-area -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.main -->
<?php get_footer(); ?>