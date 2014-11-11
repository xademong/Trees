<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/config.html
 */

class User_model extends CI_Model {

    var $prefix         = '';
    var $number         = '';
    var $full_number    = '';
    var $first_name     = '';
    var $last_name      = '';
    var $user_image     = '';
    var $cdn_url        = '';
    var $code           = '';
    var $device_token   = '';
    var $active         = '';

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function get_all_users()
    {
        $query = $this->db->get('users');
        return $query->result(); //result_array()
    }

    // --------------------------------------------------------------------

    /**
     * Insert user into db
     *
     * @access  public
     * @return  void
     */
    function insert_user($user)
    {
        $this->prefix         = $user['prefix'];
        $this->number         = $user['number'];
        $this->full_number    = $user['full_number'];
        $this->first_name     = $user['first_name'];
        $this->last_name      = $user['last_name'];
        $this->user_image     = $user['user_image'];
        $this->cdn_url        = $user['cdn_url'];
        $this->code           = $user['code'];
        $this->device_token   = $user['device_token'];
        $this->active         = $user['active'];

        if ($this->is_existing($this->prefix, $this->number))
        {
            return USER_ALREADY_EXISTED;
        }
        else
        {
            $this->db->insert('users', $this);
            return $this->db->insert_id();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function update_user($user)
    {
        $id = $user['id'];
        foreach($user as $key=>$val) {
            $this->$key = $val;
        }
        $this->db->update('users', $this, array('id' => $id));
        return USER_UPDATED_SUCCESSFULLY;
    }

    // --------------------------------------------------------------------

    /**
     * Check if user exists already
     *
     * @access  public
     * @return  void
     */
    function is_existing($prefix, $number)
    {
        $query = $this->db->query("SELECT * FROM users WHERE prefix='$prefix' AND number='$number'");
        return ($query->num_rows() >= 1) ? TRUE : FALSE;
    }
}

// END Model Class

/* End of file Model.php */
/* Location: ./applications/models/user_model.php */