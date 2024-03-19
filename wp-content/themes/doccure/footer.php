<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package doccure
 */
$footer_layout = doccure_get_option('footer-layout', 'layout-8');
$footer_type = doccure_get_option('footer_type', 'static');
?>
</div><!-- #content -->

<?php echo doccure_get_the_page_template('page_template_after_footer', 'enable_page_template_after_footer'); ?>


<?php  
  if(is_page_template('homepagefour.php')) {
  ?>
    <footer class="homepage_footer homefour">
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="homepage_firstsec">
                    <?php 
                    if ( is_active_sidebar( 'homefourpage-area' ) ) : ?>
                    <?php dynamic_sidebar( 'homefourpage-area' ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <?php 
                if ( is_active_sidebar( 'footer-column-2' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-column-2' ); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-6">
            <?php 
                if ( is_active_sidebar( 'footer-column-3' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-column-3' ); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-6">
            <?php 
                if ( is_active_sidebar( 'homefourpage-lastarea' ) ) : ?>
                <div id="social-widget-area" class="chw-widget-area widget-area" role="complementary">
                <?php dynamic_sidebar( 'homefourpage-lastarea' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                <div class="copyright-text">
                <p class="mb-0">
                        <?php  echo esc_html(doccure_get_option('footer_copyright')); ?></p>
				</div>
               
                </div>
                <div class="col-md-6 col-lg-6">
                    <?php 
                        wp_nav_menu( array( 
                    'theme_location' => 'header-privacy-menu', 
                    'container_class' => 'header-privacy-menu' ) );
                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>
</footer>
  <?php } else if(is_page_template('homepagefive.php')) { ?>
         <footer class="homepage_footer footerhomesix">
         <div class="footer-top">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-3 col-md-6">
                         <div class="homepage_firstsec">
                             <?php 
                             if ( is_active_sidebar( 'footer-column-1' ) ) : ?>
                             <?php dynamic_sidebar( 'footer-column-1' ); ?>
                             <?php endif; ?>
                         </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="homefive_contactus">
                            <?php 
                            if ( is_active_sidebar( 'homefivepage-secondarea' ) ) : ?>
                            <?php dynamic_sidebar( 'homefivepage-secondarea' ); ?>
                            <?php endif; ?>
                         </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                     <?php 
                         if ( is_active_sidebar( 'homefivepage-thirdarea' ) ) : ?>
                         <?php dynamic_sidebar( 'homefivepage-thirdarea' ); ?>
                         <?php endif; ?>
                     </div>
                     <div class="col-lg-3 col-md-6">
                     <?php 
                         if ( is_active_sidebar( 'homefivepage-fourtharea' ) ) : ?>
                         <?php dynamic_sidebar( 'homefivepage-fourtharea' ); ?>
                         <?php endif; ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer-bottom">
             <div class="container">
                 <div class="copyright">
                     <div class="row">
                         <div class="col-md-6 col-lg-6">
                         <div class="copyright-text">
                         <p class="mb-0">
                        <?php  echo esc_html(doccure_get_option('footer_copyright')); ?></p>
                         </div>
                        
                         </div>
                         <div class="col-md-6 col-lg-6">
                             <?php 
                                 wp_nav_menu( array( 
                             'theme_location' => 'header-privacy-menu', 
                             'container_class' => 'header-privacy-menu' ) );
                             ?> 
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </footer>
 <?php  } else { ?>

    <footer class="homepage_footer">
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="homepage_firstsec">
                    <?php 
                    if ( is_active_sidebar( 'footer-column-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-column-1' ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <?php 
                if ( is_active_sidebar( 'footer-column-2' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area specality_menu" role="complementary">
                <?php dynamic_sidebar( 'footer-column-2' ); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-6">
            <?php 
                if ( is_active_sidebar( 'footer-column-3' ) ) : ?>
                <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-column-3' ); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-6">
            <?php 
                if ( is_active_sidebar( 'footer-column-4' ) ) : ?>
                <div id="social-widget-area" class="chw-widget-area widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-column-4' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                <div class="copyright-text">
                <p class="mb-0">
                        <?php  echo esc_html(doccure_get_option('footer_copyright')); ?></p>
				</div>
               
                </div>
                <div class="col-md-6 col-lg-6">
                    <?php 
                        wp_nav_menu( array( 
                    'theme_location' => 'header-privacy-menu', 
                    'container_class' => 'header-privacy-menu' ) );
                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>
</footer>
  <?php } ?>

</div><!-- #page -->
<!--====== GO TO TOP START ======-->
<?php if (doccure_get_option('back_to_top')) {
    $custom_icon = doccure_get_option('back_to_top_icon', 'fas fa-arrow-up');
    $position = doccure_get_option('back_to_top_position', 'bottom-right');
    $style = doccure_get_option('back_to_top_style', 'square');
    ?>
    <div class="<?php echo esc_attr($style) ?> doccure_to-top <?php echo esc_attr($position) ?>">
        <i class="<?php echo esc_attr($custom_icon) ?>"></i>
    </div>
<?php } ?>
<!--====== GO TO TOP ENDS ======-->
<?php
// Before footer hook
do_action('doccure_after_footer');
wp_footer(); ?>
</body>
</html>
