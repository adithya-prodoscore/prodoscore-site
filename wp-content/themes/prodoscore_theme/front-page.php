<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">
                    <?php the_field('hero_title'); ?>
                </h1>
                
                <p class="lead text-muted mb-4">
                    <?php the_field('hero_description'); ?>
                </p>

                <div class="d-flex gap-3">
                    <?php if( get_field('hero_primary_button_text') ): ?>
                        <a href="#" class="btn btn-danger btn-lg px-4">
                            <?php the_field('hero_primary_button_text'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if( get_field('hero_secondary_button_text') ): ?>
                        <a href="#" class="btn btn-outline-primary btn-lg px-4">
                            <?php the_field('hero_secondary_button_text'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0 text-center">
                <div class="position-relative d-inline-block">
                    <?php 
                    $hero_img = get_field('hero_graphic');
                    if( $hero_img ): ?>
                        <img src="<?php echo $hero_img; ?>" class="img-fluid" alt="Hero Graphic">
                    <?php endif; ?>
                    
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="play-btn d-flex align-items-center justify-content-center shadow" style="width: 80px; height: 80px; background: rgba(220, 53, 69, 0.9); border-radius: 50%; cursor: pointer;">
                             <span style="color: white; font-size: 2rem;">▶</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Carousel Section - (Implement Later) -->

<section class="brand-carousel py-4">
    <div class="container">
        <p class="text-center text-muted small fw-bold mb-5" style="letter-spacing: 2px; opacity: 0.6;">AS SEEN IN</p>
        <?php echo do_shortcode('[metaslider id="114"]'); ?>
    </div>
</section>


<!-- Challenges Section -->

<section class="challenges-section py-5" style="background-color: #ffffff;">
    <div class="container text-center py-5">
        
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9">
                <h2 class="fw-bold text-dark mb-3" style="font-size: 2.5rem;">
                    <?php the_field('challenges_title'); ?>
                </h2>
                <p class="text-muted fs-5">
                    <?php the_field('challenges_subtitle'); ?>
                </p>
            </div>
        </div>

        <div class="row g-4">
            <?php for ($i = 1; $i <= 4; $i++) : 
                $icon = get_field('card_' . $i . '_icon');
                $text = get_field('card_' . $i . '_text');
            ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4" style="background-color: #f8fafd;">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <?php if($icon): ?>
                                <img src="<?php echo $icon; ?>" alt="Icon" class="mb-4" style="width: 60px; height: 60px; object-fit: contain;">
                            <?php endif; ?>
                            
                            <p class="card-text fw-semibold text-secondary px-2">
                                <?php echo $text; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <div class="mt-5 pt-4">
            <p class="text-muted mb-4"><?php the_field('challenges_footer_text'); ?></p>
            <a href="<?php the_field('challenges_button_url'); ?>" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">
                <?php the_field('challenges_button_text'); ?>
            </a>
        </div>

    </div>
</section>

<!-- Side By Side Section -->


<section class="zigzag-features py-5">
    <div class="container"> <?php for ($i = 1; $i <= 3; $i++) : 
            $title = get_field('feat_' . $i . '_title');
            $desc  = get_field('feat_' . $i . '_description');
            $img   = get_field('feat_' . $i . '_image');
            $btn_t = get_field('feat_' . $i . '_button_text');
            $btn_u = get_field('feat_' . $i . '_button_url');
            
            $reverse_class = ($i % 2 == 0) ? 'flex-md-row-reverse' : '';
            // Only add margin-bottom if it's NOT the last item
            $margin_class = ($i < 3) ? '' : 'mb-0'; 
        ?>
            <div class="row align-items-center <?php echo $reverse_class; ?> <?php echo $margin_class; ?>">
                
                <div class="col-md-5">
                    <div class="feature-image-wrapper text-center">
                        <?php if($img): ?>
                            <img src="<?php echo $img; ?>" alt="<?php echo $title; ?>" class="img-fluid feature-img">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-7 ps-md-4 text-column"> <div class="feature-text-content">
                        <h2 class="fw-bold text-dark mb-3">
                            <?php echo $title; ?>
                        </h2>
                        <div class="text-muted fs-5 mb-3" style="line-height: 1.6;">
                            <?php echo $desc; ?>
                        </div>

                        <?php if($btn_t): ?>
                            <div class="mt-3">
                                <a href="<?php echo $btn_u; ?>" class="btn btn-primary btn-lg px-4 py-2 fw-bold">
                                    <?php echo $btn_t; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php endfor; ?>
    </div>
</section>


<!-- Benifits Section -->

<section class="benefits-section py-5" style="background-color: #1a2b49;">
    <div class="container py-5">
        
        <h2 class="text-white text-center fw-bold mb-5 px-3">
            <?php the_field('benefits_title'); ?>
        </h2>

        <div class="row g-4 justify-content-center">
            <?php for ($i = 1; $i <= 3; $i++) : 
                $icon  = get_field('benefit_' . $i . '_icon');
                $title = get_field('benefit_' . $i . '_title');
                $desc  = get_field('benefit_' . $i . '_description');
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-lg">
                        <div class="card-body text-start">
                            <?php if($icon): ?>
                                <img src="<?php echo $icon; ?>" alt="Icon" class="mb-4" style="width: 50px; height: 50px;">
                            <?php endif; ?>
                            
                            <h4 class="fw-bold text-dark mb-3" style="font-size: 1.5rem;">
                                <?php echo $title; ?>
                            </h4>
                            
                            <p class="text-muted mb-0" style="line-height: 1.6;">
                                <?php echo $desc; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?php the_field('benefits_button_url'); ?>" class="btn btn-primary btn-lg px-4 py-2 mt-3" style="background-color: #3a86f7; border: none;">
                <?php the_field('benefits_button_text'); ?>
            </a>
        </div>

    </div>
</section>


<?php endwhile; endif; ?>

<?php get_footer(); ?>