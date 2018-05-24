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
    var $table = 'plans';        // table to update
    var $includes_path = '/includes/admin';    // path to includes for header and footer
    var $redirect = '/admin/plans/viewplans';    // default redirect
    var $objectID = 'planID';       // default unique ID									
    var $permissions = array();

    function Admin() {
        parent::__construct();
        // check permissions for this page
        if (!in_array('users_edit', $this->permission->permissions)) {
            redirect('/admin/dashboard/permissions');
        }

        // check user is logged in, if not send them away from this controller
        $this->load->library('parser');
        //$this->load->model('aplyrplans_model', 'plans');
    }

    function add_plans() {

        // check permissions for this page
//        if (!in_array('plans_edit', $this->permission->permissions)) {
//            redirect('/admin/dashboard/permissions');
//        }
        // get values
        $output['data'] = $this->core->get_values('plans');

        if (count($_POST)) {
            // required
            $this->core->required = array(
                'planName' => array('label' => 'planName', 'rules' => 'required|min_length[5]|max_length[15]'),
                'noOfCredits' => array('label' => 'noOfCredits', 'rules' => 'required|regex_match[/^[0-9]{1,3}$/]'),
                'CreditValidity' => array('label' => 'CreditValidity', 'rules' => 'required|regex_match[/^[0-9A-Za-z\s]{1,10}$/]'),
                'perDayLimits' => array('label' => 'perDayLimits', 'rules' => 'required|regex_match[/^[0-9]{1,3}$/]'),
                'customerSupport' => array('label' => 'customerSupport', 'rules' => 'required|min_length[3]|max_length[50]'),
                'planPrice' => array('label' => 'planPrice', 'rules' => 'required|regex_match[/^[0-9]{1,5}(,[0-9]{5})*(\.[0-9]{2})$/]'),
            );

            // set data
            $this->core->set['plan_name'] = $this->input->post('planName');
            $this->core->set['no_of_credit'] = $this->input->post('noOfCredits');
            $this->core->set['credit_validity'] = $this->input->post('CreditValidity');
            $this->core->set['days'] = $this->input->post('days');
            $this->core->set['per_day_limit'] = $this->input->post('perDayLimits');
            $this->core->set['customer_support'] = $this->input->post('customerSupport');
            $this->core->set['plan_price'] = $this->input->post('planPrice');
            $this->core->set['created_date'] = date("Y-m-d");
            $this->core->set['status'] = $this->input->post('status');
            $this->core->set['class_name'] = $this->input->post('className');


            // update
            if ($this->core->update('plans')) {
                $postID = $this->db->insert_id();
                // set success message
                $output['message'] = '<p>Your Plans were saved.</p>';
                redirect($this->redirect);
            }
        }
        // templates
        $this->load->view($this->includes_path . '/header');
        $this->load->view('admin/add_plans', $output);
        $this->load->view($this->includes_path . '/footer');
    }

    function viewplans() {
        // default where
        $where = array();
        // set by userID if 'access all' permission is not set
//		if (!in_array('plans_all', $this->permission->permissions))
//		{
//			$where['userID'] = $this->session->userdata('userID');
//		}
        // grab data and display
        $output = $this->core->viewall('plans');

        $this->load->view($this->includes_path . '/header');
        $this->load->view('admin/viewplans', $output);
        $this->load->view($this->includes_path . '/footer');
    }

    function viewOrders() {
        // default where
        $where = array();
        // set by userID if 'access all' permission is not set
        if (!in_array('pages_all', $this->permission->permissions)) {
            $where['userID'] = $this->session->userdata('userID');
        }
        $totalrows=$this->db->count_all("orders");
        $limit=10;
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->order_by('order_id', 'DESC');
        $this->db->join('users', 'users.userID = orders.userID');
        //$this->db->limit(10,0);
        $this->core->set_paging($totalrows, $limit);
        
        
        
        //$query = $this->db->get('links', $limit, $this->pagination->offset);
        $query = $this->db->get('',$limit,$this->pagination->offset);        
        $result = $query->result_array();
        $output['orders'] = $result;
        // grab data and display
        //$output = $this->core->viewall('orders');

        $this->load->view($this->includes_path . '/header');
        $this->load->view('admin/viewOrders', $output);
        $this->load->view($this->includes_path . '/footer');
    }

    function viewOrder($order_id) {
        $where = array();
        // set by userID if 'access all' permission is not set
        if (!in_array('pages_all', $this->permission->permissions)) {
            $where['userID'] = $this->session->userdata('userID');
        }
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('order_id', $order_id);
        $this->db->join('users', 'users.userID = orders.userID');
        $query = $this->db->get();
        $result = $query->result_array();

        $output['order'] = $result[0];
        // grab data and display
        $this->load->view($this->includes_path . '/header');
        $this->load->view('admin/viewOrder', $output);
        $this->load->view($this->includes_path . '/footer');
    }

    function edit_plans($planID) {
        // check permissions for this page
//		if (!in_array('plans_edit', $this->permission->permissions))
//		{
//			redirect('/admin/dashboard/permissions');
//		}
        // set object ID
        $objectID = array('planID' => $planID);
        // get values
        $output['data'] = $this->core->get_values('plans', $objectID);
        //var_dump($output['data']);
        if (count($_POST)) {
            // required
            $this->core->required = array(
                'planName' => array('label' => 'planName', 'rules' => 'required|min_length[5]|max_length[15]'),
                'noOfCredits' => array('label' => 'noOfCredits', 'rules' => 'required|regex_match[/^[0-9]{1,3}$/]'),
                'CreditValidity' => array('label' => 'CreditValidity', 'rules' => 'required|regex_match[/^[0-9A-Za-z\s]{1,10}$/]'),
                'perDayLimits' => array('label' => 'perDayLimits', 'rules' => 'required|regex_match[/^[0-9]{1,3}$/]'),
                'customerSupport' => array('label' => 'customerSupport', 'rules' => 'required|min_length[3]|max_length[50]'),
                'planPrice' => array('label' => 'planPrice', 'rules' => 'required|regex_match[/^[0-9]{1,5}(,[0-9]{5})*(\.[0-9]{2})$/]'),
            );
            // set data
            $this->core->set['plan_name'] = $this->input->post('planName');
            $this->core->set['no_of_credit'] = $this->input->post('noOfCredits');
            $this->core->set['credit_validity'] = $this->input->post('CreditValidity');
            $this->core->set['days'] = $this->input->post('days');
            $this->core->set['per_day_limit'] = $this->input->post('perDayLimits');
            $this->core->set['customer_support'] = $this->input->post('customerSupport');
            $this->core->set['plan_price'] = $this->input->post('planPrice');
            $this->core->set['created_date'] = date("Y-m-d");
            $this->core->set['status'] = $this->input->post('status');
            $this->core->set['class_name'] = $this->input->post('className');
            // update
            if ($this->core->update('plans', $objectID)) {
                $output['message'] = '<p>Your changes were saved.</p>';
                // where to redirect to
                //redirect('/admin/plans/add_plans/'.$planID);
            }
        }
        // templates
        $this->load->view($this->includes_path . '/header');
        $this->load->view('admin/add_plans', $output);
        $this->load->view($this->includes_path . '/footer');
    }

    function delete_plans($objectID) {
        // check permissions for this page
//		if (!in_array('plans_delete', $this->permission->permissions))
//		{
//			redirect('/admin/dashboard/permissions');
//		}		

        if ($this->core->delete('plans', array('planID' => $objectID))) {
            // where to redirect to
            redirect('/admin/plans/viewplans');
        }
    }

}
