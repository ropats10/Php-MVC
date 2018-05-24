<?php

class Admin extends MX_Controller {

	// set defaults
	var $includes_path = '/includes/admin';				// path to includes for header and footer
	var $redirect = '/admin/links/viewall';				// default redirect
	var $permissions = array();
	var $uploadsPath;
        var $table;
	
	function __construct()
	{
		parent::__construct();

		// check user is logged in, if not send them away from this controller
		if (!$this->session->userdata('session_admin'))
		{
			redirect('/admin/login/'.$this->core->encode($this->uri->uri_string()));
		}
		
		// get siteID, if available
		if (defined('SITEID'))
		{
			$this->siteID = SITEID;
		}

                $this->uploadsPath = $this->config->item('uploadsPath');

                $this->table = 'links';

		// load libs
		 $this->load->model('users/users_model', 'users');
		$this->load->model('banners_model', 'banners');
	}
	
	function index()
	{
		
		redirect($this->redirect);
	}
	
	function viewall()
	{		
		// check permissions for this page
		if (!in_array('pages', $this->permission->permissions))
		{
			redirect('/admin/dashboard/permissions');
		}

                $output['links'] = $this->banners->get_links();
		// send data to view
		$output['pagination'] = ($pagination = $this->pagination->create_links()) ? $pagination : '';
		$this->load->view($this->includes_path.'/header');
		$this->load->view('admin/links',$output);
		$this->load->view($this->includes_path.'/footer');
	}



	function link_add() {
		// check permissions for this page
		if (!in_array('pages_edit', $this->permission->permissions))
		{
			redirect('/admin/dashboard/permissions');
		}
				
		// required
		$this->core->required = array(
			'link_url' => array('label' => 'Link URL', 'rules' => 'required|trim'),
		);

		// get values
		$output['data'] = $this->core->get_values('links');
                
		if (count($_POST) && $this->core->check_errors())
		{	
		
			// update
			if ($this->core->update('links'))
			{
				// set success message
				$this->session->set_flashdata('success', 'Your changes were saved.');
			
			} 
			else 
			{
				// set error message
				$this->session->set_flashdata('success', 'An error occured while event details were being updated.');

			}
			
			// where to redirect to
			redirect($this->redirect);

		}

		$output['users'] = $this->users->get_usersIDs();

		// set message
		if ($message = $this->session->flashdata('success'))
		{
			$output['message'] = '<p>'.$message.'</p>';
		}

		// templates
		$this->load->view($this->includes_path.'/header');
		$this->load->view('admin/manage_links',$output);
		$this->load->view($this->includes_path.'/footer');		
	}
	function edit_link($ID = '')
	{
		// check permissions for this page
		if (!in_array('pages_edit', $this->permission->permissions))
		{
			redirect('/admin/dashboard/permissions');
		}
				
		// required
		$this->core->required = array(
			'link_url' => array('label' => 'Link URL', 'rules' => 'required|trim'),
		);

		// where
		$objectID = array('ID' => $ID, 'siteID' => $this->siteID);	

		// get values
		$output['data'] = $this->core->get_values('links', $objectID);

		if (count($_POST) && $this->core->check_errors())
		{	
			// update
			if ($this->core->update('links', $objectID))
			{
				// set success message
				$this->session->set_flashdata('success', 'Your changes were saved.');
			
			} 
			else 
			{
				// set error message
				$this->session->set_flashdata('success', 'An error occured while event details were being updated.');

			}
			
			// where to redirect to
			redirect('/admin/links/edit_link/'.$ID);

		}

	// set message
		if ($message = $this->session->flashdata('success'))
		{
			$output['message'] = '<p>'.$message.'</p>';
		}

		$output['users'] = $this->users->get_usersIDs();
		// templates
		$this->load->view($this->includes_path.'/header');
		$this->load->view('admin/manage_links',$output);
		$this->load->view($this->includes_path.'/footer');			
		
	}
	
	function delete_link($objectID) 
	{
		// check permissions for this page
		if (!in_array('pages_edit', $this->permission->permissions))
		{
			redirect('/admin/dashboard/permissions');
		}		
		
		if ($this->core->delete('links', array('ID' => $objectID)))
		{
			// where to redirect to
			redirect($this->redirect);
		}
	}
	function viewlink($objectID)
        {
            // check permissions for this page
		if (!in_array('pages', $this->permission->permissions))
		{
			redirect('/admin/dashboard/permissions');
		}

	    $banners = $this->core->viewall($this->table,array('userID' => $objectID));
            $banner = $this->core->viewall('users',array('userID' => $objectID));
            $output1 = $banners;
            $output2 = $banner;
            $result = array_merge($output1,$output2);
                $this->load->view($this->includes_path.'/header');
		$this->load->view('admin/userlinks',$result);
                $this->load->view($this->includes_path.'/footer');
        }


}

