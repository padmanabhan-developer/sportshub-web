<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller {

	// custom variables
	
	public $data;
    public $title;
	/**
	 * Constructor
	 */
	public function __construct()
	{
	  parent::__construct();	
	  
	  $data = array();
	  $title = array();
	 
      $segment=$this->uri->segment(1);		
	  $this->CommonSettings();
	  
	}

	public function CommonSettings()
	{
	 date_default_timezone_set('Asia/Kolkata');
     $this->load->library('General_Query_Functions');	
	 $this->db_query= new General_Query_Functions(); 
	}
	 public function Pagenation($cp,$ppr,$total_records)
   {
	   $total_page=(int)($total_records/$ppr);
	   $rem=($total_records % $ppr);
	   if($rem > 0)
	    $total_page=$total_page + 1;
	   if(empty($cp)) $cp=1;
	   $start_limit=($cp-1)*$ppr;
	   if(($total_page == $cp) and $rem > 0)
	    $end_limit=$rem;
	   else
	    $end_limit=$ppr;
	   if($total_page > $cp)
	    $next_page=$cp + 1;
	   else $next_page=0; 
	   if($cp > 1)
	    $previous_page=$cp-1;  
	   else $previous_page=0;   
	   $info['start_limit']=$start_limit;
	   $info['end_limit']=$end_limit;
	   $info['next_page']=$next_page;
	   $info['previous_page']=$previous_page;
	   $info['cp']=$cp;
	   $info['total_page']=$total_page;
	   return $info;
  	}
	 
 }
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */