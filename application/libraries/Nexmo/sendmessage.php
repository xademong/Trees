<?php

require_once( "../include/Config.php" );
include ( "NexmoMessage.php" );

/**
 * To send a text message.
 *
 */

function sendInvite($senderName, $recipientNumber, $language) {
	
	if ($language == "de") {
		$text = "$senderName hat dir mit TREES eine Nachricht geschickt. Installiere die App, um die Nachricht zu sehen. (Link zum App-Store: https://itunes.apple.com/de/app/trees-fast-and-fun-messaging/id873940078?l=de&ls=1&mt=8)";
	} else {
		$text = "$senderName has sent you a message in TREES. Install the App to receive it. (Link to App-Store: https://itunes.apple.com/us/app/trees-fast-and-fun-messaging/id873940078)";
	}

	// Step 1: Declare new NexmoMessage.
	$nexmo_sms = new NexmoMessage(NEXMO_API_KEY, NEXMO_API_SECRET);

	// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
	$info = $nexmo_sms->sendText( $recipientNumber, 'Trees App', $text );

	// Step 3: Display an overview of the message
	// echo $nexmo_sms->displayOverview($info);

}

function sendCode($recipientNumber, $language, $code) {
	
	echo "*** $recipientNumber\n";
	
	// treat american numbers differently
	if (substr($recipientNumber, 0, 1) == "1") {
		echo "US";
		// send code in special us format
		sendUSCode($recipientNumber, $code);
	} else {
	
		if ($language == "de") {
			$text = "Herzlich willkommen bei TREES. Bitte gib folgenden Code in der App ein, um deine Anmeldung zu bestaetigen: $code ";
		} else {
			$text = "Welcome to TREES. Please enter the following code in the app to complete your registration: $code ";
		}

		// Step 1: Declare new NexmoMessage.
		$nexmo_sms = new NexmoMessage(NEXMO_API_KEY, NEXMO_API_SECRET);

		// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
		$info = $nexmo_sms->sendText( $recipientNumber, 'Trees App', $text );

		// Step 3: Display an overview of the message
		// echo $nexmo_sms->displayOverview($info);
	}
}

function sendUSCode($recipientNumber, $code) {

	$url = "https://rest.nexmo.com/sc/us/2fa/json?api_key=" . NEXMO_API_KEY . "&api_secret=" . NEXMO_API_SECRET . "&to=" . $recipientNumber . "&pin=" . $code;
	
	echo "\n" . $url;
	
    // create curl resource 
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 

    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // close curl resource to free up system resources 
    curl_close($ch);
}

function sendDeletionCode($recipientNumber, $language, $code) {
	
	// treat american numbers differently
	if (substr($recipientNumber, 0, 1) == "1") {
		
		// send code in special us format
		sendUSCode($recipientNumber, $code);
	} else {
	
		if ($language == "de") {
			$text = "Schade, dass du uns verlässt. Bitte gib folgenden Code in der Trees App ein, um deine Abmeldung zu bestätigen: $code ";
		} else {
			$text = "Sorry to see you leave. Please enter the following code in the Trees app to complete your deregistration: $code ";
		}

		// Step 1: Declare new NexmoMessage.
		$nexmo_sms = new NexmoMessage(NEXMO_API_KEY, NEXMO_API_SECRET);

		// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
		$info = $nexmo_sms->sendText( $recipientNumber, 'Trees App', $text );

		// Step 3: Display an overview of the message
		// echo $nexmo_sms->displayOverview($info);
	}
}

// functions for american customers

// sendInvite("Nils Hott", "+491713457844", "en");
// sendCode("+491713457844", "en", 1234);
// sendDeletionCode("+491713457844", "en", "12345");

// test us sending
// sendCode("16467348359", "en", "1357");
?>