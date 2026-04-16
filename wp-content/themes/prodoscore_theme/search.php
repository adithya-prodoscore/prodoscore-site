<?php get_header(); ?>

<main class="search-page py-5 bg-light">
    <div class="container">
        
        <header class="search-header text-center mb-5">
            <h1 class="fw-bold display-4">
                Search Results for: "<?php echo get_search_query(); ?>"
            </h1>
            <p class="text-muted fs-5">
                We found <?php echo $wp_query->found_posts; ?> results for your search.
            </p>
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
                <i class="bi bi-search display-1 text-muted"></i>
                <h3 class="mt-4">Sorry, we couldn't find anything matching your search.</h3>
                <p>Try searching for different keywords.</p>
                <div class="mx-auto" style="max-width: 400px;">
                    <?php get_search_form(); ?>
                </div>
                <a href="<?php echo home_url(); ?>" class="btn btn-primary mt-4">Back to Home</a>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>