<?php

// Load Styles
function load_css() {

    // This is bootstrap css
    wp_register_style(
        'bootstrap', 
        get_template_directory_uri() . '/css/bootstrap.min.css',
        array(), # List of dependencies
        false,
        'all' # Some media query thing
        );

    wp_enqueue_style('bootstrap');

    // This main.css overrides the bootstrap css
    // Because it placed after bootstrap css
    wp_register_style(
        'main', 
        get_template_directory_uri() . '/css/main.css',
        array(), # List of dependencies
        false,
        'all' # Some media query thing
        );

    wp_enqueue_style('main');   
}

add_action('wp_enqueue_scripts', 'load_css'); // Register css


// Load JS
function load_js() {

    wp_enqueue_script('jquery');

    wp_register_script(
        'bootstrap', 
        get_template_directory_uri() . '/js/bootstrap.min.js',
        'jquery',
        false,
        true // Apply js in footer 
        );
    wp_enqueue_script('bootstrap');
}

add_action('wp_enqueue_scripts', 'load_js');


// Theme Options 
add_theme_support('menus'); // Make available menus in wp-admin
add_theme_support('post-thumbnails');
add_theme_support('widgets');

// Menus - this is easy
register_nav_menus(
    array(
        // 'id of the menu' => 'name of the menu'
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location'
    )
);

// Custom Image Sizes
add_image_size('blog-large', 800, 400, false);
add_image_size('blog-small', 300, 200, true);

// Register Sidebars
function my_sidebar() {

    register_sidebar(
        array(
            'name' => 'Page Sidebar',
            'id' => 'page-sidebar',
            'before-title' => '<h4 class="widget-title">',
            'after-title' => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name' => 'Blog Sidebar',
            'id' => 'blog-sidebar',
            'before-title' => '<h4 class="widget-title">',
            'after-title' => '</h4>'
        )
    );
}

// Widgets - To Style these just inspect and find classes
add_action('widgets_init', 'my_sidebar');


// By Default this new type uses 'single.php' same as single 'blog post'
function my_first_post_type() {

    $args = array(
        'labels' => array(
            'name' => 'Cars',
            'singular_name' => 'Car'
        ),
        'menu_icon'   => 'dashicons-car',
        'hierarchical' => true, // if 'true' acts more like page, if 'false' 
        'public' => true, // Publically accessible to user/dev
        'has_archive' => true, // like blog post archive
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'), // We want them to have these functionalities for creating this post type
        'rewrite' => array('slug' => 'cars'), // slug is the name that appear in => url
        'show_in_rest' => true, // This enables gutenburg editor
        );

    register_post_type('cars', $args);

}
add_action('init', 'my_first_post_type');
// init hook - loads just before headers loaded in the website

function my_first_taxanomy() {
    $args = array(
        'labels' => array(
            'name' => 'Brands',
            'singular_name' => 'Brand'
        ),
        'public' => true,
        'hierarchical' => true // 'true' make act like category 'false' => act like tags
    );

    register_taxonomy('brands', array('cars'), $args);

}
add_action('init', 'my_first_taxanomy');

/**
 * ACF JSON: Set the save point
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // Update path
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

/**
 * ACF JSON: Set the load point
 */
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // Remove original path (optional)
    unset($paths[0]);
    // Append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

?>