<footer class="bg-dark-blue text-white pt-5">
    <div class="container pb-4">
        <nav class="footer-nav">
            <?php 
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container'      => false,
                    'menu_class'     => 'footer-columns-wrapper', 
                )); 
            ?>
        </nav>
    </div>
    
    <?php 
        // Get the ID of the front page to fetch ACF fields from anywhere
        $front_id = get_option('page_on_front'); 
    ?>
    <div class="footer-bottom py-4" style="background-color: rgba(0,0,0,0.2);">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-md-7">
                    <div class="d-flex flex-wrap align-items-center gap-4 justify-content-center justify-content-md-start">
                        
                        <div class="footer-socials d-flex gap-3">
                            <?php if(get_field('facebook_url', $front_id)): ?>
                                <a href="<?php the_field('facebook_url', $front_id); ?>" class="text-white"><i class="bi bi-facebook"></i></a>
                            <?php endif; ?>
                            <?php if(get_field('x_url', $front_id)): ?>
                                <a href="<?php the_field('x_url', $front_id); ?>" class="text-white"><i class="bi bi-twitter-x"></i></a>
                            <?php endif; ?>
                            <?php if(get_field('linkedin_url', $front_id)): ?>
                                <a href="<?php the_field('linkedin_url', $front_id); ?>" class="text-white"><i class="bi bi-linkedin"></i></a>
                            <?php endif; ?>
                        </div>

                        <div class="d-none d-md-block border-start border-secondary h-100" style="width:1px; height:20px !important; opacity:0.3;"></div>

                        <div class="legal-links d-flex gap-3">
                            <a href="<?php the_field('privacy_policy_url', $front_id); ?>" class="text-white-50 small text-decoration-none">Privacy Policy</a>
                            <span class="text-white-50">|</span>
                            <a href="<?php the_field('cookie_policy_url', $front_id); ?>" class="text-white-50 small text-decoration-none">Cookie Policy</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 text-center text-md-end mt-3 mt-md-0">
                    <p class="small text-white-50 mb-0">
                        © <?php echo date('Y'); ?> <?php the_field('copyright_text', $front_id); ?> 
                    </p>
                </div>

            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?> 
</body>
</html>