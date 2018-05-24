<?php 

class Banners_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();

		// get siteID, if available
		if (defined('SITEID'))
		{
			$this->siteID = SITEID;
		}


	}
	function get_links()
        {
            $limit = 10;
            $totalrow = $this->db->count_all("links");
            $this->core->set_paging($totalrow, $limit);
            $query = $this->db->get('links', $limit, $this->pagination->offset);
            if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
        }
	function shqytdchcbdjk()
	{		
		// default where
		$this->db->where(array('siteID' => $this->siteID, 'deleted' => 0));

		// where parent is set
		// $this->db->where('parentID', 0); 
		
		$this->db->order_by('offerCode', 'asc');
		
		$query = $this->db->get('introoffers_offers');
		
		if ($query->num_rows())
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}		
	}

}
