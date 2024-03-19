<?php
/**
 * Template part for header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package doccure
 */
$header_type = doccure_get_option('header_type', 'static');
$header_layout = doccure_get_option('header-layout', 'layout-1');

if ($header_type == 'static') {
		// Mobile Header
		get_template_part( 'template-parts/header/elements/mobile-sidebar' );
		// Collapse sidebar
		if( doccure_get_option('display-collapse-sidebar') && is_active_sidebar('header-collapse-sidebar') ){
			get_template_part( 'template-parts/header/elements/collapse-sidebar' );
		}
	?>
	<?php 
		if(is_page_template('homepagethree.php')) { ?>
			<header class="doccure_header <?php echo esc_attr( doccure_header_classes() ); ?>">
			<?php get_template_part( 'template-parts/header/layouts/layout-11' ); ?>
			</header>
		<?php }
		elseif(is_page_template('homepagefour.php')) { ?>
			<header class="doccure_header <?php echo esc_attr( doccure_header_classes() ); ?>">
			<?php get_template_part( 'template-parts/header/layouts/layout-12' ); ?>
			</header>
		<?php }
		elseif(is_page_template('homepagetwo.php')) { ?>
			<header class="doccure_header <?php echo esc_attr( doccure_header_classes() ); ?>">
			<?php get_template_part( 'template-parts/header/layouts/layout-12' ); ?>
			</header>
		<?php }
      elseif(is_page_template('homeelementortwo.php')) { ?>
	<header class="doccure_header <?php echo esc_attr( doccure_header_classes() ); ?>">
	<?php  get_template_part( 'template-parts/header/layouts/layout-12' ); ?>
	</header>
<?php } else{ ?>
			<!-- Site Header -->
			<header class="doccure_header <?php echo esc_attr( doccure_header_classes() ); ?>">
				<?php get_template_part( 'template-parts/header/layouts/' . $header_layout ); ?>
			</header>
		<?php }
		?>
		
		
		<!-- Sticky Header -->
		<?php if( doccure_get_option('sticky-header-enable') ){ ?>
		<header class="doccure_header can-sticky <?php echo esc_attr( doccure_header_sticky_classes() ); ?>">
			<?php get_template_part( 'template-parts/header/layouts/' . $header_layout ); ?>
		</header>
	<?php } ?>
<?php
// Mobile Header
get_template_part( 'template-parts/header/elements/search' );
} else {
	$header_template = doccure_get_option('header_type_page_template');
	if (empty($header_template)) {
			return;
	}
	$post = get_post($header_template);
	?>
	<header class="doccure_header doccure-template doccure_header-template doccure-template-<?php echo esc_attr($header_template) ?>">
			<div class="container">
					<div class="entry-content clearfix">
							<?php echo do_shortcode($post->post_content); ?>
					</div>
			</div>
	</header>
	<?php
}
