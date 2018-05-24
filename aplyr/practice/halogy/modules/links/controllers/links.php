<?php

/**
 * Halogy
 *
 * A user friendly, modular content management system for PHP 5.0
 * Built on CodeIgniter - http://codeigniter.com
 *
 * @package		Halogy
 * @author		Haloweb Ltd
 * @copyright	Copyright (c) 2012, Haloweb Ltd
 * @license		http://halogy.com/license
 * @link		http://halogy.com/
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

class Links extends MX_Controller {

    var $partials = array();
    var $permissions = array();
    var $sitePermissions = array();

    function __construct() {
        parent::__construct();

        // get siteID, if available
        if (defined('SITEID')) {
            $this->siteID = SITEID;
        }

        // check user is logged in, if not send them away from this controller
        if (!$this->session->userdata('session_user')) {
            redirect('/users/login/' . $this->core->encode($this->uri->uri_string()));
        }

        // get site permissions and redirect if it don't have access to this module
//		if (!$this->permission->sitePermissions)
//		{
//			show_error('You do not have permission to view this page');
//		}
//		if (!in_array($this->uri->segment(1), $this->permission->sitePermissions))
//		{
//			show_error('You do not have permission to view this page');
//		}
        // get permissions for the logged in admin
        if ($this->session->userdata('session_admin')) {
            $this->permission->permissions = $this->permission->get_group_permissions($this->session->userdata('groupID'));
        }

        // load models and modules
        //   $this->load->model('forums_model', 'forums');	
        $this->load->module('pages');
        $this->load->library('mkdn');
        $this->load->helper('bbcode');
        $this->load->library('tags');
    }

    /* function links() {
      // grab data and display
      $output = $this->core->viewall('link');
      $this->pages->view('links', $output, TRUE);
      } */

    function index() {
        

        $output = $this->partials;
        $output['data'] = $this->core->get_values('links');
        $output['user'] = $this->session->userdata('userID');
        $output['groups'] = $this->permission->get_groups();

        //if there is credit in users table
        $where['userID'] = $this->session->userdata('userID');
        $this->redirect = '/plans';

        $data = $this->core->viewall('users', $where);
        $userData = $data['users'][0];


        if ($userData['link_credit'] <= 0) {
            echo "<script>alert('You haven\'t purchased any plan');window.location='/plans';</script>";
            //redirect($this->redirect);
        } else {
            $data = $this->core->viewall('orders', $where, array('order_id', 'desc'), 1);
            $orderData = $data['orders'][0];

            $mydate = strtotime($orderData['expire_date']);
            $curdate = strtotime("now");

            if ($curdate > $mydate) {
                echo "<script>alert('your plan is expired .please purchase a plan');window.location='/plans';</script>";
            } else {

                //count per day link of user
                $this->db->where('userID', $this->session->userdata('userID'));
                $this->db->where('DATE(created_date)', date('y-m-d'));

                $num_rows = $this->db->count_all_results('links');

                if ($num_rows >= $orderData['per_day_limit']) {
                    echo "<script>alert('Your limit is over for today.');window.location='/plans';</script>";
                } else {
                    if (count($_POST)) {
                        // required

                        if ($this->input->post('link_url') == "")
                            $output['errors'].="link URL is required.<br>";
                        if ($this->input->post('comments') == "")
                            $output['errors'].="Comments field is required.";


                        $this->core->required = array(
                            'link_url' => array('label' => 'link url', 'rules' => 'required|trim'),
                            'comments' => array('label' => 'Comments', 'rules' => 'required|trim'),
                        );

                        $this->core->set['link_url'] = $this->input->post('link_url');
                        $this->core->set['comments'] = $this->input->post('comments');

                        // update
                        if ($this->core->update('links')) {
                            $link_id = $this->db->insert_id();

                            $user = $this->session->userdata('userID');
                            $this->db->query("UPDATE `ha_users` set `link_credit`= `link_credit` - 1  WHERE `userID`='" . $user . "'");
                            $output['message']="Link posted successfully.";
                            // die;
                            // where to redirect to
                            // redirect($this->redirect);
                        }
                    }
                }
            }
        }

if ($this->input->get('status')) {
         $output['message']='Your payment is done.';
        }
        $output['page:title'] = 'My Account'; //page title set
        // display with cms layer
        $this->pages->view('link_all', $output, TRUE);
    }

    function status() {

        // grab data and display
        $where['userID'] = $this->session->userdata('userID');
        $data = $this->core->viewall('links', $where, array('ID', 'desc'));



        foreach ($data['links'] as $value) {
            if ($value['status'] == '1')
                $status = '<div class="statusinprog">In Progress</div>';
            if ($value['status'] == '2')
                $status = '<div class="statusrejected">Rejected</div>';
            if ($value['status'] == '3')
                $status = '<div class="statusactreq">Action Required</div>';
            if ($value['status'] == '4')
                $status = '<div class="statuscomplt">Completed</div>';


            $output['links'][] = array("link_status" => $status,
                "link_url" => $value['link_url']
            );
        }


        // set pagination
        $output['pagination'] = ($pagination = $this->pagination->create_links()) ? $pagination : '';
        // display with cms layer


        $output['page:title'] = 'My Account'; //page title set

        $this->pages->view('link_status', $output, TRUE);
    }

}
