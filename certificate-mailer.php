<?php 
require_once('../../../wp-load.php');
use Dompdf\Dompdf;
global $wpdb;
	//$test_mail = 'jatinsehgalvision@gmail.com';
	//$test_mail = 'yogi45vision@gmail.com';
	//$test_mail = 'lalitvisionvivante@gmail.com';
    $args = array('status' => array('wc-completed'), ); 
    $allorders = array('status'=> 'wc-completed', 'type'=> 'shop_order','limit' => -1, );
	$orders = wc_get_orders( $allorders ); 
	$only_attendeedata = $wpdb->get_results( "SELECT pm1.post_id,pm1.meta_value as product_name,pm2.meta_value as status FROM wp_posts as p JOIN wp_postmeta as pm1 ON p.ID = pm1.post_id
	JOIN wp_postmeta as pm2 ON p.ID = pm2.post_id WHERE p.post_type = 'event_magic_tickets' 
	AND pm1.meta_key = 'WooCommerceEventsProductName' AND pm1.meta_value = 'IRED Meet&Learn 2021' 
	AND pm2.meta_key = 'WooCommerceEventsStatus' AND pm2.meta_value = 'Checked In' ");
		if($only_attendeedata){
			foreach($only_attendeedata as $attendeedata){
				$attendee_posi_id = $attendeedata->post_id;
				$attendee_name = get_post_meta( $attendee_posi_id, 'WooCommerceEventsAttendeeName', true );
				$attendee_lastname = get_post_meta( $attendee_posi_id, 'WooCommerceEventsAttendeeLastName', true );
				$attendee_email = get_post_meta( $attendee_posi_id, 'WooCommerceEventsAttendeeEmail', true );
				//$attendeeLName =$attendeedata[$key]['WooCommerceEventsAttendeeLastName'];
				//$attendeeEmail =$attendeedata[$key]['WooCommerceEventsAttendeeEmail'];
				//echo 'Name'.$attendee_name.' '.$attendee_lastname.' Email'.$attendee_email.'<br>';

				$dompdf = new Dompdf();
				$ticket_output = '<html>
				<head>
				<title>IRED CERTIFICATO</title>
				<meta charset="utf-8">
				</head>
				<body style="margin-top:10%;>
				<div style="font-family: "Roboto", sans-serif; margin-top:10%;">
				
				<div style="position: relative;">
				<img src="https://server.visionvivante.com/IRED-certificate/images/path2.png" style="position: absolute; right: 11%; top: -65px;">
				</div>
				<div style="width:30%; margin-left: 15%;">
							<img src="https://server.visionvivante.com:8080/goran-new/wp-content/uploads/2021/08/IRED-lugano.svg" style="width:100%;"/>
				</div>
				<div style="margin-left: 20%;">
				<div style="position: relative;">
					<img src="https://server.visionvivante.com/IRED-certificate/images/path1.png" style="position: absolute; left: 0px; left: -33%; top: -141px;">
				</div>
				<div style="margin-top: 80px;">
				<h2 style="color: #62a7bb; font-size: 37px; line-height: 55px; margin-top: 15%;">CERTIFICATO DI PARTECIPAZIONE<br><span style="text-transform: uppercase;">
					Teilnahmebestätigung</span>
					</h2>
				</div>
				<div style="position: relative;">
				<img src="https://server.visionvivante.com/IRED-certificate/images/path2.png" style="position: absolute; right: 11%; top: -30px;">
				</div>
				<div style="margin-top: 50px; color: #62a7bb; ">
					<h3 style="font-size: 24px; font-weight: 500;">IRED MEET & LEARN</h3>
					<p style="font-size: 23px; letter-spacing: 1px; line-height: 25px;">30 anni di riabilitazione protesica –<br>cosa rifarei e cosa no?</p>
					<p style="font-size: 23px; letter-spacing: 1px; line-height: 25px;" >30 Jahre prothetische Rehabilitation –<br> was würde ich wieder tun und was nicht?"</p>
				</div>
				<div style="margin-top: 40px;">
				<p style="font-size: 25pt; letter-spacing: 1px; line-height: 30pt; font-weight: 300;">'.$attendee_name.' '. $attendee_lastname.'</p>
				</div>
				<div style="position: relative;">
				<img src="https://server.visionvivante.com/IRED-certificate/images/path1.png" style="position: absolute; left: -33%; top: -115px;">
				</div>
				<p style="color: #62a7bb; letter-spacing: 1px; line-height: 1.5; font-size: 16px; margin-bottom: 0px;">Crediti di formazione continua<br>Fortbildungskredit</p>
				<p style="margin-top: 0px; font-size: 20px;">5</p>
				<div style="width:100%;">
				<div style="width:32%;float:left;">
					<p style="color: #62a7bb; font-size: 18px;">Prof. Christoph Hämmerle</p>
					<img src="https://server.visionvivante.com/IRED-certificate/images/bitmap3.png" style="width: 60%;">
				</div>
				<div style="width:32%;float:left;margin-left:20px;">
					<p style="color: #62a7bb; font-size: 18px;">Prof. Giovanni Salvi</p>
					<img src="https://server.visionvivante.com/IRED-certificate/images/bitmap1.png" style="width:60%">
				</div>
				<div style="width:32%;float:left;margin-left:20px;">
					<p style="color: #62a7bb; font-size: 18px;">Prof. Irena Sailer</p>
					<img src="https://server.visionvivante.com/IRED-certificate/images/bitmap2.png" style="width: 60%;">
				</div>
				<div style="width:100%; margin-top:100px;">
					<p style="color: #62a7bb; font-size: 16px;"></p>
				</div>
				</div>
				<div style="position: relative;">
				<img src="https://server.visionvivante.com/IRED-certificate/images/path2.png" style="position: absolute; right: 11%; top: -150px;">
				</div>
				</div>
				</div>
				<p style="color: #62a7bb; margin-top: 200px; font-size: 18px; margin-left:20%;">Lugano · 9.10.2021</p>
				</body>
				</html>';
				$dompdf->loadHtml($ticket_output);
				$dompdf->setBasePath(ABSPATH);
				$dompdf->set_option('enable_remote', TRUE);
				$dompdf->setPaper('A3');
				$dompdf->render();
				//$dompdf->stream();
				$output = $dompdf->output();
				$rand_num =	rand(10,1000);
				file_put_contents(ABSPATH . "wp-content/uploads/certificates/certificate".$rand_num.".pdf", $output);
				$attachments = (ABSPATH . "wp-content/uploads/certificates/certificate".$rand_num.".pdf");
				$attachments = array( $attachments );
				$headers = "From:meetandlerarn@gmail.com";  
				$email_subject = "Certificate Email from Meet & Learn.";
				$email_body = "Hello ".$attendee_name."";
				//print_r( $attachments);
				$mail_response = wp_mail($attendee_email,$email_subject,$email_body,$headers,$attachments);
				//  if($mail_response){
				//  	echo 'Done'.$mail_response;
				// 	 $count++;
				//  	//die('done');
				// }
			}
		}
			//echo $count;
			//echo '<pre>';print_r($only_attendeedata);
			//die('only attendee data');
	// if($orders){
	// 	foreach($orders as $order){
	// 	$order_id = $order->id;
	// 	$order_data = new WC_Order( $order_id );
	// 	if($order_data){
	// 		$attendee_data = get_post_meta( $order_id, 'WooCommerceEventsOrderTickets', true );
	// 			//SELECT pm1.post_id,pm1.meta_value as product_name,pm2.meta_value as status FROM wp_posts as p JOIN wp_postmeta as pm1 ON p.ID = pm1.post_id JOIN wp_postmeta as pm2 ON p.ID = pm2.post_id WHERE p.post_type = 'event_magic_tickets' AND pm1.meta_key = 'WooCommerceEventsProductName' AND pm1.meta_value = 'IRED Meet&Learn 2021' AND pm2.meta_key = 'WooCommerceEventsStatus' AND pm2.meta_value = 'Checked In'
	// 			foreach($attendee_data as $key => $attendeedata){
	// 				$attendeeFName =$attendeedata[$key]['WooCommerceEventsAttendeeName'];
	// 				$attendeeLName =$attendeedata[$key]['WooCommerceEventsAttendeeLastName'];
	// 				$attendeeEmail =$attendeedata[$key]['WooCommerceEventsAttendeeEmail'];
	// 				$EventOrderId =$attendeedata[$key]['WooCommerceEventsOrderID'];
	// 				$post_id = $wpdb->get_results( "SELECT post_id FROM wp_postmeta WHERE meta_key = 'WooCommerceEventsOrderID' AND meta_value = '$EventOrderId' ");
	// 				foreach ($post_id as $pid) {
	// 					$attendee_posi_id = $pid->post_id;
	// 				   }
	// 				$Entry_status = $wpdb->get_results( "SELECT meta_value FROM wp_postmeta WHERE meta_key = 'WooCommerceEventsStatus' AND post_id = '$attendee_posi_id' ");
	// 				   foreach ($Entry_status as $estatus) {
	// 					   $attendee_entry_status = $estatus->meta_value;
	// 				}//!is_admin() &&
	// 				if($attendee_entry_status == 'Checked In'){
	// 				// echo '<pre>'.'Attendee Status: ';echo $attendee_entry_status;
	// 			    // echo '<pre>'.'Post ID: ';echo $attendee_posi_id;
	// 				// echo '<pre>';print_r($attendeedata[$key]['WooCommerceEventsAttendeeName']);
	// 				// echo '<pre>';print_r($attendeedata[$key]['WooCommerceEventsAttendeeLastName']);
	// 				// echo '<pre>';print_r($attendeedata[$key]['WooCommerceEventsAttendeeEmail']);
	// 				// echo '<pre>'.'Event Order ID: ';print_r($attendeedata[$key]['WooCommerceEventsOrderID']);
	// 				// echo '<pre>';print_r($attendeedata[$key]['WooCommerceEventsStatus']);
	// 				// echo '<pre>'.'--------------------------------------------------';
						
	// 				}
	// 			}
	// 		}
	// 	}//if(!is_admin()){
	// 	// 	die('testing orders');
	// 	//  }
	// }
	