<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Controller
 * @author      Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Message extends REST_Controller
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
    function index_delete()
    {
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
}