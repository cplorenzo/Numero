<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'hello-elementor','hello-elementor','hello-elementor-theme-style','hello-elementor-header-footer' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION


// BEGIN ADD BOOTSTRAP
function enqueue_bootstrap_styles() {
	wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
	wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js');
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_styles');
// END ADD BOOTSTRAP


// BEGIN SHORTCODE FOR DISPLAYING HOMES FOR SALE
function show_homes_func( $atts ) {
	$query = new WP_Query( array('post_type' => 'home-for-sale', 'post_status' => 'publish', 'posts_per_page' => 4) );

	if ( $query->have_posts() ) :
		$string = '<div class="homes-wrapper container text-center">';
		$string .= '<div class="row">';
			while (  $query->have_posts() ) :  $query->the_post();
				$string .= '<div class="home-wrapper col-md-3 col-sm-6">';

					$image = get_field('property_photo');
					if ( !empty( $image ) ):
						$string .= '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" />';
					endif;

					if ( get_field('property_name') ): 
						$string .= '<h3 class="home-name">' . esc_html( get_field('property_name') ) . '</h3>';
					endif;

					if ( get_field('property_price') ): 
						$string .= '<h4 class="home-price">Priced From ' . esc_html( get_field('property_price') ) . '</h3>';
					endif; 
	
					$string .= '<p class="learn-more-wrapper"><a class="btn learn-more" href="#" role="button">Learn More</a></p>';
				$string .= '</div>';
			endwhile;	
		$string .= '</div>';
		$string .= '</div>';
	endif;
	wp_reset_postdata();
    return $string;
}
add_shortcode('show_homes', 'show_homes_func');
// END SHORTCODE FOR DISPLAYING HOMES FOR SALE
