	<?php
/**
 *
 * The template used for displaying doctors services
 *
 * @package   doccure
 * @author    Dreams Technologies
 * @link      https://themeforest.net/user/dreamstechnologies/portfolio
 * @version 1.0
 * @since 1.0
 */
 
 global $post,$doccure_options;
$post_id 			= $post->ID;
$am_specialities	= doccure_get_post_meta( $post_id,'am_specialities');
if( !empty( $am_specialities ) ) {
    //  show services according to doctor package 
    $hide_service_accord_package	= !empty( $doccure_options['hide_services_by_package'] ) ? $doccure_options['hide_services_by_package'] : 'yes';
    $author_id                      = get_post_field ('post_author', $post_id);
    $no_service_in_package          = doccure_get_subscription_metadata('dc_services',$author_id);
    ?>
<div class="dc-services-holder dc-aboutinfo">
	<div class="dc-infotitle">
		<h3><?php esc_html_e('Offered Services','doccure');?></h3>
	</div>
	<div id="dc-accordion" class="dc-accordion" role="tablist" aria-multiselectable="true">
		<?php
			foreach ( $am_specialities as $key => $specialities) {
				$specialities_title	= doccure_get_term_name($key ,'specialities');
				$logo 				= get_term_meta( $key, 'logo', true );
				$logo				= !empty( $logo['url'] ) ? $logo['url'] : '';
				$services			= !empty( $specialities ) ? $specialities : '';
				$service_count		= !empty($services) ? count($services) : 0;
			?>
			 
			<div class="dc-panel">
				<?php if( !empty( $specialities_title ) ){?>
					<div class="dc-common">
					<div class="dc-paneltitle">
						<?php if( !empty( $logo ) ){?>
							<figure class="dc-titleicon">
								<img src="<?php echo esc_url( $logo );?>" alt="<?php echo esc_attr( $specialities_title );?>">
							</figure>
						<?php } ?>
						<span>
							<?php echo esc_html( $specialities_title );?>
							 <?php if( !empty( $service_count ) ){
                                if($hide_service_accord_package === 'yes' && ($service_count > $no_service_in_package) ) {?>
                                    <em><?php echo intval($no_service_in_package);?>&nbsp;<?php esc_html_e( 'Service(s)','doccure');?></em>
                                <?php } else {?>
								    <em><?php echo intval($service_count);?>&nbsp;<?php esc_html_e( 'Service','doccure');?></em>
							 <?php } } ?>
						 </span>
					</div>
					</div>
				<?php } ?>
				
				<?php if( !empty( $services ) ){ ?>
					<div class="dc-panelcontent">
						<div class="dc-childaccordion" role="tablist" aria-multiselectable="true">
							<?php
                                $count = 0;
								foreach ( $services as $key => $service ) {
                                    if($hide_service_accord_package === 'yes') {
                                        $count = $count + 1;
                                        if ($count > $no_service_in_package) {
                                            break;
                                        }
                                    }
									$service_title	= doccure_get_term_name($key ,'services');
									$service_title	= !empty( $service_title ) ? $service_title : '';
									$service_price	= !empty( $service['price'] ) ? $service['price'] : '';
									$description	= !empty( $service['description'] ) ? $service['description'] : '';
								?>
								<div class="dc-subpanel">
									<?php if( !empty( $service_title ) ) { ?>
										<div class="dc-subpaneltitle">
											<span>
												<?php echo esc_html( $service_title );?>
												<?php if( !empty( $service_price ) ) {?><em><?php doccure_price_format($service_price); ?></em><?php } ?>
											</span>
										</div>
									<?php } ?>
									<?php if( !empty( $description ) ){?>
										<div class="dc-subpanelcontent">
											<div class="dc-description">
												<p><?php echo nl2br( $description );?></p>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			 
			</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
