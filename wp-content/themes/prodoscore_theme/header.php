<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodoscore</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- This injects functions.php within this page -->
    <?php wp_head(); ?>
</head>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('searchToggle');
    const dropdown = document.querySelector('.search-dropdown');

    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    });

    // Close if clicking outside
    document.addEventListener('click', function(e) {
        if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
});
</script>

<body>
    
<header class="sticky-top bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
                <?php 
                $front_page_id = get_option('page_on_front');
                $logo_url = get_field('logo', $front_page_id); 
                
                if ( $logo_url ) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" style="max-height: 70px; width: auto;">
                <?php else : ?>
                    <span class="fw-bold text-white"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav me-auto ms-lg-4', 
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    )); 
                ?>

                <div class="d-flex align-items-center gap-3">
                    <a href="#" class="btn btn-link text-decoration-none text-white fw-bold p-0">Sign In</a>
                    <a href="#" class="btn btn-danger px-4 fw-bold">CONTACT US</a>
                    
                    <div class="search-trigger-container ms-2">
                        <i class="bi bi-search text-white cursor-pointer"></i>
                        <div class="search-dropdown">
                             <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>