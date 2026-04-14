<?php

/**
 * Template Name: About Us Page
 */

get_header(); ?>

<main class="about-page">
    <section class="about-hero-split p-5">
        <div class="container text-center">
            
            <div class="row justify-content-center pt-5 pb-4">
                <div class="col-lg-8 text-white">
                    <h1 class="fw-bold mb-4 display-5"><?php the_field('about_hero_title'); ?></h1>
                    
                    <div class="mx-auto bg-primary mb-4" style="width: 50px; height: 3px;"></div>
                    
                    <p class="lead opacity-75 mb-5 px-md-5">
                        <?php the_field('about_hero_subtitle'); ?>
                    </p>
                </div>
            </div>

                <div class="row justify-content-center py-5 bg-white rounded-5 shadow-sm mt-n1">
                <div class="col-lg-9 text-secondary pt-4">
                    <p class="fs-5 mb-4 px-md-4">
                        <?php the_field('about_description_top'); ?>
                    </p>
                    <p class="fs-5 px-md-4">
                        <?php the_field('about_description_bottom'); ?>
                    </p>
                </div>
            </div>

        </div>
    </section>
</main>

<!-- Carousel Section - (Implement Later) -->

<section class="brand-carousel py-4">
    <div class="container">
        <p class="text-center text-muted small fw-bold mb-5" style="letter-spacing: 2px; opacity: 0.6;">AS SEEN IN</p>
        <?php echo do_shortcode('[metaslider id="114"]'); ?>
    </div>
</section>

<!-- Vision & Mission Section -->

<section class="mission-vision py-5">
    <div class="container py-4">
        <div class="row g-4 justify-content-center">
            
            <div class="col-md-5">
                <div class="mv-card p-4 h-100 shadow-sm border-0 border-start border-4 border-primary bg-white">
                    <p class="fs-5 mb-0">
                        <?php the_field('mission_text'); ?>
                    </p>
                </div>
            </div>

            <div class="col-md-5">
                <div class="mv-card p-4 h-100 shadow-sm border-0 border-start border-4 border-info bg-white">
                    <p class="fs-5 mb-0">
                        <?php the_field('vision_text'); ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Prodoscore values section -->

<section class="core-values py-5" style="background-color: #f4f7fa;">
    <div class="container py-5">
        
        <div class="row align-items-center mb-5 pb-lg-4">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="<?php the_field('values_hero_image'); ?>" alt="Values Hero" class="img-fluid">
            </div>
            <div class="col-md-6 ps-md-5">
                <h2 class="fw-bold mb-4"><?php the_field('values_hero_title'); ?></h2>
                <div class="text-muted fs-6 lh-lg">
                    <?php the_field('values_hero_text'); ?>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="col-md-4">
                    <div class="accent-bar accent-<?php echo $i; ?> mb-3"></div>
                    <h4 class="fw-bold mb-3"><?php the_field('val_' . $i . '_title'); ?></h4>
                    <p class="text-muted small lh-base">
                        <?php the_field('val_' . $i . '_text'); ?>
                    </p>
                </div>
            <?php endfor; ?>
        </div>

    </div>
</section>

<!-- Team Section -->

<section class="team-section py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5 text-center position-relative" style="z-index: 2;">
        <h2 class="fw-bold mb-5" style="font-size: 2.5rem; color: #1a2233;">Meet the Team</h2>

        <div class="row g-5 justify-content-center">
            <?php for ($i = 1; $i <= 6; $i++) : 
                $img   = get_field('team_' . $i . '_img');
                $name  = get_field('team_' . $i . '_name');
                $title = get_field('team_' . $i . '_title');
                $link  = get_field('team_' . $i . '_link');

                if( $name ): 
            ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="team-card d-flex flex-column align-items-center">
                        
                        <div class="member-img-wrapper mb-3 shadow-sm">
                            <?php if($img): ?>
                                <img src="<?php echo $img; ?>" alt="<?php echo $name; ?>">
                            <?php else: ?>
                                <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center text-muted">No Image</div>
                            <?php endif; ?>
                        </div>
                        
                        <h5 class="fw-bold mb-1 text-dark" style="font-size: 1.15rem;"><?php echo $name; ?></h5>
                        <p class="text-primary fw-semibold small mb-2" style="color: #3182ce !important; font-size: 0.9rem;"><?php echo $title; ?></p>
                        
                        <?php if($link): ?>
                            <a href="<?php echo $link; ?>" target="_blank" class="linkedin-icon mt-1">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" style="width: 22px; height: 22px;">
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; endfor; ?>
        </div>
    </div>

    <div class="team-bg-pattern"></div>
</section>

<?php get_footer(); ?>