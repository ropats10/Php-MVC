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

class Admin extends MX_Controller {

    // set defaults
    var $table = 'testimonial';        // table to update
    var $includes_path = '/includes/admin';    // path to includes for header and footer
    var $redirect = '/admin/testimonial/viewtestimonial';    // default redirect
    var $objectID = 'testID';       // default unique ID									
    var $permissions = array();

    function Admin() {
        parent::__construct();

        // check user is logged in, if not send them away from this controller
        $this->load->library('parser');
       $this->load->model('testimonial_model','testimonial');
    }

    function add_testimonial() {

        // check permissions for this page
//        if (!in_array('testimonial_edit', $this->permission->permissions)) {
//            redirect('/admin/dashboard/permissions');
//        }
        // get values
        //$output['data'] = $this->core->get_values('plans');
        
        if (count($_POST))
		{		
			// required
			$this->core->required = array(
				'description' => array('label' => 'description', 'rules' => 'required|min_length[10]|max_length[500]'),
                                'author'=>array('label' => 'author', 'rules' => 'required|regex_match[/^[A-Za-z\s]{5,15}$/]'),
                                'location'=>array('label' => 'location', 'rules' => 'required|regex_match[/^[A-Za-z\s]{2,20}$/]'),
                	);
			
			// set data
			$this->core->set['description'] = $this->input->post('description');
			$this->core->set['author'] = $this->input->post('author');
			$this->core->set['location'] = $this->input->post('location');
			$this->core->set['created_date'] = date("Y-m-d");
                        
                        // update
			if ($this->core->update('testimonial'))
			{
				//$testID = $this->db->insert_id();
                                // set success message
                                $output['message'] = '<p>Your Plans were saved.</p>';
                                redirect($this->redirect);
			}
		}
                // templates
		$this->load->view($this->includes_path.'/header');
		$this->load->view('admin/add_testimonial');
		$this->load->view($this->includes_path.'/footer');

       
    }
    function viewtestimonial() 
    {
        // default where
		$where = array();
               
		// grab data and display
		$output['testimonial'] = $this->testimonial->get_testimonial();
                //pagination
                 $output['pagination'] = ($pagination = $this->pagination->create_links()) ? $pagination : '';
                // load view    
		$this->load->view($this->includes_path.'/header');
		$this->load->view('admin/view_testimonial',$output);
		$this->load->view($this->includes_path.'/footer');
    }
    function edit_testimonial($testID)
    {
        // check permissions for this page
//		if (!in_array('plans_edit', $this->permission->permissions))
//		{
//			redirect('/admin/dashboard/permissions');
//		}
		// set object ID
		$objectID = array('testID' => $testID);
                // get values
		$output['data'] = $this->core->get_values($this->table, $objectID);	
                //var_dump($output['data']);
                if (count($_POST))
		{
			// required
			$this->core->required = array(
				'description' => array('label' => 'description', 'rules' => 'required|min_length[10]|max_length[500]'),
                                'author'=>array('label' => 'author', 'rules' => 'required|regex_match[/^[A-Za-z\s]{5,15}$/]'),
                                'location'=>array('label' => 'location', 'rules' => 'required|regex_match[/^[A-Za-z\s]{2,20}$/]'),
                	);
                        
			// set data
			$this->core->set['description'] = $this->input->post('description');
			$this->core->set['author'] = $this->input->post('author');
			$this->core->set['location'] = $this->input->post('location');
			$this->core->set['created_date'] = date("Y-m-d");
                        
			// update
			if ($this->core->update($this->table, $objectID))
			{
				$output['message'] = '<p>Your changes were saved.</p>';
				// where to redirect to
				//redirect('/admin/plans/add_plans/'.$planID);
			}
		}
                // load view
		$this->load->view($this->includes_path.'/header');
		$this->load->view('admin/add_testimonial', $output);
		$this->load->view($this->includes_path.'/footer');

    }
     function delete_testimonial($objectID)
    {
        // check permissions for this page
//		if (!in_array('plans_delete', $this->permission->permissions))
//		{
//			redirect('/admin/dashboard/permissions');
//		}		
		
		if ($this->core->delete($this->table, array('testID' => $objectID)))
		{
			// where to redirect to
			redirect('/admin/testimonial/viewtestimonial');
		}
    }


}
