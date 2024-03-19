<?php
/**
 * Template part for header layout 10
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package doccure
 */
 $header_width_class = (doccure_get_option('adjust-custom-header-width') == true && doccure_get_option('header-width-style') == 'full-width') ? 'container-fluid' : 'container';
 $top_header_width_class = (doccure_get_option('adjust-custom-header-top-width') == true && doccure_get_option('header-top-width-style') == 'full-width') ? 'container-fluid' : 'container';
 $header_controls_style = doccure_get_option('header_controls_style');
 ?>
 <?php if( doccure_get_option('display_top_header') ){ ?>
   <div class="doccure_header-top dark-bg d-none d-md-block">
     <div class="<?php echo esc_attr($top_header_width_class); ?>">
       <div class="doccure_header-top-inner">
         <?php
           if(doccure_get_option('display_top_header_contact_info')) {
             // Contact info
            get_template_part( 'template-parts/header/elements/contact-info' );
           }
           if(doccure_get_option('display_social_media')) {
             // social media
             get_template_part( 'template-parts/header/elements/social-info' );
           }
         ?>
       </div>
     </div>
   </div>
 <?php } ?>

 <div class="doccure_header-middle">
   <div class="<?php echo esc_attr($header_width_class); ?>">
     <div class="navbar">
     <div class="doccure_logo-wrapper nopadding">
        <?php doccure_get_site_logo('site-logo'); ?>
         </div>
        <?php 
         // nav menu
         doccure_nav_menu();
         if ( is_active_sidebar( 'custom-language-widget' ) ) : ?>
          <div id="lang-widget-area" class="lang-chw-widget-area widget-area" role="complementary">
          <?php dynamic_sidebar( 'custom-language-widget' ); ?>
          </div>
           <?php endif; 
        
          wp_nav_menu( array( 
              'theme_location' => 'my-custom-menu', 
              'container_class' => 'custom-menu-class' ) ); 

         // controls
         get_template_part( 'template-parts/header/elements/controls' );
         

         global $current_user;
		wp_get_current_user();
			if (is_user_logged_in()) {
			?>

<div class="nav-item dropdown">
		<a href="javascript:void(0)">
		<span class="user-img">
       <?php  echo get_avatar( get_current_user_id(), 80 ); ?>

		</span>
		</a>
		<div class="dropdown-menu-end">
		<div class="user-header">
		<div class="avatar avatar-sm">
       <?php echo get_avatar( get_current_user_id(), 80 ); ?>

		</div>
		<div class="user-text">
		<h6><?php  echo  esc_html($current_user->user_login); ?></h6>
		<p class="text-muted mb-0">
			<?php 
			$role = $current_user->roles[0];
			$role_name = $role ? wp_roles()->get_names()[ $role ] : '';
			echo esc_html($role_name);
 
      
			?>
		</p>
		</div>
		</div>
		<a href="<?php doccure_Profile_Menu::doccure_profile_menu_link('insights', get_current_user_id()); ?>" class="dropdown-item" href="<?php echo home_url();?>/dashboard"><?php esc_html_e('Dashboard', 'doccure'); ?></a>
		
		<a class="dropdown-item" href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e('Logout', 'doccure'); ?></a>
		</div>
</div>
			<?php } ?>  
     </div>
   </div>
 </div>
