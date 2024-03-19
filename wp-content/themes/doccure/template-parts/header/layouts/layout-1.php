<?php
/**
 * Template part for header layout 1.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package doccure
 */
 $header_width_class = (doccure_get_option('adjust-custom-header-width') == true && doccure_get_option('header-width-style') == 'full-width') ? 'container-fluid' : 'container';
 $top_header_width_class = (doccure_get_option('adjust-custom-header-top-width') == true && doccure_get_option('header-top-width-style') == 'full-width') ? 'container-fluid' : 'container';
?>
<?php if( doccure_get_option('display_top_header') ){ ?>
  <div class="doccure_header-top">
    <div class="<?php echo esc_attr($top_header_width_class); ?>">
      <div class="doccure_header-top-inner">
      <?php
        if(doccure_get_option('display_social_media')) {
          // social media
          get_template_part( 'template-parts/header/elements/social-info' );
        }
        if(doccure_get_option('display_top_header_contact_info')) {
          // Contact info
        	get_template_part( 'template-parts/header/elements/contact-info' );
        }
        if(doccure_get_option('display_top_cta')) {
          // Call to action
          get_template_part( 'template-parts/header/elements/cta-button' );
        }
      ?>
      </div>
    </div>
  </div>
<?php } ?>
<div class="doccure_header-middle">
  <div class="<?php echo esc_attr($header_width_class); ?>">
    <div class="navbar">
      <?php
      // Site logo
      get_template_part( 'template-parts/header/elements/logo' );
      // menu
      doccure_nav_menu();
      // controls
      get_template_part( 'template-parts/header/elements/controls' );
      ?>
    </div>
  </div>
</div>
