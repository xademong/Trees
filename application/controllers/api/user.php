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

        //$this->load->library('MyNexmoSDK');
        $this->load->model('user_model');
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
        //$userimage = file_get_contents($_FILES["userimage"]["tmp_name"], true);
        $body = array(
                'prefix' =>  $this->post('prefix'),
                'number' =>  $this->post('number'),
                'full_number' =>  $this->post('full_number'),
                'first_name' =>  $this->post('first_name'),
                'last_name' =>  $this->post('last_name'),
                'user_image' =>  $this->post('user_image'),
                'cdn_url' =>  $this->post('cdn_url'),
                'code' => rand(1000, 9999),
                'device_token' =>  $this->post('device_token'),
                'active' =>  false
            );

        $result = $this->user_model->insert_user($body);
        
        if ($result == USER_ALREADY_EXISTED) 
        {
            $this->response(array('error' => 'User already exists'), 400);
        }
        else if ($result){
            $body['id'] = $result;
            $recipient_number = $body['prefix'] . $body['number'];
            $language = "en";
            $this->mynexmosdk->sendCode($recipient_number, $language, $body['code']);
            $this->response($body, 200); // 200 being the HTTP response code
        }
        else 
        {
            $this->response(array('error' => 'faild to create user'), 400);
        }          
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
        //verifyRequiredParams(array('prefix', 'number'));

        $body = array(
                'prefix' =>  $this->put('prefix'),
                'number' =>  $this->put('number'),
                'full_number' =>  $this->put('full_number'),
                'first_name' =>  $this->put('first_name'),
                'last_name' =>  $this->put('last_name'),
                'code' => rand(1000, 9999)
            );

        $result = $this->user_model->update_user($body);
        if ($result == USER_UPDATED_SUCCESSFULLY) 
        {
            $recipient_number = $body['prefix'] . $body['number'];
            $language = "en";
            $this->myfacebooksdk->sendCode($recipient_number, $language, $body['code']);
            $this->response($body, 200); // 200 being the HTTP response code
        }
        else 
        {
            $this->response(array('error' => 'faild to create user'), 400);
        }
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
        $users = $this->user_model->get_all_users();
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
    function login_post()
    {
        
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function validate_post()
    {
        
    }

    // --------------------------------------------------------------------

    /**
     * Verification api params
     *
     * @access  private
     * @param   string
     * @param   array
     * @return  void
     */
    function _verify_params($method, $params) 
    {
        /*
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        */
    }
}