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

class Testimonial_model extends CI_Model {

	var $siteID;
	
	function Aplyrplans_model()
	{
		parent::__construct();
		
		$this->table = 'testimonial';

		if (!$this->siteID)
		{
			$this->siteID = SITEID;
		}
	}
        function view_testimonial()
        {
                $this->db->order_by('testID', 'RANDOM');
                $this->db->limit(1);
                $query = $this->db->get('testimonial');
                return $query->result_array();

        }
	 function get_testimonial()
        {
            $limit = 10;
            $totalrow = $this->db->count_all("testimonial");
            $this->core->set_paging($totalrow, $limit);
            $query = $this->db->get('testimonial', $limit, $this->pagination->offset);
            if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
        }
	
}
