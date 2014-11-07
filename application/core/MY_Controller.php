<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	// --------------------------------------------------------------------

	/**
	 * Initialize the Email Data
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		// Call the method to store the IP here
		$this->load->library('session');
		$this->load->helper('url');
	}

	// --------------------------------------------------------------------

	/**
	 * Utilizing the CodeIgniter's _remap function
	 * to call extra function with the controller action
	 *
	 * @access	public
	 * @return	boolean
	 */
	public function __remap($method, $params = array())
	{
		// Call before action
		$this->before();

		if (method_exists($this,$method))
		{
			return call_user_func_array(array($this, $method), $params);
		}
		else
		{
			return show_404();
		}

		// Call after action
		$this->after();
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Before action
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function before()
	{
		/*
		if (!$this->session->userdata('loggedin'))
		{
			redirect('/login');
		}
		*/
		return;
	}

	// --------------------------------------------------------------------

	/**
	 * Before action
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function after()
	{
		return;
	}

	// --------------------------------------------------------------------

	/**
	 * Before action
	 *
	 * @access	public
	 * @param 	array
	 * @return	void
	 */
	public function response($data)
	{
		echo json_encode($data); 
		exit;
	}

	// --------------------------------------------------------------------

	/**
	 * Get values in array with key
	 *
	 * @access	public
	 * @param 	array
	 * @return	void
	 */
	public function getValue($object, $key, $default = '')
	{
		if(is_array($object)) 
		{
			return isset($object[$key]) ? $object[$key] : $default;
		}
		else 
		{
			return ($object && $object != '') ? $object : $default;	
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */