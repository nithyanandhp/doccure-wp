<?php
/**
 * page payouts listing
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Elevator
 * @subpackage doccure/includes
 * @author     Dreams Technologies<support@dreamstechnologies.com>
 */
require doccureGlobalSettings::get_plugin_path() . 'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

if( !class_exists('Payouts_List') ){
	class Payouts_List extends WP_List_Table {

		public function __construct() {

			parent::__construct( [
				'singular' => esc_html__( 'Payout', 'doccure_core' ), 
				'plural'   => esc_html__( 'Payouts', 'doccure_core' ),
				'ajax'     => false 
			] );

		}

		/**
		 * Retrieve payouts data from the database
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public static function get_payouts( $per_page = 5, $page_number = 1 ) {

			global $wpdb;

			$sql = "SELECT * FROM {$wpdb->prefix}dc_payouts_history";

			if ( ! empty( $_REQUEST['orderby'] ) ) {
				$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
				$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' DESC';
			}
			
			if ( empty( $_REQUEST['orderby'] ) ) {
				$sql .= ' ORDER BY id DESC';
			}
			if( ! empty( $_REQUEST['s'] ) ){
				$search = esc_sql( $_REQUEST['s'] );
				$sql .= " WHERE card LIKE '%{$search}%'";
			}
			$sql .= " LIMIT $per_page";
			$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


			$result = $wpdb->get_results( $sql, 'ARRAY_A' );

			return $result;
		}

		/**
		 * Delete Payout
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public static function delete_payouts( $id ) {
		  global $wpdb;
		  $wpdb->delete(
			"{$wpdb->prefix}dc_payouts_history",
			[ 'id' => $id ],
			[ '%d' ]
		  );
		}

		/**
		 * Change Payout Status
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public static function change_staus_payouts( $id ,$status) {
		  global $wpdb;
			if( !empty( $id ) && !empty( $status ) ) {
				$data		= array('status'	=> $status );
				$where		= array('id'		=> $id );
				$updated 	= $wpdb->update( "{$wpdb->prefix}dc_payouts_history", $data, $where );
			}
		}

		/**
		 * Returns the count of records in the database.
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public static function record_count() {
			global $wpdb;

			$sql = "SELECT COUNT(*) FROM {$wpdb->prefix}dc_payouts_history";

			return $wpdb->get_var( $sql );
		}

		/**
		 * Text displayed when no Payouts data is available
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function no_items() {
			esc_html_e( 'No Payouts avaliable.', 'doccure_core' );
		}

		/**
		 * Render a column when no column specific method exist.
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function column_default( $item, $column_name ) {
			$date_formate	= get_option('date_format');		
			$payrols 	= '';

			if( function_exists('doccure_get_payouts_lists') ){
				$payrols	= doccure_get_payouts_lists();
			}

			switch ( $column_name ) {
				case 'user_id':
					$user_name	= doccure_get_username($item[ $column_name ]);
					// create a nonce
					$delete_nonce = wp_create_nonce( 'sp_delete_payout' );
					$title = esc_html__( 'Delete', 'doccure_core' );


					$actions = [
						'delete' => sprintf( '<a href="?post_type=doctors&page=%s&action=%s&payout=%s&_wpnonce=%s">'.$title.'</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce )
					];

					return $user_name . $this->row_actions( $actions );
				case 'amount':
					return doccure_price_format($item[ $column_name ]);
				case 'payment_method':
					$payrols = !empty( $payrols[$item[ $column_name ]]['title'] ) ? $payrols[$item[ $column_name ]]['title'] : '';
					return $payrols;
				case 'processed_date':
					return date($date_formate,strtotime($item[ $column_name ]));
				case 'status':
					$status_nonce = wp_create_nonce( 'sp_delete_payout' );
					$status	= !empty( $item[ $column_name ]) ? ($item[ $column_name ] === 'completed') ? 'inprogress' : 'completed' : '';
					$actions = [
						'change_status' => sprintf( '<a href="?post_type=doctors&page=%s&action=%s&payout=%s&status=%s&_wpnonce=%s">'.ucwords($status).'</a>', esc_attr( $_REQUEST['page'] ), 'change_status', absint( $item['id'] ),$status, $status_nonce )
					];
					return ucwords($item[ $column_name ]).$this->row_actions( $actions );
			}
		}

		/**
		 * Associative array of columns
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		function get_columns() {
			$columns = array(
				'user_id' 			=> esc_html__( 'User Name', 'doccure_core' ),
				'amount'    		=> esc_html__( 'Amount', 'doccure_core' ),
				'payment_method'    => esc_html__( 'Payment Method', 'doccure_core' ),
				'processed_date'    => esc_html__( 'Processing Date', 'doccure_core' ),
				'status'   			=> esc_html__( 'Status', 'doccure_core' ),
			);

			return $columns;
		}

		/**
		 * Sortable
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function get_sortable_columns() {
			$sortable_columns = array(
				'user_id' 			=> array( 'user_id', true ),
				'processed_date' 	=> array( 'processed_date', false ),
				'amount' 			=> array( 'amount', false )
			);

			return $sortable_columns;
		}

		/**
		 * Download PDF
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function download_pdf($start_date='',$end_date='') {
			global $wpdb;

			ob_clean();
			ob_flush();
			$sql = "SELECT * FROM {$wpdb->prefix}dc_payouts_history";
			if( !empty( $start_date ) || !empty( $end_date ) ) {
				$date	= date('Y-m-d');
				if(!empty($start_date) && !empty($end_date)){
					$sql   .= " WHERE DATE(processed_date) BETWEEN '".$start_date."' AND '".$end_date."'";
					$date	= $start_date;
				} else if(!empty($start_date) ){
					$sql .= " WHERE	DATE(processed_date) BETWEEN '".$start_date."' AND '".$start_date."'";
					$date	= $start_date;
				} else if(!empty($end_date) ){
					$sql .= " WHERE DATE(processed_date) BETWEEN '".$end_date."' AND '".$end_date."'";
					$date	= $end_date;
				}

				$results 	= $wpdb->get_results( $sql, 'ARRAY_A' );
				$pdf_html = '';
				$dompdf = new Dompdf();
				$pdf_html .= $this->renderheader($date);
				$pdf_html .= $this->renderPdfHtml($results);
				$pdf_html .= $this->renderFooter();
				$dompdf->set_option('isHtml5ParserEnabled', true);
				$dompdf->loadHtml($pdf_html);
				$dompdf->setPaper('A4', 'portrait');
				$dompdf->render();
				$dompdf->stream($date."-payouts".".pdf");
			}

		}
		
		/**
		 * Render header
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function renderheader($date){
			$border_image = get_template_directory() . '/images/border.jpg';
			$html = '<html>
			<head>
				<style>
					@page {
						margin: 10px 0px 50px 0px;
					}
		
					header {
						position: fixed;
						top: -20px;
						left: 0px;
						right: 0px;
						height: 50px;
						font-family: sans-serif;
						background: url('.$border_image.');
						background-size:1px;
						background-size: 100% 2px;
						background-repeat: no-repeat;
					}
		
					footer {
						position: fixed; 
						bottom: -60px; 
						left: 0px; 
						right: 0px;
						height: 50px; 
					}
					table { border-collapse: collapse; }
				</style>
			</head>
			<body style="font-family: sans-serif;">
				<header>
				<div style="width:100%; display: inline-block; text-align:center; font-family: sans-serif;">
					<table style="width:96%; margin:80px auto 0;">
						<tr style="text-align:left;">
							<td width="70%">
								<h1 style="font-size: 26px;line-height: 26px;margin: 0 0 10px; font-weight: 500; color: #3d4461;">'.esc_html__('Payout','doccure_core').'</h1>
								<span style="font-size:16px;line-height: 20px;display: block; color: #3d4461;">'.esc_html__('Payout history starting from','doccure_core').' '.date('Y-m-d', strtotime($date) ).'</span>
								
							</td>
						</tr>
					</table>
				</div>
				</header>
		
				<footer style="border-top: 1px solid #eee; text-align: center;margin-top: 80px;padding: 20px 0;">
					<span style="display: block;font-size: 16px;color: #3d4461;line-height: 20px;">
						'.esc_html__('This is a computer generated payout slip','doccure_core').'
					</span>
				</footer>';
			return $html;
		}
		
		/**
		 * Render Footer
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function renderFooter(){
			$html = '</body></html>';
			return $html;
		}
		
		/**
		 * Render table
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function renderPdfHtml($results){
			$payrols_list_items	= doccure_get_payouts_lists();
			$html = '';
			$html .= '<main>
			<table style="width: 95%; margin: 150px auto 0;font-family: sans-serif;">';
				$html .= '<thead>
					<tr style="text-align: left; border-radius:5px 0 0;">
						<th style="width:5%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">'.esc_html__('ID','doccure_core').'</th>
						<th style="width:15%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">'.esc_html__('Name','doccure_core').'</th>
						<th style="width:10%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">'.esc_html__('Amount','doccure_core').'</th>
						<th style="width:10%; padding: 15px 20px;background: #f5f5f5; font-size:14px;word-wrap:break-word;">'.esc_html__('Method','doccure_core').'</th>
						<th style="width:30%; padding: 15px 20px;background: #f5f5f5; font-size:14px;word-wrap:break-word;">'.esc_html__('Details','doccure_core').'</th>
						<th style="width:15%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">'.esc_html__('Status','doccure_core').'</th>
					</tr>
				</thead>
				<tbody>';
			$counter	= 0;
			if( !empty( $results ) ){
				foreach($results as $result ) { 
					$counter++;
					$user_name 		 = '';
					$paymentdetails	 = '';
					
					if( function_exists('doccure_get_username') ){
						$user_name	= doccure_get_username($result['user_id']);
					}
					
					$amounts = '0.0';
					if( function_exists('doccure_price_format') ){
						$amounts	= doccure_price_format($result['amount'],'return');
					}

					$payrol_title 	= !empty( $payrols_list_items[$result['payment_method']]['title'] ) ? $payrols_list_items[$result['payment_method']]['title'] : '';

					if( !empty( $result['payment_method'] ) && $result['payment_method'] === 'paypal' ){
						$paymentdetails	.= $result['paypal_email'];
					} elseif( !empty( $result['payment_method'] ) && $result['payment_method'] === 'bacs' ){
						$payrols_list	= !empty( $payrols_list_items['bacs']['fields'] ) ? $payrols_list_items['bacs']['fields'] : array();
						$bank_detail	= !empty( $result['payment_details'] ) ? maybe_unserialize($result['payment_details']) : array();

						if( !empty( $payrols_list ) ){
							foreach( $payrols_list as $key => $pay ){
								if( !empty( $bank_detail[$key] ) ){
									$paymentdetails	.= '<span style="display: block;">'.$pay['placeholder'].': <em style="font-style: normal;">'.$bank_detail[$key].'</em></span>';
								}
							}
						}	
					}else{
						$payrols_list	= !empty( $payrols_list_items[$result['payment_method']]['fields'] ) ? $payrols_list_items[$result['payment_method']]['fields'] : array();
						$bank_detail	= !empty( $result['payment_details'] ) ? maybe_unserialize($result['payment_details']) : array();
						if( !empty( $payrols_list ) ){
							foreach( $payrols_list as $key => $pay ){
								
								if( !empty( $bank_detail[$key] ) ){
									$title	= !empty($pay['title']) ? $pay['title'] : $pay['placeholder'];
									$paymentdetails	.= '<span style="display: block;">'.$title.': <em style="font-style: normal;">'.$bank_detail[$key].'</em></span>';
								}
							}
						}	
					}

					$html .= '<tr>
								<td style="padding: 15px 20px; border-top: 1px solid #e2e2e2; font-size:14px;">'.$counter.'</td>
								<td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">'.$user_name.'</td>
								<td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">'.$amounts.'</td>
								<td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">'.$payrol_title.'</td>
								<td style="padding: 15px 20px;border-top: 1px solid #e2e2e2;word-wrap:break-word; font-size:14px;">'.$paymentdetails.'</td>
								<td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">'.$result['status'].'</td>
							 </tr>';
				}
			}
			
			$html .= '</tbody></table></main>';


			return $html;
		}

		/**
		 * Handles data query and filter, sorting, and pagination.
		 *
		 * @throws error
		 * @author Dreams Technologies<support@dreamstechnologies.com>
		 * @return 
		 */
		public function prepare_items() {

			$this->_column_headers = $this->get_column_info();

			$per_page     = $this->get_items_per_page( 'payout_per_page', 20 );
			$current_page = $this->get_pagenum();
			$total_items  = self::record_count();
			$start_date	= !empty($_POST['start_date']) ? $_POST['start_date'] : '';
			$end_date	= !empty($_POST['end_date']) ? $_POST['end_date'] : '';

			if( !empty($start_date) || !empty($end_date)) {
				$this->download_pdf($start_date,$end_date);	
			}

			if( !empty( $_GET['action'] ) && !empty( $_GET['payout'] ) && $_GET['action'] === 'delete' ){
				//delete action
				self::delete_payouts($_GET['payout']);
			}

			if( !empty( $_GET['action'] ) && !empty( $_GET['payout'] ) && $_GET['action'] === 'change_status' ){
				//change status action
				self::change_staus_payouts($_GET['payout'],$_GET['status']);
			}

			$this->set_pagination_args( [
				'total_items' => $total_items, 
				'per_page'    => $per_page 
			] );

			$this->items = self::get_payouts( $per_page, $current_page );
		}
	}
}