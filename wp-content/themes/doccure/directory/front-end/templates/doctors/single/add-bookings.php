<?php
/**
 *
 * The template used for add doctors bookings
 *
 * @package   doccure
 * @author    Dreams Technologies
 * @link      https://themeforest.net/user/dreamstechnologies/portfolio
 * @version 1.0
 * @since 1.0
 */

global $post,$current_user,$doccure_options;
$user_id		= $current_user->ID;
$relationship	= doccure_patient_relationship();
$doctor_location	= !empty($doccure_options['doctor_location']) ? $doccure_options['doctor_location'] : '';
$post_id		= doccure_get_linked_profile_id($user_id);
$location_id	= get_post_meta($post_id, '_doctor_location', true);
$location_id	= !empty($location_id) ? $location_id : 0;
$timezone_string	= get_option('timezone_string');
?>
<div class="modal fade dc-appointmentpopup dc-feedbackpopup dc-bookappointment" role="dialog" id="appointment"> 
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="dc-modalcontent modal-content">	
			<div class="dc-popuptitle">
				<h3><?php esc_html_e('Book Appointment','doccure');?></h3>
				<a href="javascript:;" class="dc-closebtn close dc-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close','doccure');?>"><i class="fas fa-times"></i></a>
			</div>
			<div id="dcModalBody" class="modal-body dc-modal-content-one dc-haslayout">
				<div id="dcModalBody1" class="dc-visitingdoctor">
					<form class="dc-booking-doctor dc-formfeedback">
						<div class="dc-title">
							<span><?php esc_html_e('Add patient details','doccure');?></span>
						</div>
						<div class="dc-formtheme dc-vistingdocinfo">
							<p><?php echo esc_html_e('Please add correct email address to find patient from the database, if not found then you can add new patient into database by typing email address and name','doccure');?></p>
							<fieldset>
								<div class="form-group form-group-half">
									<input type="text" name="email" id="dc-booking-email" class="form-control" placeholder="<?php esc_attr_e('Email','doccure');?>">
								</div>
								<div class="form-group form-group-half">
									<input type="text" name="first_name" class="form-control" placeholder="<?php esc_attr_e('First Name','doccure');?>">
								</div>
								<div class="form-group form-group-half">
									<input type="hidden" name="user_id" class="form-control">
									<input type="text" name="last_name" class="form-control" placeholder="<?php esc_attr_e('Last Name','doccure');?>">
								</div>
								<div class="form-group">
									<input type="text" name="phone" id="dc-booking-phone" class="form-control" placeholder="<?php esc_attr_e('Phone','doccure');?>">
								</div>
								<div class="form-group dc-add-new-patient">
									<span class="dc-checkbox dc-creat-user">
										<input type="checkbox" name="create_user" class="dc-user" id="dc-user" value="yes" checked>
										<label for="dc-user"><?php esc_html_e('Create new user','doccure');?></label>
									</span>
								</div>
							</fieldset>
						</div>
						<div class="dc-title dc-visitingtitle">
							<span><?php esc_html_e('Who is Visiting To Doctor?','doccure');?></span>
							<div class="dc-tabbtns">
								<span class="dc-radio next-step">
									<input type="radio" name="myself" class="myself" value="myself" id="myself" checked>
									<label for="myself"><?php esc_html_e('Patient only','doccure');?></label>
								</span>
								<span class="dc-radio next-step">
									<input type="radio" name="myself" class="myself" value="someelse" id="someelse">
									<label for="someelse"><?php esc_html_e('Someone Else','doccure');?></label>
								</span>
							</div>
						</div>

						<div class="dc-formtheme dc-docinfoform form-group-relation">
							<fieldset>
								<div class="form-group form-group-half">
									<input type="text" name="other_name" class="form-control" placeholder="<?php esc_attr_e('Name','doccure');?>">
								</div>
								<div class="form-group form-group-half">
									<span class="dc-select">
										<select data-placeholder="<?php esc_attr_e('Relation with you? *','doccure');?>" name="relation">
											<option value=""><?php esc_html_e('Relation with you?','doccure');?></option>
											<?php foreach( $relationship as $key => $val ){?>
												<option value="<?php echo esc_attr( $key );?>"><?php echo esc_html( $val );?></option>
											<?php } ?>
										</select>
									</span>
								</div>
							</fieldset>
						</div>
						<div class="dc-formtheme dc-vistingdocinfo">
							<fieldset>
								<div class="form-group">
									<span class="dc-select">
										<select name="booking_hospitals" data-doctor_id="<?php echo intval( $post_id );?>" class="dc-booking-hospitals">
											<?php 
												if(!empty($doctor_location) && $doctor_location === 'both'){
													echo '<option value="">'.esc_html__('Where to visit?*','doccure').'</option>';
													echo '<option value="'.$location_id.'">'.get_the_title($location_id).'</option>';
													doccure_get_list_hospital('hospitals_team',$user_id);
												}else if(!empty($doctor_location) && $doctor_location === 'clinic'){
													echo '<option value="">'.esc_html__('Where to visit?*','doccure').'</option>';
													echo '<option value="'.$location_id.'">'.get_the_title($location_id).'</option>';
												}else if(!empty($doctor_location) && $doctor_location === 'hospitals'){
													echo '<option value="">'.esc_html__('Where to visit?*','doccure').'</option>';
													doccure_get_list_hospital('hospitals_team',$user_id);
												}
											?>
										</select>
									</span>
								</div>
								<div class="form-group" id="booking_service_select"></div>
								<div class="form-group" id="booking_fee"></div>
								<div class="form-group">
									<textarea class="form-control" placeholder="<?php esc_attr_e('Comments:','doccure');?>" name="booking_content"></textarea>
								</div>
							</fieldset>
						</div>
						<div class="dc-appointment-holder">
							<div class="dc-title">
								<h4><?php esc_html_e('Select best time for appointment with time zone','doccure');?></h4>
								<em><?php esc_html_e('*These time slots are based on the timezone','doccure');?>&nbsp;<?php echo esc_html($timezone_string);?></em>
							</div>
							<div class="dc-appointment-content">
								<div class="dc-appointment-calendar">
									<div id="dc-calendar" class="dc-calendar"></div>
								</div>
								<div class="dc-timeslots dc-update-timeslots"><?php do_action('doccure_empty_records_html','dc-empty-articls dc-emptyholder-sm',esc_html__( 'There are no any slot available.', 'doccure' ));?></div>
								<input type="hidden" value="<?php echo date('Y-m-d');?>" name="appointment_date" id="appointment_date">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer dc-modal-footer">
				<a href="javascript:;" id="dcbtn" class="btn dc-btn btn-primary dc-booking-doctor-btn" data-id="<?php echo intval($user_id);?>" data-toggle="modal" data-target="#appointment2"><?php esc_html_e('Continue','doccure');?></a>
			</div>			
		</div>
	</div>
</div> 