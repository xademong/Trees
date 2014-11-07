<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller
{
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php

        //$this->load->model('user_model');
        //$this->user_model->get();
    }
    
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function index_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
		);
		
    	$user = @$users[$this->get('id')];
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function index_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function index_put()
    {
        /*verifyRequiredParams(array('prefix', 'number'));

        // reading post params
        $prefix = $app->request->post('prefix');
        $number = $app->request->post('number');
        $firstname = $app->request->post('firstname');
        $lastname = $app->request->post('lastname');
        
        // update data in db
        $db = new DbHandler();
        $res = $db->updateUser($prefix, $number, $firstname, $lastname);

        // create response
        $response = array();
        if ($res == USER_UPDATED_CODE_SUCCESSFULLY) {   

            $response["error"] = false;
            $response["message"] = "Information updated successfully.";
            echoRespnse(201, $response);
        } else if ($res == USER_UPDATE_CODE_FAILED) {
            $response["error"] = true;
            $response["message"] = "Oops! An error occurred while updating user data.";
            echoRespnse(200, $response);
        }*/
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function index_delete()
    {
    	/*verifyRequiredParams(array('prefix', 'number'));

        // reading post params
        $prefix = $app->request->post('prefix');
        $number = $app->request->post('number');
        
        // create 4 digit code to verifiy user
        $code = rand(1000, 9999);
        
        // update code in db
        $db = new DbHandler();
        $res = $db->updateCode($prefix, $number,$code);

        // create response
        $response = array();
        if ($res == USER_UPDATED_CODE_SUCCESSFULLY) {   
            // send sms with code to user's phone
            $recipientNumber = $prefix . $number;
            $language = "en";
            sendDeletionCode($recipientNumber, $language, $code);

            // send code back to user
            $response["error"] = false;
            $response["message"] = "SMS with deletion code sent.";
            $response["code"] = $code;
            echoRespnse(201, $response);
        } else if ($res == USER_UPDATE_CODE_FAILED) {
            $response["error"] = true;
            $response["message"] = "Oops! An error occurred while deeleting user.";
            echoRespnse(200, $response);
        }*/
    }
    
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function all_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function signup_post()
    {
        /*
        verifyRequiredParams(array('prefix', 'number'));

        // reading post params
        $firstname = $app->request->post('firstname');
        $lastname = $app->request->post('lastname');
        $prefix = $app->request->post('prefix');
        $number = $app->request->post('number');
        $devicetoken = $app->request->post('devicetoken');
        $active = 0;

        // load image and audio files
        $userimage = file_get_contents($_FILES["userimage"]["tmp_name"], true);
        
        // create 4 digit code to verifiy user
        $code = rand(1000, 9999);
        
        // create db call
        $db = new DbHandler();
        $res = $db->createUser($firstname, $lastname, $prefix, $number, $userimage, $code, $active, $devicetoken);

        // create response
        $response = array();
        if ($res == USER_CREATED_SUCCESSFULLY) {
            #error_log("USER_CREATED_SUCCESSFULLY");
            // send sms with code to user's phone
            $recipientNumber = $prefix . $number;
            $language = "en";
            sendCode($recipientNumber, $language, $code);

            // send code back to user
            $response["error"] = false;
            $response["message"] = "You are successfully registered.";
            $response["code"] = $code;
            echoRespnse(201, $response);
        } else if ($res == USER_CREATE_FAILED) {
            #error_log("USER_CREATE_FAILED");
            $response["error"] = true;
            $response["message"] = "Oops! An error occurred while registering.";
            echoRespnse(200, $response);
        } else if ($res == USER_ALREADY_EXISTED) {
            #error_log("USER_ALREADY_EXISTED");
            $response["error"] = true;
            $response["message"] = "Sorry, this number is already registered.";
            echoRespnse(200, $response);
        } 
        // user is registered but not validated
        else {      
            # error_log("JUST CODE");
     
            // send sms with code to user's phone
            $recipientNumber = $prefix . $number;
            $language = "en";
            sendCode($recipientNumber, $language, $res);
     
            $response["error"] = true;
            $response["code"] = $res;
            echoRespnse(200, $response);
        }
        */
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function login_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
}