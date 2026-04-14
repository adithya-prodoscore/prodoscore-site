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
<body>
    
<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom py-3">
        <div class="container">

            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <span class="fw-bold text-white">Prodoscore</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'top-menu',
                            'container'      => false,
                            'menu_class'     => 'navbar-nav me-auto ms-lg-4', 
                            'fallback_cb'    => '__return_false',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        )
                    ); 
                ?>

                <div class="d-flex align-items-center gap-3">
                    <a href="#" class="btn btn-link text-decoration-none text-white fw-bold p-0">Sign In</a>
                    <a href="#" class="btn btn-danger px-4 fw-bold">CONTACT US</a>
                    <i class="bi bi-search ms-2"></i> 
                </div>

            </div>
        </div>
    </nav>
</header>