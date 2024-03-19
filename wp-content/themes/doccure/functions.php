<?php
/**
 * doccure functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package doccure
 */

 function cc_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');

  
// Theme utility functions
require get_template_directory() . '/inc/scripts.php'; //Theme styles and scripts

require get_template_directory() . '/inc/functions-utilities.php';

// Theme Setup
require get_template_directory() . '/inc/functions-setup.php';

// Theme Scripts/Styles
require get_template_directory() . '/inc/functions-scripts.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Social Media Functions
require get_template_directory() . '/inc/functions-social.php';

// Dynamic Css
require get_template_directory() . '/inc/color-customizer.php';

// Subheader Functions
require get_template_directory() . '/inc/functions-subheader.php';

// Sidebar Functions
require get_template_directory() . '/inc/functions-sidebars.php';

// WooCommerce Functions
require get_template_directory() . '/inc/functions-woocommerce.php';

// Responsible for edd options
require get_template_directory() . '/inc/functions-edd.php';

// Load theme options.
require get_template_directory() . '/inc/redux-options/redux-config.php';

// TGM plugin activation.
require get_template_directory() . '/inc/tgm-plugin-activation/required-plugin.php';

// Responsible for post functions
require get_template_directory() . '/inc/classes/class-doccure-blog-functions.php';

// Responsible for portfolio functions
require get_template_directory() . '/inc/classes/class-doccure-portfolio-functions.php';

// Responsible for service functions
require get_template_directory() . '/inc/classes/class-doccure-service-functions.php';

// Responsible for lazy load functions
require get_template_directory() . '/inc/classes/class-doccure-lazy-load-functions.php';

require get_template_directory() . '/widgets/recent-posts-widgets.php';

// Responsible for bfi thumb functions
require get_template_directory() . '/inc/classes/BFI_Thumb.php';

// Subheader Functions
require get_template_directory() . '/inc/functions-popup.php';

/*========================
CUSTOM WALKERS
========================*/

// Comment walker.
require get_template_directory() . '/classes/class-doccure-walker-comment.php';

// Category Widget walker.
require get_template_directory() . '/classes/class-doccure-walker-category.php';


function doccure_custom_header_widget() {
 
  register_sidebar( array(
      'name'          => 'Custom Header Widget',
      'id'            => 'custom-header-widget',
      'before_widget' => '<div class="chw-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="chw-title">',
      'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'doccure_custom_header_widget' );


function doccure_custom_language_widget() {
 
  register_sidebar( array(
      'name'          => 'Custom Language Widget',
      'id'            => 'custom-language-widget',
      'before_widget' => '<div class="lang-chw-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="lang-chw-title contact-header">',
      'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'doccure_custom_language_widget' );


function doccure_custom_button_widget() {
 
  register_sidebar( array(
      'name'          => 'Button Widget',
      'id'            => 'button-widget',
      'before_widget' => '<div class="chw-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="chw-title">',
      'after_title'   => '</h2>',
  ) );

}
 add_action( 'widgets_init', 'doccure_custom_button_widget' );


require_once ( get_template_directory() . '/inc/class-notifications.php'); //Theme notifications
require_once ( get_template_directory() . '/inc/sidebars.php'); //Theme sidebars
require_once ( get_template_directory() . '/directory/front-end/hooks.php');
require_once ( get_template_directory() . '/inc/functions.php'); //Theme functionalty

require_once doccure_override_templates('/inc/class-headers.php'); //headers
require_once doccure_override_templates('/inc/class-titlebars.php'); //Sub headers
require_once ( get_template_directory() . '/inc/constants.php'); //Constants
require_once ( get_template_directory() . '/inc/class-woocommerce.php'); //Woocommerce
require_once ( get_template_directory() . '/inc/languages.php');
require_once ( get_template_directory() . '/inc/typo.php');

require_once ( get_template_directory() . '/inc/google_fonts.php'); // goolge fonts
require_once ( get_template_directory() . '/inc/hooks.php'); //Hooks
require_once ( get_template_directory() . '/inc/template-tags.php'); //Tags
require_once ( get_template_directory() . '/directory/front-end/class-dashboard-menu.php');
require_once ( get_template_directory() . '/directory/front-end/functions.php');
require_once ( get_template_directory() . '/directory/front-end/woo-hooks.php');

require_once ( get_template_directory() . '/directory/back-end/dashboard.php');
require_once ( get_template_directory() . '/directory/back-end/functions.php');
require_once ( get_template_directory() . '/directory/front-end/ajax-hooks.php');
require_once ( get_template_directory() . '/directory/front-end/term_walkers.php'); //Term walkers
if( class_exists( 'doccureGlobalSettings' ) ) {
  require_once ( get_template_directory() . '/inc/class-pdf.php'); //Hooks
}

function my_custom_styles() {

  wp_register_style('custom-styles', get_template_directory_uri(). '/assets/css/dashboard.css');
  
  wp_enqueue_style('custom-styles');
}
add_action('wp_enqueue_scripts', 'my_custom_styles');

function doccure_register_widget() {
  register_widget( 'Doccure_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'doccure_register_widget' );

function doccure_paginationblog() {
  
  if( is_singular() )
      return;

  global $wp_query;

  /** Stop execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 )
      return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $wp_query->max_num_pages );

  /** Add current page to the array */
  if ( $paged >= 1 )
      $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
      $links[] = $paged - 1;
      $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
      $links[] = $paged + 2;
      $links[] = $paged + 1;
  }
if ( $paged >= 1 ){
  
  echo '
<div class="col-md-12 ">
<div class="post-pagination">
<ul class="paginations">' . "\n";

  /** Previous Post Link */
  if ( get_previous_posts_link() )
      printf( '<li class="arrow">%s</li>' . "\n", get_previous_posts_link( __( '<i class="fas fa-angle-double-left"></i>', 'doccure' ) ) );

  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
      $class = 1 == $paged ? ' class="active"' : '';

      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

      if ( ! in_array( 2, $links ) )
          echo '<li>…</li>';
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
      $class = $paged == $link ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
      if ( ! in_array( $max - 1, $links ) )
          echo '<li>…</li>' . "\n";

      $class = $paged == $max ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  /** Next Post Link */
  if ( get_next_posts_link() )
      printf( '<li class="arrow">%s</li>' . "\n", get_next_posts_link( __( '<i class="fas fa-angle-double-right"></i>', 'doccure' ) ) );

  echo '</ul></div></div>' . "\n";
}

}

add_filter('wpcf7_autop_or_not', '__return_false');


// Remove `Payment Methods` from `woocommerce_checkout_order_review` hook
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

require_once get_template_directory(). '/inc/doccure-demo-content.php';


function remove_ocdi_about_notice() {
    echo '<style type="text/css">
    .ocdi__theme-about {display: none}
          </style>';
 }
 add_action('admin_head', 'remove_ocdi_about_notice');









