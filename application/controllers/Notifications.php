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
	            'to' => 'ct7QM-T1oxI:APA91bHJYoBYGJ_DaBBJF5d6eoJc6n63bWI9U4Ufz9T2g7M05RxxBzJ7PBRhRpfFTwVVrbJ_exBlr0PWQVlVoYP05bkndHQWRO6UEupIdRkmxPMfgG5mWZUWwNPfXcu-8jQq_ko9crGS',
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

