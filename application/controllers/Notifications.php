<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function sendFCM()
	{
	    $API_ACCESS_KEY = "AAAAQdKriDo:APA91bGtSE9UogoA2Y3q5U_OrEbRHf1Rrxo8Ih-cgOa-oSAgxFgHK-T83722-6AJLMpAfvPBWPZtY9lnzVPQplz3zLmIW9iWHzLLCMZZPPT6XAIOA7lm3XSA7Ow_WZFdt5u3XIYkbMMt";

	    $url = 'https://fcm.googleapis.com/fcm/send';

	    $fields = array (
	            'to' => 'ffe2IlWq0lw:APA91bHWE1ThRtYty-pKXL3KKnhy3jxYodVChu7WdShYRKoN0aOXgk4Dv12_gWekGDK_iIBddXejnHUSwfcyd3JwZ7poUVXinl-CGDuwgFZaC5dCgG7fK399-XE4qOvmDG6YQffA_RCF',
	            "data" => array (
			        "title" => "my title",
			        "message"=> "my message",
			        "image"=> "http://www.androiddeft.com/wp-content/uploads/2017/11/Shared-Preferences-in-Android.png",
			        "action"=> "url",
			        "action_destination"=> "http://androiddeft.com"
			    ),                
	            'priority' => 'high',
	            'notification' => array(
	                        'title' => 'AYY LMAO',
	                        'body' => 'AYY LMAO body',                            
	            ),
	    );
	    $fields = json_encode ( $fields );

	    $headers = array (
	            'Authorization: key=' . $API_ACCESS_KEY,
	            'Content-Type: application/json'
	    );
	    $ch = curl_init ();
	    curl_setopt ( $ch, CURLOPT_URL, $url );
	    curl_setopt ( $ch, CURLOPT_POST, true );
	    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}

}

