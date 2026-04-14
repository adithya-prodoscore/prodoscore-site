<!--
This is the template for all other pages
-->


<?php get_header(); ?>

<main class="archive-page py-5 bg-light">
    <div class="container">
        
        <header class="archive-header text-center mb-5">
            <h1 class="fw-bold display-4">
                <?php 
                    if ( is_category() ) {
                        single_cat_title();
                    } elseif ( is_tag() ) {
                        single_tag_title();
                    } elseif ( is_author() ) {
                        echo 'Posts by ' . get_the_author();
                    } else {
                        echo 'Archives';
                    }
                ?>
            </h1>
            <p class="text-muted fs-5">Showing all posts filed under this section</p>
        </header>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col">
                    <div class="blog-card h-100 position-relative rounded-3 shadow-sm border-0 overflow-hidden bg-white">
                        <a href="<?php the_permalink(); ?>">
                            <div class="card-img-container" style="height: 250px; position: relative; overflow: hidden;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['class' => 'h-100 w-100 object-fit-cover']); ?>
                                <?php else : ?>
                                    <div class="bg-secondary h-100 w-100 d-flex align-items-center justify-content-center text-white">No Image</div>
                                <?php endif; ?>
                                <span class="badge bg-primary position-absolute top-0 start-0 m-3">Read More</span>
                            </div>
                            <div class="card-img-overlay d-flex align-items-end p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); position: absolute; bottom: 0; width: 100%;">
                                <h5 class="text-white fw-bold mb-0"><?php the_title(); ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination-wrapper mt-5 d-flex justify-content-center">
            <?php 
            echo paginate_links(array(
                'type' => 'list',
                'class' => 'pagination',
            )); 
            ?>
        </div>

        <?php else : ?>
            <div class="text-center py-5">
                <h3>No posts found in this category.</h3>
                <a href="<?php echo site_url('/blog'); ?>" class="btn btn-primary mt-3">Back to Blog</a>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>