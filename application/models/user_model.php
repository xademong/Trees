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

    var $title   = '';
    var $content = '';
    var $date    = '';

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
    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}

// END Model Class

/* End of file Model.php */
/* Location: ./applications/models/user_model.php */