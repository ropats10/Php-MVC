<?php
/**
 * Halogy
 *
 * A user friendly, modular content management system for PHP 5.0
 * Built on CodeIgniter - http://codeigniter.com
 *
 * @package		Halogy
 * @author		Haloweb Ltd.
 * @copyright	Copyright (c) 2008-2011, Haloweb Ltd.
 * @license		http://halogy.com/license
 * @link		http://halogy.com/
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

class Aplyrplans_model extends CI_Model {

	var $siteID;
	
	function Aplyrplans_model()
	{
		parent::__construct();
		
		$this->table = 'plans';

		if (!$this->siteID)
		{
			$this->siteID = SITEID;
		}
	}
        function form_insert($data)
        {
                //var_dump($data);
            //$this->db->insert('plans',$data);
        }
        function viewall_plans()
        {
              //  return  $this->db->get('plans')->result();
            
        }
	
}
