<?php get_header(); ?>

<main class="blog-index py-5 bg-light">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-8">
                <h6 class="text-uppercase fw-bold border-bottom pb-2 mb-4" style="letter-spacing: 1px;">Most Recent</h6>
                <?php
                $recent_query = new WP_Query(array('posts_per_page' => 1));
                if ($recent_query->have_posts()) : while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
                    <div class="featured-post position-relative">
                        <a href="<?php the_permalink(); ?>">
                            <div class="featured-img-wrapper mb-3 rounded-3 overflow-hidden shadow-sm">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100']); ?>
                                <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2">Read More</span>
                            </div>
                        </a>
                        <h2 class="fw-bold mb-3"><?php the_title(); ?></h2>
                        <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                    </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>

            <div class="col-lg-4">
                <h6 class="text-uppercase fw-bold border-bottom pb-2 mb-4" style="letter-spacing: 1px;">Most Viewed</h6>
                <div class="list-group list-group-flush bg-transparent">
                    <?php
                    // For now, we pull 5 latest posts. In a real scenario, use a plugin like WP Post Views
                    $viewed_query = new WP_Query(array('posts_per_page' => 5, 'offset' => 1));
                    if ($viewed_query->have_posts()) : while ($viewed_query->have_posts()) : $viewed_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action bg-transparent border-0 px-0 py-3 border-bottom text-dark fw-bold">
                            <?php the_title(); ?>
                        </a>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col">
                    <div class="blog-card h-100 position-relative rounded-3 shadow-sm border-0 overflow-hidden">
                        <a href="<?php the_permalink(); ?>">
                            <div class="card-img-container" style="height: 250px;">
                                <?php the_post_thumbnail('medium_large', ['class' => 'h-100 w-100 object-fit-cover']); ?>
                                <span class="badge bg-primary position-absolute top-0 start-0 m-2">Read More</span>
                            </div>
                            <div class="card-img-overlay d-flex align-items-end p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <h5 class="text-white fw-bold mb-0"><?php the_title(); ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination-wrapper mt-5 d-flex justify-content-center">
            <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => 'Prev', 'next_text' => 'Next')); ?>
        </div>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>