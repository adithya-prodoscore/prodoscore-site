<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-wrapper py-5'); ?>>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-8">
                
                <header class="post-header text-center mb-5">
                    <h1 class="fw-bold mb-4" style="line-height: 1.2; font-size: 2.6rem; color: #1a202c;">
                        <?php the_title(); ?>
                    </h1>

                    <div class="post-meta-wrapper d-flex align-items-center justify-content-center flex-wrap gap-3 py-3 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="author-avatar-sm me-2">
                                <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-circle')); ?>
                            </div>
                            <div class="text-start">
                                <span class="d-block fw-bold text-dark lh-1" style="font-size: 0.95rem;">
                                    <?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?>
                                </span>
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    <?php echo get_the_date('M j, Y'); ?> &bull; <?php the_time(); ?>
                                </small>
                            </div>
                        </div>

                        <div class="vr d-none d-sm-block mx-2" style="height: 30px; opacity: 0.1;"></div>

                        <div class="post-categories">
                            <?php 
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                foreach( $categories as $category ) {
                                    echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="category-pill">' . esc_html( $category->name ) . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail-sm mb-5 shadow-sm">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-4']); ?>
                    </div>
                <?php endif; ?>

                <div class="post-content entry-content fs-5 lh-lg">
                    <?php the_content(); ?>
                </div>

            </div>
        </div>
    </div>
</article>

    <section class="related-posts py-5 bg-light border-top">
        <div class="container">
            <h3 class="fw-bold mb-4 text-center">You Might Also Like</h3>
            <div class="row">
                <?php
                $orig_post = $post;
                global $post;
                $categories = get_the_category($post->ID);
                if ($categories) {
                    $category_ids = array();
                    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                    $args = array(
                        'category__in' => $category_ids,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 3,
                        'caller_get_posts' => 1
                    );
                    $my_query = new wp_query($args);
                    while( $my_query->have_posts() ) {
                        $my_query->the_post();
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                            </a>
                            <div class="card-body">
                                <h6 class="fw-bold"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h6>
                            </div>
                        </div>
                    </div>
                <?php } }
                $post = $orig_post;
                wp_reset_query(); ?>
            </div>
        </div>
    </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>