<?php 
	include_once '../admin/model/db.php';
	include_once '../admin/controller/common_functions.php';

	function get_count_data($id, $mobile_number){
		$conn = db_connect();
		$condition = "`id` = ".$id;
		$selected_values = select('`sms_count`', '`users`', $condition, $conn);
		$message_content = "Your SMS credits are running out! credits are ".$selected_values[0]['sms_count']. " contact Vefetch sales team. - 8148333824";
		if ($selected_values[0]['sms_count']>500) {
			return count_color("green",$selected_values[0]['sms_count']);
		}
		elseif ($selected_values[0]['sms_count']<100) {
			send_message("VFETCH", $mobile_number, $message_content, NULL);
		 	return count_color("red",$selected_values[0]['sms_count']);
		 	
		}
		elseif ($selected_values[0]['sms_count']>=100) {
		 	return count_color("orange",$selected_values[0]['sms_count']);
		}
	}

	function count_color($color,$value){
		return "<button-".$color." > count : ".$value."</button>";
	}