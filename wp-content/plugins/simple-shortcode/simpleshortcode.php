<?php
/**
 * Plugin Name: Simple Shortcode
 * Description: shortcodes for doccure theme.
 * Version: 1.2.1
 * Author: Dreams Technologies
 * Text Domain: doccure_simple_shortcode
 *
 */
function doctors_loop_shortcode() {
    $args = array(
        'post_type' => 'doctors',
        'post_status' => 'publish',
        'posts_per_page' =>4
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="home_doctor_slider 123 row">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
  
  
            ob_start();
  
            ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" style="width:370px;">
  <div class="row">
  <div class="col-lg-12">
      <div class="doccure_doctor-thumb doccure-filter-img-wrapper">
        <img src="<?php echo $url;?>"/>
      </div>
  </div>
  <div class="col-lg-12">
      <div class="doccure_doctor-body">
          <h5>
          <a href="<?php echo get_permalink(get_the_ID())?>"><?php echo $name;?></a>
          </h5>
          <div class="ratings">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width: <?php echo intval( $total_percentage );?>%"></div>
          </div>
       
        <span>
        <i class="feather-map-pin"></i>
        <?php echo $first_category = wp_get_post_terms( get_the_ID(), 'locations' )[0]->name;?>
        </span>
        <?php if( !empty( $starting_price ) ) { ?>
              <div class="price-section"><i class="far fa-money-bill-alt"></i><?php doccure_price_format($starting_price);?></div>          <?php } ?>
  
        <div id="button-widget" class="chw-widget-area widget-area" role="complementary">
          <div class="row row-sm mt-3">
            <div class="col-6">
            <a href="<?php echo get_permalink(get_the_ID())?>">
              <button class="view-btn" tabindex="0"> 
                View Profile</button>
                </a>
            </div>
            <div class="col-6">
            <a href="<?php echo get_permalink(get_the_ID())?>">
              <button class="book-btn" tabindex="0"> <?php esc_html_e('Book Now','doccure_simple_shortcode'); ?>
              </button>
              </a>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
        </div>
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
  <?php 
  }
  
  add_shortcode( 'doctors_loop', 'doctors_loop_shortcode' );
  
  function home_searchform_shortcode(){
    global $doccure_options;
    $hide_location		= !empty($doccure_options['hide_location']) ? $doccure_options['hide_location'] : 'no';
    $search_settings	= !empty( $doccure_options['search_form'] ) ? $doccure_options['search_form'] : '';
    $search_option		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
    $search_type		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
  
  
  
    ob_start();
    if( !empty($search_settings) ){?>
    <div class="container">
 
    <div class="sidebar_search dc-innerbanner-holder dc-haslayout dc-open dc-opensearchs <?php echo esc_attr($hide_location);?>">
                  <form action="<?php echo home_url();?>/search-doctors" method="get" id="search_form">
                              <div class="dc-innerbanner">
                                      <div class="dc-formtheme dc-form-advancedsearch">
                                          <div class="row">
                      <?php if( !empty($hide_location) && $hide_location === 'no'){?>
                                                  <div class="form-group search-location col-md-4">
                                                    <div class="dc-select">
                                                          <?php do_action('doccure_get_search_locations');?>
                                                      </div>
   
                                                  </div>
  
                                              <?php }?>
                        
                                              <div class="form-group search-info col-md-6">
                                                  <?php do_action('doccure_get_search_text_field');?>
                                               </div>
  
                                              <div class="dc-btnarea col-md-2">
                                                  <input type="submit" class="dc-btn" value="<?php esc_attr_e('Search','doccure');?>">
                                              </div>
                      </div>
                                      </div>
                                      </div>
                              
                  </form>
              </div>
    
    </div>
  <?php
    }
        echo ob_get_clean();
  
  
  }
  add_shortcode( 'homesearch_form', 'home_searchform_shortcode' );
  
  function home_searchformthree_shortcode(){
    global $doccure_options;
    $hide_location		= !empty($doccure_options['hide_location']) ? $doccure_options['hide_location'] : 'no';
    $search_settings	= !empty( $doccure_options['search_form'] ) ? $doccure_options['search_form'] : '';
    $search_option		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
    $search_type		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
  
    $gender_search		= !empty($doccure_options['gender_search']) ? $doccure_options['gender_search'] : '';
  
    ob_start();
    if( !empty($search_settings) ){?>
  
    <div class="banner-two-form">
      <div class="app-form col-md-6 col-md-12">
        <div class="search-doctor">
            <div class="search-area">
                <h2><?php esc_html_e('Search Doctor, Make an Appointment','doccure_simple_shortcode'); ?></h2>
                <form action="<?php echo home_url();?>/search-doctors" method="get" id="search_form">
                <div class="row">
                                  <div class="dc-innerbanner">
                                      <div class="dc-formtheme dc-form-advancedsearch">
                                          <fieldset>
                      <div class="col-12 col-md-12">
                      <?php if( !empty($hide_location) && $hide_location === 'no'){?>
                                                  <div class="form-group search-location col-md-12">
                            <label><?php esc_html_e('Location','doccure_simple_shortcode'); ?></label>
                                                    <div class="dc-select">
                                                          <?php do_action('doccure_get_search_locations');?>
                                                      </div>
                                                  </div>
  
                                              <?php }?>
                      </div>
                      <div class="col-12 col-md-12">
                          <?php if( !empty($gender_search) ){?>
                              <div class="form-group" id="">
                              <label><?php esc_html_e('Gender','doccure_simple_shortcode'); ?></label>
                              <div class="dc-select">
                                  <?php do_action('doccure_get_search_gender');?>
                                </div>
                              </div>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-md-12">
                        <label><?php esc_html_e('Speciality','doccure_simple_shortcode'); ?></label>
                          <div class="dc-select">
                                                          <?php do_action('doccure_get_search_speciality');?>
                                                      </div>
                        </div>
                                              <div class="dc-btnarea col-md-12">
                                                  <input type="submit" class="dc-btn" value="<?php esc_attr_e('Search','doccure');?>">
                                              </div>
                                          </fieldset>
                                      </div>
                                      </div>
                
              </div>
                  </form>
  
            </div>
        </div>
      </div>
    </div>
    
  <?php
    }
        echo ob_get_clean();
  
  
  }
  add_shortcode( 'homesearchthree_form', 'home_searchformthree_shortcode' );
  
  function bestdoctors_loop_shortcode() {
    $args = array(
        'post_type' => 'doctors',
        'post_status' => 'publish',
        'posts_per_page' =>-1
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="best-doctor-slider">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
             $am_specialities	= doccure_get_post_meta( get_the_ID(),'am_specialities');
  
            ob_start();
  
            ?>
            <div>
            <div class="best-doctor-widget" style="width: 100%; display: inline-block;">
              <div class="best-doctor-image">
                  <a href="<?php echo get_permalink(get_the_ID())?>"> <img src="<?php echo $url;?>"/></a>
                  <div class="overlay">
                    <div class="pro-icon">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/icon2.png"/>
                    </div>
                    <div class="social-info">
                    </div>
                  </div>
              </div>
              <div class="item-info">
                  <div class="doctor-verify-overlay d-flex">
                  <a href="javascript:void(0)" class="fav-icon" tabindex="0">
                    <span class="doctor-writter"><?php esc_html_e('Verified','doccure_simple_shortcode'); ?></span>
                    <?php do_action('doccure_get_doctorverification_check',get_the_ID(),'');?>
                  </a>
                  </div>
                  <div class="doctor-fav-btn">
                                              <a href="javascript:void(0)" class="fav-icon" tabindex="0">
                                                  <i class="far fa-bookmark"></i>
                                              </a>
                                   </div>
              </div>
              <div class="provider-info text-center">
                <h3> <a href="<?php echo get_permalink(get_the_ID())?>"><?php echo $name;?></a></h3>
                <?php if( !empty( $am_specialities ) ) {
                  $i = 0;
                    foreach ( $am_specialities as $key => $specialities) {
                      if($i == 0) {
                    $specialities_title	= doccure_get_term_name($key ,'specialities'); ?>
                    <p><?php echo esc_html( $specialities_title );?></p>
                <?php  }  $i++; } }
                  ?>
                
                <div>
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width: <?php echo intval( $total_percentage );?>%"></div>
                </div>
                
                </div>
                <div class="content-info">
                    <div class="doctor-appointment-btn"><a class="btn btn-two" href="<?php echo get_permalink(get_the_ID())?>">
                    <?php esc_html_e('Book Appointment','doccure_simple_shortcode'); ?></a></div>
              </div>
              </div>
            </div>
        </div>
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
  <?php 
  }
  
  add_shortcode( 'bestdoctors_loop', 'bestdoctors_loop_shortcode' );
  
  
  
  
  function headerright_new_menu() {
    register_nav_menu('my-custom-menu',__( 'Headerrightmenu' ));
  }
  add_action( 'init', 'headerright_new_menu' );
  
  
  function bestdoctorsfive_loop_shortcode() {
    $args = array(
        'post_type' => 'doctors',
        'post_status' => 'publish',
        'posts_per_page' =>-1
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="best-doctors-slider">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
            
             $am_specialities	= doccure_get_post_meta( get_the_ID(),'am_specialities');
  
  
            ob_start();
  
            ?>
            <div>
            <div class="best-doctors-grid" style="width: 100%; display: inline-block;">
              <div class="best-doctors-img">
                <a href="<?php echo get_permalink(get_the_ID())?>"> <img src="<?php echo $url;?>"/></a>
              </div>
              <div class="best-doctors-info">
                <h3> <a href="<?php echo get_permalink(get_the_ID())?>"><?php echo $name;?></a></h3>
  
                <?php if( !empty( $am_specialities ) ) {
                  $ii = 0;
            foreach ( $am_specialities as $key => $specialities) {
              if($ii == 0) {
                    $specialities_title	= doccure_get_term_name($key ,'specialities'); ?>
            <p class="doctor-posting"><?php echo esc_html( $specialities_title );?></p>
         <?php  } $ii++; } }
          ?>
              <?php if( !empty( $starting_price ) ) { ?>
                <h5 class="doctors-amount">$<?php echo $starting_price; ?></h5>
              <?php } else{ ?>
                <h5 class="doctors-amount">$0</h5>
             <?php  } ?>
             <div class="ratings">
                  <div class="empty-stars"></div>
                  <div class="full-stars" style="width: <?php echo intval( $total_percentage );?>%"></div>
              </div>
                  
                <div class="booking-btn">
                                          <a href="<?php echo get_permalink(get_the_ID())?>" class="btn" tabindex="0">
                                              <span>
                                              <?php esc_html_e('Book Appointment','doccure_simple_shortcode'); ?> <i class="fas fa-arrow-right ms-2"></i>
                                              </span>
                                          </a>
                                      </div> 
                </div>
              </div>
  
        
        </div>
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
  <?php 
  }
  
  add_shortcode( 'bestdoctorsfive_loop', 'bestdoctorsfive_loop_shortcode' );
  
  
  function home_searchformfive_shortcode(){
    global $doccure_options;
    $hide_location		= !empty($doccure_options['hide_location']) ? $doccure_options['hide_location'] : 'no';
    $search_settings	= !empty( $doccure_options['search_form'] ) ? $doccure_options['search_form'] : '';
    $search_option		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
    $search_type		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
  
    $gender_search		= !empty($doccure_options['gender_search']) ? $doccure_options['gender_search'] : '';
  
    ob_start();
    if( !empty($search_settings) ){?>
            
                <form action="<?php echo home_url();?>/search-doctors" method="get" id="search_form">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <?php if( !empty($hide_location) && $hide_location === 'no'){?>
                              <div class="dc-select">
                                <?php do_action('doccure_get_search_locations');?>
                              </div>
                          <?php }?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group"> 
                        <?php if( !empty($gender_search) ){?>
                              <div class="dc-select">
                                  <?php do_action('doccure_get_search_gender');?>
                                </div>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group"> 
                        <?php if( !empty($gender_search) ){?>
                              <div class="dc-select">
                              <?php do_action('doccure_get_search_speciality');?>
                                </div>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <div class="app_btn">
                         <input type="submit" class="dc-btn" value="<?php esc_attr_e('MAKE APPOINTMENT','doccure');?>">
                        </div>
                    </div>
                </div>
              </div>
                  </form>
  
        
       
    
  <?php
    }
        echo ob_get_clean();
  
  
  }
  add_shortcode( 'homesearchfive_form', 'home_searchformfive_shortcode' );
  
  function availablefeatures_loop_shortcode() {
    $args = array(
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' =>-1
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="features-clinic-slider-four">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
  
            ob_start();
  
            ?>
            <div>
              <div class="features-clinic-grid">
                <div class="features-clinic-img">
                    <a href="<?php echo get_permalink(get_the_ID())?>"> <img src="<?php echo $url;?>"/></a>
                </div>
                <div class="feature-clinic-overlay">
                  <p><?php echo $name;?></p>
                </div>
  
              </div>
        </div>
        
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
    
          <div class="text-end">
                  <a href="#" class="btn btn-one"><?php esc_html_e('View More','doccure_simple_shortcode'); ?></a>
              </div>
      
  <?php 
  }
  
  add_shortcode( 'availablefeatures_loop', 'availablefeatures_loop_shortcode' );
  
  
  function headerhomefiveright_new_menu() {
    register_nav_menu('header-homefive-menu',__( 'Headerhomefiverightmenu' ));
  }
  add_action( 'init', 'headerhomefiveright_new_menu' );
  
  function headerhomefiveprivacy_menu() {
    register_nav_menu('header-privacy-menu',__( 'Footerightmenu' ));
  }
  add_action( 'init', 'headerhomefiveprivacy_menu' );
  
  
  function qualityservices_loop_shortcode() {
    // Get the taxonomy's terms
  $terms = get_terms(
    array(
        'taxonomy'   => 'specialities',
        'hide_empty' => false,
        'number'        => 6
    )
  );
  
    ?>
    <div class="row">
    <?php
   // Check if any term exists
    if ( ! empty( $terms ) && is_array( $terms ) ) {
  
      foreach ( $terms as $term ) {
       //echo "<pre>";
      //print_r($term);
  
        $logo 			= get_term_meta( $term->term_id, 'logo', true );
       // echo "<pre>";
       // print_r($logo);
              $current_logo	= !empty( $logo['url'] ) ? $logo['url'] : '';
            $attachment_id	= !empty( $logo['attachment_id'] ) ? $logo['attachment_id'] : '';
       
            ob_start();
  
            ?>
               <div class="col-lg-4 col-md-4">
                  <div class="high-service-box">
                      <div class="service-box-inner">
                        <div class="high-service-img">
                            <span>
                              <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                            </span>
                         </div>
                          <div class="overlay">
                            <div class="pro-icon">
                              <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                            </div>
                            <div class="pro-text">
                              <h4><?php echo $term->name; ?></h4>
                              <p><?php echo $term->count;?> <?php esc_html_e('Doctors','doccure_simple_shortcode'); ?></p>
                            </div>
                                            </div> <!-- overlay -->
                          <h4 class="high-service-head"><?php echo $term->name; ?></h4>
                          <p class="high-service-text"><?php echo $term->count;?> <?php esc_html_e('Doctors','doccure_simple_shortcode'); ?> </p>
                      </div>
                  </div>
                </div>
          
            <?php 
                echo ob_get_clean();
      }
  
      }
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'qualityservices_loop', 'qualityservices_loop_shortcode' );
  
  function availablefeatureshomethree_loop_shortcode() {
    $args = array(
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' =>6
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="row clinic-row">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
            
             if( class_exists('Dynamic_Featured_Image') ) {
              global $dynamic_featured_image;
              $featured_images = $dynamic_featured_image->get_featured_images( get_the_ID()) ;
  
              $imgsrc = $featured_images[0]['full'];
              
              //You can now loop through the image to display them as required
          }
  
            ob_start();
  
            ?>
            
            <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
                <div class="clinic-grid w-100 hvr-bounce-to-right">
                    <img src="<?php echo $imgsrc;?>"/>
                    <h4><?php echo $name;?></h4>
                </div>
             </div>
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'availablefeatureshomethree_loop', 'availablefeatureshomethree_loop_shortcode' );
  
  
  
  function specialities_loop_shortcode() {
    // Get the taxonomy's terms
  $terms = get_terms(
    array(
        'taxonomy'   => 'specialities',
        'hide_empty' => false,
    )
  );
  
    ?>
    <div class="row justify-content-center">
    <?php
   // Check if any term exists
    if ( ! empty( $terms ) && is_array( $terms ) ) {
  
      foreach ( $terms as $term ) {
       //echo "<pre>";
      //print_r($term);
  
        $logo 			= get_term_meta( $term->term_id, 'logo', true );
       // echo "<pre>";
       // print_r($logo);
              $current_logo	= !empty( $logo['url'] ) ? $logo['url'] : '';
            $attachment_id	= !empty( $logo['attachment_id'] ) ? $logo['attachment_id'] : '';
       
            ob_start();
  
            ?>
              <div class="col-lg-3 col-md-6 d-flex aos aos-init aos-animate">
                  <div class="clinic-grid-four w-100">
                      <div class="clinic-img">
                      
                          <img src="<?php echo get_taxonomy_image($term->term_id);?>" class="specalitist_logo" alt="" />
                          <div class="clinic-content">
                                                <h4><?php echo $term->name; ?></h4>
                                          </div>
                          <div class="clinic-icon-inner">
                            <div class="clinic-box-img">
                              <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                            </div>
                          </div>
                      </div>
                      <div class="overlay">
                        <div class="clinic-cricle">
                            <div class="clinic-round">
                            <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                            </div>
                        </div>
                        <h4><?php echo $term->name; ?></h4>
                      </div>
                   </div>
              </div>
               
            <?php 
                echo ob_get_clean();
      }
  
      }
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'specialities_loop', 'specialities_loop_shortcode' );
  
  
  
  function specialitieshomesix_loop_shortcode() {
    // Get the taxonomy's terms
  $terms = get_terms(
    array(
        'taxonomy'   => 'specialities',
        'hide_empty' => false,
        'number'        => 6,
    )
  );
  
    ?>
    <div class="row justify-content-center">
    <?php
   // Check if any term exists
    if ( ! empty( $terms ) && is_array( $terms ) ) {
  
      foreach ( $terms as $term ) {
       //echo "<pre>";
      //print_r($term);
  
        $logo 			= get_term_meta( $term->term_id, 'logo', true );
       // echo "<pre>";
       // print_r($logo);
              $current_logo	= !empty( $logo['url'] ) ? $logo['url'] : '';
            $attachment_id	= !empty( $logo['attachment_id'] ) ? $logo['attachment_id'] : '';
       
            ob_start();
  
            ?>
              <div class="col-lg-2 col-md-4 aos aos-init aos-animate">
                    <div class="clinic-grid-five hvr-bounce-to-bottom">
                      <div class="clinic-grid-img">
                        <div class="clinic-img-five bgcolor">
                          <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                        </div>
                      </div>
                      <div class="clinic-grid-info">
                          <p><?php echo $term->name; ?></p>
                          <div class="clinic-five-btn">
                            <a href="<?php echo home_url();?>/specialities/<?php echo $term->slug;?>" class="btn"><?php esc_html_e('Consult Now','doccure_simple_shortcode'); ?></a>
                          </div>
                      </div>
                    </div>
              </div>
               
            <?php 
                echo ob_get_clean();
      }
  
      }
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'specialitieshomesix_loop', 'specialitieshomesix_loop_shortcode' );
  
  
  function browsespecialities_loop_shortcode() {
    // Get the taxonomy's terms
  $terms = get_terms(
    array(
        'taxonomy'   => 'specialities',
        'hide_empty' => false,
    )
  );
  
    ?>
    <div class="row justify-content-center">
    <?php
   // Check if any term exists
    if ( ! empty( $terms ) && is_array( $terms ) ) {
  
      foreach ( $terms as $term ) {
       //echo "<pre>";
      //print_r($term);
  
        $logo 			= get_term_meta( $term->term_id, 'logo', true );
       // echo "<pre>";
       // print_r($logo);
              $current_logo	= !empty( $logo['url'] ) ? $logo['url'] : '';
            $attachment_id	= !empty( $logo['attachment_id'] ) ? $logo['attachment_id'] : '';
       
            ob_start();
  
            ?>
              <div class="col-lg-3 col-md-6 aos aos-init aos-animate">
                <div class="specialist-card-five d-flex hvr-bounce-to-right">
                    <div class="specialist-img-five">
                    <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                    </div>
                    <div class="specialist-info">
                    <a href="<?php echo home_url();?>/specialities/<?php echo $term->slug;?>"><?php echo $term->name; ?></a>
                                    </div>
                    <div class="specialist-nav-five ms-auto">
                                        <a href="#"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                </div>
              </div>
            <?php 
                echo ob_get_clean();
      }
  
      }
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'browsespecialities_loop', 'browsespecialities_loop_shortcode' );
  
  function doctorsgridfive_loop_shortcode() {
    $args = array(
        'post_type' => 'doctors',
        'post_status' => 'publish',
        'posts_per_page' =>4
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="row">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
            
             $am_specialities	= doccure_get_post_meta( get_the_ID(),'am_specialities');
  
  
            ob_start();
  
            ?>
            <div class="col-lg-3 col-md-6 d-flex aos aos-init aos-animate">
                <div class="doctors-grid-five w-100">
                    <div class="doctors-img-five">
                      <a href="<?php echo get_permalink(get_the_ID())?>">
                        <img src="<?php echo $url;?>"/>
                      </a>
                                    </div>
                    <div class="best-doctors-info one">
                      <h3><a href="<?php echo get_permalink(get_the_ID())?>"><?php echo $name;?></a></h3>
                      <?php if( !empty( $am_specialities ) ) {
                          $ib = 0;
                            foreach ( $am_specialities as $key => $specialities) {
                              if($ib == 0) {
                            $specialities_title	= doccure_get_term_name($key ,'specialities'); ?>
                            <p class="doctor-posting"><?php echo esc_html( $specialities_title );?></p>
                        <?php  }  $ib++; } }
                          ?>
                         
                         <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width: <?php echo intval( $total_percentage );?>%"></div>
                         </div>
                     
                      <div class="doctors-btn-five">
                      <a href="<?php echo get_permalink(get_the_ID())?>" class="btn w-100"><?php esc_html_e('Book Appointment','doccure_simple_shortcode'); ?></a>
                      </div>
                                    </div>
                </div>
            </div>
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
  <?php 
  }
  
  add_shortcode( 'doctorsgridfive_loop', 'doctorsgridfive_loop_shortcode' );
  
  function featureshomesix_loop_shortcode() {
    $args = array(
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' =>6
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="row justify-content-center">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback			= get_post_meta(get_the_ID(),'review_data',true);
            $feedback			= !empty( $feedback ) ? $feedback : array();
            $total_rating		= !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage	= !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name			= doccure_full_name(get_the_ID() );
             $name			= !empty( $name ) ? $name : '';
             $starting_price	= doccure_get_post_meta( get_the_ID(), 'am_starting_price');
            
             if( class_exists('Dynamic_Featured_Image') ) {
              global $dynamic_featured_image;
              $featured_images = $dynamic_featured_image->get_featured_images( get_the_ID()) ;
  
              $imgsrc = $featured_images[0]['full'];
              
              //You can now loop through the image to display them as required
          }
  
            ob_start();
  
            ?>
            
            <div class="col-lg-2 col-md-4 d-flex aos aos-init aos-animate">
              <div class="clinic-grid-five w-100 hvr-bounce-to-bottom">
                  <div class="clinic-grid-img">
                                      <div class="clinic-img-five clinic-img-five1">
                      <img src="<?php echo $imgsrc;?>"/>
                                      </div>
                                  </div>
                  <div class="clinic-grid-info">
                                      <p><?php echo $name;?></p>
                                  </div>
              </div>
             </div>
            <?php 
                        echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'featureshomesix_loop', 'featureshomesix_loop_shortcode' );
  
  function home_searchformsix_shortcode(){
    global $doccure_options;
    $hide_location		= !empty($doccure_options['hide_location']) ? $doccure_options['hide_location'] : 'no';
    $search_settings	= !empty( $doccure_options['search_form'] ) ? $doccure_options['search_form'] : '';
    $search_option		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
    $search_type		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
  
  
  
    ob_start();
    if( !empty($search_settings) ){?>
        <div class="search-box-five">
                  <form action="<?php echo home_url();?>/search-doctors" method="get" id="search_form">
                      <?php if( !empty($hide_location) && $hide_location === 'no'){?>
                        <div class="search-input-five loc_field">
                                                    <div class="dc-select">
                                                          <?php do_action('doccure_get_search_locations');?>
                                                      </div>
                     
                                              <?php }?>
                        </div>
                        <div class="search-input-five line-five">
                                                  <?php do_action('doccure_get_search_text_field');?>
                        </div>
                        <div class="search-btn-five">
                                                  <input type="submit" class="dc-btn btn search_service" value="<?php esc_attr_e('Search','doccure');?>">
                        </div>
                                  
                  </form>
      
        </div>
  <?php
    }
        echo ob_get_clean();
  
  
  }
  add_shortcode( 'homesearchsix_form', 'home_searchformsix_shortcode' );
  
  
  function hometwospecialities_loop_shortcode() {
    // Get the taxonomy's terms
  $terms = get_terms(
    array(
        'taxonomy'   => 'specialities',
        'hide_empty' => false,
        'number'        => 4,
    )
  );
  
    ?>
    <div class="row justify-content-center">
    <?php
   // Check if any term exists
    if ( ! empty( $terms ) && is_array( $terms ) ) {
  
      foreach ( $terms as $term ) {
       //echo "<pre>";
      //print_r($term);
  
        $logo 			= get_term_meta( $term->term_id, 'logo', true );
       // echo "<pre>";
       // print_r($logo);
              $current_logo	= !empty( $logo['url'] ) ? $logo['url'] : '';
            $attachment_id	= !empty( $logo['attachment_id'] ) ? $logo['attachment_id'] : '';
       
            ob_start();
  
            ?>
              <div class="col-lg-3 col-md-6 aos aos-init aos-animate">
              <div class="service-grid">
                              <div class="effect-oscar">
                <img src="<?php echo get_taxonomy_image($term->term_id);?>" class="services-img" alt="" />
                                  <div class="services-caption">
                                      <div class="services-inner">
                                          <div class="service-grid-icon">
                      <img src="<?php echo $logo['url'];?>" class="specalitist_logo" alt="" />
                                          </div>
                                          <p><?php echo $term->name; ?></p>
                                          <a href="<?php echo home_url();?>/specialities/<?php echo $term->slug;?>" class="service-link">
                                              <i class="fas fa-arrow-right"></i>
                                          </a>
                                      </div>
                                  </div>			
                              </div>
                          </div>
                
              </div>
               
            <?php 
                echo ob_get_clean();
      }
  
      }
    ?>
    </div>
    
      
  <?php 
  }
  
  add_shortcode( 'hometwospecialities_loop', 'hometwospecialities_loop_shortcode' );
  
  function featureshometwo_loop_shortcode() {
    $args = array(
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' =>-1
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="features-section-slider">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback     = get_post_meta(get_the_ID(),'review_data',true);
            $feedback     = !empty( $feedback ) ? $feedback : array();
            $total_rating   = !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage = !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name     = doccure_full_name(get_the_ID() );
             $name      = !empty( $name ) ? $name : '';
             $starting_price  = doccure_get_post_meta( get_the_ID(), 'am_starting_price');
            
             if( class_exists('Dynamic_Featured_Image') ) {
              global $dynamic_featured_image;
              $featured_images = $dynamic_featured_image->get_featured_images( get_the_ID()) ;
  
              $imgsrc = $featured_images[0]['full'];
              
              //You can now loop through the image to display them as required
          }
  
            ob_start();
  
            ?>
               <div>
                 <div class="features-grid hvr-bounce-to-bottom" style="width: 100%;display: inline-block;">
                    <div class="features-cricle">
                     <div class="features-round">
                       <img src="<?php echo $imgsrc;?>"/>
                </div>
                </div>
              <p><?php echo $name;?></p>
            </div>
           </div>
            
       
            <?php 
                  echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
  
      
      <div class="slick-view-btn me-2">
                <a href="#" class="viewall"><?php esc_html_e('View More','doccure_simple_shortcode'); ?> <i class="fas fa-arrow-right ms-2"></i></a>
              </div>
     
    
    
  <?php 
  }
  
  add_shortcode( 'featureshometwo_loop', 'featureshometwo_loop_shortcode' );
  
  
  function doctors_hometwo_loop_shortcode() {
    $args = array(
        'post_type' => 'doctors',
        'post_status' => 'publish',
        'posts_per_page' =>-1
    );
  
    $my_query = null;
    $my_query = new WP_query($args);
    ?>
    <div class="doctor-book-slider">
    <?php
    if($my_query->have_posts()):
        while($my_query->have_posts()) : $my_query->the_post();
            $custom = get_post_custom( get_the_ID() );
             if ( has_post_thumbnail() ) { 
                      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
          }else{ 
                 $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
          } 
           
            $feedback     = get_post_meta(get_the_ID(),'review_data',true);
            $feedback     = !empty( $feedback ) ? $feedback : array();
            $total_rating   = !empty( $feedback['dc_total_rating'] ) ? $feedback['dc_total_rating'] : 0 ;
            $total_percentage = !empty( $feedback['dc_total_percentage'] ) ? $feedback['dc_total_percentage'] : 0 ;
            $name     = doccure_full_name(get_the_ID() );
             $name      = !empty( $name ) ? $name : '';
             $starting_price  = doccure_get_post_meta( get_the_ID(), 'am_starting_price');
  
             $am_specialities	= doccure_get_post_meta( get_the_ID(),'am_specialities');
            ob_start();
  
            ?>
            <div>
            <div class="doctor-profile-widget" style="display: inline-block; width:100%">
            <a href="<?php echo get_permalink(get_the_ID())?>"><img class="home2_doctor_img" src="<?php echo $url;?>"/></a>
            <div class="pro-content">
              <div class="provider-info">
                <div class="pro-icon">
                  <img src="<?php echo get_template_directory_uri();?>/assets/images/icon2.png"/>
                </div>
                <h3 class="mb-1">
          <a href="<?php echo get_permalink(get_the_ID())?>"><?php echo $name;?>
          <?php do_action('doccure_get_doctorverification_check',get_the_ID(),'');?>
        </a>
          </h3>
          
          <?php if( !empty( $am_specialities ) ) {
                    foreach ( $am_specialities as $key => $specialities) {
                    $specialities_title	= doccure_get_term_name($key ,'specialities'); ?>
                    <p><?php echo esc_html( $specialities_title );?></p>
                <?php  } }
                  ?>
         
          <div>
          <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width: <?php echo intval( $total_percentage );?>%"></div>
                </div>
          </div>
          <div class="content-info">
            <div class="social-info">
            
            </div>
            <div class="booking-btn">
            <button class="book-btn" tabindex="0"> <a href="<?php echo get_permalink(get_the_ID())?>">
            <?php esc_html_e('Book Appointment','doccure_simple_shortcode'); ?></a></button>
            </div>
          </div>
              </div>
            </div>
            </div>
        </div>
            <?php 
                  echo ob_get_clean();
  
        endwhile;
        wp_reset_postdata();
    else :
    _e( 'Sorry, no posts matched your criteria.' );
    endif;
    ?>
    </div>
    
      <div class="slick-view-btn me-2">
                <a href="#" class="viewall"><?php esc_html_e('View More','doccure_simple_shortcode'); ?> <i class="fas fa-arrow-right ms-2"></i></a>
              </div>
      
  <?php 
  }
  add_shortcode( 'homepagetwodoctors_loop', 'doctors_hometwo_loop_shortcode' );
  
  
  function hometwo_searchform_shortcode(){
    global $doccure_options;
    $hide_location		= !empty($doccure_options['hide_location']) ? $doccure_options['hide_location'] : 'no';
    $search_settings	= !empty( $doccure_options['search_form'] ) ? $doccure_options['search_form'] : '';
    $search_option		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
    $search_type		= !empty($doccure_options['search_type']) ? $doccure_options['search_type'] : '';
  
  
  
    ob_start();
    if( !empty($search_settings) ){?>
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="appoinment-wrapper">
    <div class="appoinment-box">
                  <form action="<?php echo home_url();?>/search-doctors" method="get" id="search_form">
              <div class="row">
                  <div class="col-md-6 ">
                    <div class="form-group appoinment-location">
                          <div class="dc-select">
                                <?php do_action('doccure_get_search_locations');?>
                            </div>
                  </div>
              </div>
                  <div class="col-md-6 ">
                                              <div class="appoinment-right">
                                                  <div class="form-group appoinment-location">
                          <?php do_action('doccure_get_search_text_field');?>
                                                  </div>
                                                  <div class="form-group">
                          <input type="submit" class="dc-btn" value="<?php esc_attr_e('Search','doccure');?>">
                                                  </div>
                                              </div>
                                          </div>
                          </div>
  
              </div>
                      
                              
                  </form>
              </div>
        </div>
      </div>
     </div>
    </div>
  <?php
    }
        echo ob_get_clean();
  
  
  }
  add_shortcode( 'hometwosearch_form', 'hometwo_searchform_shortcode' );
  
  add_filter( 'woocommerce_checkout_redirect_empty_cart', '__return_false' );
  
  
  add_filter( 'woocommerce_should_load_paypal_standard', '__return_true' );
  
  /*Homepage Blog */
  function homeblog_loop_shortcode() {
      $args = array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' =>3,
          'orderby' => 'meta_value_num',
          'order' => 'DESC'
      );
    
      $my_query = null;
      $my_query = new WP_query($args);
      ?>
      <div class="latest-news">
        <div class="row">
      <?php
      if($my_query->have_posts()):
          while($my_query->have_posts()) : $my_query->the_post();
              $custom = get_post_custom( get_the_ID() );
               if ( has_post_thumbnail() ) { 
                        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                   
            }else{ 
                   $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
            } 
    
              ob_start();
        if(is_page_template('homepagetwo.php')) {
              ?>
    
            <div class="col-lg-4 col-md-6">
              <article>
                <div class="homeblog_img">
                  <a href="<?php the_permalink();?>"><img src="<?php echo $url;?>"/></a>
                </div>
                <div class="homeblog_content_block">
                  <div class="homeblog_desc">
                      <div class="hometwoblog_date">
                        <span class="posted-on">
                        <i class="far fa-clock"></i>
                        <a href="<?php the_permalink();?>" rel="bookmark">
                        <?php echo get_the_date(); ?></a>
                        </span>
                      </div>
                      <div class="hometwoblog_meta">
                      <span class="categories-list">
                          <i class="fas fa-tags"></i>
                          <a href="https://doccure-wp.dreamstechnologies.com/category/clinic/" rel="category tag">
                          <?php 
                          $category_detail=get_the_category(get_the_ID() );
                              foreach($category_detail as $cd){
                                echo $cd->cat_name;
                          }
                          ?>
                      </a> </span>
                      </div>
                      <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                  </div>
                  <div class="hometwoblog_readmore">
                      <a href="<?php the_permalink();?>"><?php esc_html_e('Read more','doccure_simple_shortcode'); ?></a>
                  </div>
                </div>
              </article>
            </div>
         
              <?php 
        } else if(is_page_template('homepagethree.php')) { ?>
          <div class="col-lg-4 col-md-6">
              <article>
                <div class="homeblog_img">
                  <a href="<?php the_permalink();?>"><img src="<?php echo $url;?>"/></a>
                  <div class="overlay"></div>
                </div>
                
                <div class="homeblog_content_block">
                  <div class="homeblog_desc">
                      <div class="hometwoblog_date">
                        <span class="posted-on">
                        <i class="far fa-clock"></i>
                        <a href="<?php the_permalink();?>" rel="bookmark">
                        <?php echo get_the_date(); ?></a>
                        </span>
                      </div>
                      <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                  </div>
                </div>
                <div>
                <a href="<?php the_permalink();?>" class="blog-news-arrows" tabindex="0">
                    <i class="fas fa-arrow-right"></i>
                </a>
              </div>
              </article>
            </div>
        <?php } else if(is_page_template('homepagefour.php')) {?>
          <div class="col-lg-4 col-md-6">
              <article>
                <div class="homeblog_img">
                   <a href="<?php the_permalink();?>"><img src="<?php echo $url;?>"/></a>
                   <div class="blog-date-four">
                    <span class="posted-on">
                    <i class="far fa-clock"></i>
                    <a href="<?php the_permalink();?>" rel="bookmark" tabindex="0">
                    <?php echo get_the_date(); ?></a></a>
                    </span>
                    </div>
                  </div>
                
                <div class="homeblog_content_block">
                  <div class="blog-info-four">
                      <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                  </div>
                  <div class="blog-doctors-four">
                  <div class="d-flex justify-content-between align-items-center">
                  <div>
                  <span class="author">
                  <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                  <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                  <?php echo get_the_author(); ?> </a>
                  </span>
                  </div>
                  <div>
                  <span class="categories-list">
                    <i class="fas fa-tags"></i>
                    <a href="https://doccure-wp.dreamstechnologies.com/category/clinic/" rel="category tag" tabindex="0">
                    <?php 
                            $category_detail=get_the_category(get_the_ID() );
                                foreach($category_detail as $cd){
                                  echo $cd->cat_name;
                            }
                            ?>
                    </a> 
                  </span>
                  </div>
                  </div>
                  </div>
                  <div class="homefour_blogcontent">
                  <p>
                  <?php echo wp_trim_words( get_the_content(), 25, '...' );?>
                  </p>
                  <div class="blog-four-arrow">
                    <a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
                        </div>
                  </div>
                  
                </div>
               
              </article>
            </div>
       <?php  } else if(is_page_template('homepagefive.php')) { ?>
        <div class="col-lg-4 col-md-6">
              <article>
                <div class="homeblog_img blog-five-img">
                   <a href="<?php the_permalink();?>"><img src="<?php echo $url;?>"/></a>
                   <div class="blog-item-info">
  
                    <div class="blog-news-date">
                        <div class="homefive_postmeta">
                          <span class="posted-on">
                          <i class="far fa-clock"></i>
                          <a href="<?php the_permalink();?>" rel="bookmark" tabindex="0">
                          <?php echo get_the_date(); ?></a>
                          </span>
                        </div>
                    </div>
  
                    <div class="blog-doctors-profile">
                        <span class="author">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                        <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                        <?php echo get_the_author(); ?> </a>
                        </span>
                    </div>
  
                    </div>
                   
                </div>
                
                <div class="blog-info-five">
                      <h3 class="blog-news-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                      <p>
                        <?php echo wp_trim_words( get_the_content(), 20, '...' );?>
                      </p>
                      <a href="<?php the_permalink();?>" class="btn-link" tabindex="0">
                        <?php esc_html_e('Read News','doccure_simple_shortcode'); ?>
                    </a>
                </div>
  
  
              </article>
            </div>
       <?php } else { ?>
          <div class="col-lg-4 col-md-6">
              <article>
                <div class="homeblog_img">
                  <a href="<?php the_permalink();?>"><img src="<?php echo $url;?>"/></a>
                </div>
                <div class="homeblog_content_block">
                  <div class="homeblog_desc">
                      <div class="homeblog_date">
                        <?php echo get_the_date(); ?>
                      </div>
                      <div class="homeblog_meta">
                      <?php 
                      $category_detail=get_the_category(get_the_ID() );
                          foreach($category_detail as $cd){
                            echo $cd->cat_name;
                      }
                      ?>
                      </div>
                      <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                  </div>
                  <div class="homeblog_readmore">
                      <a href="<?php the_permalink();?>"><?php esc_html_e('Read more','doccure_simple_shortcode'); ?></a>
                  </div>
                </div>
              </article>
            </div>
       <?php  } //default blog
                          echo ob_get_clean();
    
          endwhile;
          wp_reset_postdata();
      else :
          esc_html_e( 'Sorry, no posts matched your criteria.','doccure_simple_shortcode' );
      endif;
      ?>
      </div>
      </div>
  
    <?php 
    }
    
    add_shortcode( 'homeblog_loop', 'homeblog_loop_shortcode' );
  
    function about_services_shortcode() {
      $args = array(
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
      );
      
      $my_query = null;
      $my_query = new WP_query($args);
      ?>
      <div class="about_services_section">
          <div class="row">
      <?php
      if($my_query->have_posts()):
        $i=0;
        while($my_query->have_posts()) : $my_query->the_post();
          $custom = get_post_custom( get_the_ID() );
          ob_start();
          $i++;
          ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <article>
                  <span class="number">0<?php echo $i;?></span>
                  <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                </article>
              </div>
         <?php  
                echo ob_get_clean();
      
        endwhile;
        wp_reset_postdata();
      else :
        esc_html_e( 'Sorry, no posts matched your criteria.','doccure_simple_shortcode' );
      endif;
      ?>
      </div>
      </div>
    
      <?php 
      }
      
      add_shortcode( 'about_services', 'about_services_shortcode' );
  
        function about_testimonials_shortcode() {
          $args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
          );
          
          $my_query = null;
          $my_query = new WP_query($args);
          ?>
          <div class="about_services_section">
              <div class="row">
          <?php
          if($my_query->have_posts()):
            $i=0;
            while($my_query->have_posts()) : $my_query->the_post();
              $custom = get_post_custom( get_the_ID() );
              if ( has_post_thumbnail() ) { 
                $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
             
            }else{ 
              $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
            } 
              ob_start();
              $i++;
              ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="about_testimonial">
                      <div class="about_testimonial_body">
                          <span class="fas fa-quote-left"></span>
                          <?php the_content();?>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="testmoinal_img">
                          <img src="<?php echo  $url;?>"/>
                        </div>
                        <div class="testmoinal_info">
                            <h5><?php the_title();?></h5>
                            <span class="designation"><?php the_excerpt(); ?></span>
                            <span></span>
                        </div>
                      </div>
                    </div>
                 </div>
             <?php  
                    echo ob_get_clean();
          
            endwhile;
            wp_reset_postdata();
          else :
            esc_html_e( 'Sorry, no posts matched your criteria.','doccure_simple_shortcode' );
          endif;
          ?>
          </div>
          </div>
        
          <?php 
          }
          
          add_shortcode( 'about_testimonials', 'about_testimonials_shortcode' );
  
          function serviceslist_shortcode() {
            $args = array(
              'post_type' => 'services',
              'post_status' => 'publish',
              'posts_per_page' => 6,
              'orderby' => 'meta_value_num',
              'order' => 'DESC'
            );
            
            $my_query = null;
            $my_query = new WP_query($args);
            ?>
            <div class="serviceslist_section">
                <div class="row">
            <?php
            if($my_query->have_posts()):
              while($my_query->have_posts()) : $my_query->the_post();
                $custom = get_post_custom( get_the_ID() );
                if ( has_post_thumbnail() ) { 
                  $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
               
              }else{ 
                $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
              } 
                ob_start();
                ?>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                      <article>
                        <div class="servicelist_img">
                        <a href="<?php the_permalink();?>">
                          <img src="<?php echo $url;?>"/>
                        </a>
                       </div>
                        <div class="service_body">
                          <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                        </div>
                      </article>
                   </div>
               <?php  
                      echo ob_get_clean();
            
              endwhile;
              wp_reset_postdata();
            else :
              esc_html_e( 'Sorry, no posts matched your criteria.','doccure_simple_shortcode' );
            endif;
            ?>
            </div>
            </div>
          
            <?php 
            }
            
            add_shortcode( 'services_list', 'serviceslist_shortcode' );
  
            function services_testimonials_shortcode() {
              $args = array(
                'post_type' => 'testimonials',
                'post_status' => 'publish',
                'posts_per_page' => 6,
                'orderby' => 'meta_value_num',
                'order' => 'DESC'
              );
              
              $my_query = null;
              $my_query = new WP_query($args);
              ?>
              <div class="servicespagetestimonial_section">
                  <div class="row">
              <?php
              if($my_query->have_posts()):
                $i=0;
                while($my_query->have_posts()) : $my_query->the_post();
                  $custom = get_post_custom( get_the_ID() );
                  if ( has_post_thumbnail() ) { 
                    $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                 
                }else{ 
                  $url=get_template_directory_uri( ) ."/assets/images/dravatar-100x100.jpg";
                } 
                  ob_start();
                  $i++;
                  ?>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="servicepage_testimonial">
                          <div class="servicepage_testimonial_body">
                              <div class="d-flex align-items-center">
                                <div class="servicepage_testimonial_image"> 
                                    <img src="<?php echo  $url;?>"/>
                                </div>
                                <div class="testmoinal_info">
                                  <h5><?php the_title();?></h5>
                                </div>
                              </div>
                              <div class="d-block d-sm-flex mt-4">
                                <span class="fas fa-quote-left"></span>
                                <?php the_content();?>
                              </div>
                              
                          </div>
                         
                        </div>
                     </div>
                 <?php  
                        echo ob_get_clean();
              
                endwhile;
                wp_reset_postdata();
              else :
                esc_html_e( 'Sorry, no posts matched your criteria.','doccure_simple_shortcode' );
              endif;
              ?>
              </div>
              </div>
            
              <?php 
              }
              
              add_shortcode( 'services_testimonials', 'services_testimonials_shortcode' );


/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
/**
 * Deactive plugin
 *
 * @throws error
 * @return 
 */
if( !function_exists('doccure_simple_shortcode_load_textdomain') ) {
	add_action( 'init', 'doccure_simple_shortcode_load_textdomain' );
	function doccure_simple_shortcode_load_textdomain() {
	  load_plugin_textdomain( 'doccure_simple_shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
}