<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/Nexmo/NexmoAccount.php';
require APPPATH.'/libraries/Nexmo/NexmoMessage.php';
require APPPATH.'/libraries/Nexmo/NexmoReceipt.php';

// ------------------------------------------------------------------------

/**
 * CodeIgniter Custom MyParseSDK Class
 *
 * Initialization Parse SDK by CodeIgniter Library
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		xademong@gmail.com
 * @link		http://codeigniter.com/user_guide/libraries/email.html
 */
class MyNexmoSDK {
	var $NEXMO_API_KEY		=	"";
	var $NEXMO_API_SECRET	=	"";

	var $error 				= 	"";
	var $errorCode 			= 	0;
	var $errorFlag 			= 	FALSE;

	var $ci;

	/**
	 * Constructor - Sets MyParseSDK Preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	public function __construct($config = array())
	{
		if (count($config) > 0)
		{
			$this->initialize($config);
		}
		$this->ci =& get_instance();
		$this->ci->load->helper('array');

		log_message('debug', "MyNexmoSDK Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	public function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$method = 'set_'.$key;

				if (method_exists($this, $method))
				{
					$this->$method($val);
				}
				else
				{
					$this->$key = $val;
				}
			}
		}

		$this->clear();
		
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize the Email Data
	 *
	 * @access	public
	 * @return	void
	 */
	public function clear($clear_attachments = FALSE)
	{
		/*
		$this->_subject		= "";
		$this->_body		= "";
		$this->_replyto_flag = FALSE;
		$this->_debug_msg	= array();
		*/
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * To send a text message.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	void
	 */

	function sendInvite($senderName, $recipientNumber, $language) {
		
		if ($language == "de") {
			$text = "$senderName hat dir mit TREES eine Nachricht geschickt. Installiere die App, um die Nachricht zu sehen. (Link zum App-Store: https://itunes.apple.com/de/app/trees-fast-and-fun-messaging/id873940078?l=de&ls=1&mt=8)";
		} else {
			$text = "$senderName has sent you a message in TREES. Install the App to receive it. (Link to App-Store: https://itunes.apple.com/us/app/trees-fast-and-fun-messaging/id873940078)";
		}

		// Step 1: Declare new NexmoMessage.
		$nexmo_sms = new NexmoMessage($this->NEXMO_API_KEY, $this->NEXMO_API_SECRET);

		// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
		$info = $nexmo_sms->sendText( $recipientNumber, 'Trees App', $text );

		// Step 3: Display an overview of the message
		// echo $nexmo_sms->displayOverview($info);

	}

	// --------------------------------------------------------------------

	/**
	 * To send a code.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	void
	 */
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
			$nexmo_sms = new NexmoMessage($this->NEXMO_API_KEY, $this->NEXMO_API_SECRET);

			// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
			$info = $nexmo_sms->sendText( $recipientNumber, 'Trees App', $text );

			// Step 3: Display an overview of the message
			// echo $nexmo_sms->displayOverview($info);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * To send a code.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function sendUSCode($recipientNumber, $code) {

		$url = "https://rest.nexmo.com/sc/us/2fa/json?api_key=" . $this->NEXMO_API_KEY . "&api_secret=" . $this->NEXMO_API_SECRET . "&to=" . $recipientNumber . "&pin=" . $code;
		
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

	// --------------------------------------------------------------------

	/**
	 * To send a code.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function sendDeletionCode($recipientNumber, $language, $code) {
		
		// treat american numbers differently
		if (substr($recipientNumber, 0, 1) == "1") 
		{
			// send code in special us format
			sendUSCode($recipientNumber, $code);
		} 
		else 
		{
		
			if ($language == "de") 
			{
				$text = "Schade, dass du uns verlässt. Bitte gib folgenden Code in der Trees App ein, um deine Abmeldung zu bestätigen: $code ";
			} 
			else 
			{
				$text = "Sorry to see you leave. Please enter the following code in the Trees app to complete your deregistration: $code ";
			}

			// Step 1: Declare new NexmoMessage.
			$nexmo_sms = new NexmoMessage($this->NEXMO_API_KEY, $this->NEXMO_API_SECRET);

			// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
			$info = $nexmo_sms->sendText( $recipientNumber, 'Trees App', $text );

			// Step 3: Display an overview of the message
			// echo $nexmo_sms->displayOverview($info);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set Message
	 *
	 * @access	protected
	 * @param	string
	 * @return	string
	 */
	protected function _setErrorMessage($msg, $val = '')
	{
		/*
		$CI =& get_instance();
		$CI->lang->load('email');
		$this->_debug_msg[] = str_replace('%s', $val, $msg)."<br />";
		*/		
	}

	// --------------------------------------------------------------------
	
}

// functions for american customers

// sendInvite("Nils Hott", "+491713457844", "en");
// sendCode("+491713457844", "en", 1234);
// sendDeletionCode("+491713457844", "en", "12345");

// test us sending
// sendCode("16467348359", "en", "1357");

// END MyParseSDK class

/* End of file MyParseSDK.php */
/* Location: ./application/libraries/MyNexmoSDK.php */
