<?php

define("AUTHORIZENET_API_LOGIN_ID", "77eDXy6mL");
define("AUTHORIZENET_TRANSACTION_KEY", "6n2d2S399DJfBNdx");
define("AUTHORIZENET_SANDBOX", true);

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

class Plans extends MX_Controller {

    var $partials = array();
    var $permissions = array();
    var $sitePermissions = array();

    function __construct() {
        parent::__construct();

        // get siteID, if available
        if (defined('SITEID')) {
            $this->siteID = SITEID;
        }

        // get site permissions and redirect if it don't have access to this module
        /* if (!$this->permission->sitePermissions)
          {
          show_error('You do not have permission to view this page');
          }
          if (!in_array($this->uri->segment(1), $this->permission->sitePermissions))
          {
          show_error('You do not have permission to view this page');
          }

          // get permissions for the logged in admin
          if ($this->session->userdata('session_admin'))
          {
          $this->permission->permissions = $this->permission->get_group_permissions($this->session->userdata('groupID'));
          } */

        // load models and modules
        //$this->load->module('planes');
        $this->load->library('tags');
        $this->load->module('pages');
        $this->load->module('pages');
        $this->load->library('mkdn');
        $this->load->helper('bbcode');
        $this->load->library('tags');
    }

    function index() {

        // grab data and display
        $outputs = $this->core->viewall('plans');

        foreach ($outputs['plans'] as $outputfill) {
            $output['plan'][] = array(
                "planID" => $outputfill['planID'],
                "planName" => $outputfill['plan_name'],
                "noOfCredit" => $outputfill['no_of_credit'],
                "creditValidity" => $outputfill['credit_validity'],
                "perDayLimit" => $outputfill['per_day_limit'],
                "customerSupport" => $outputfill['customer_support'],
                "planPrice" => $outputfill['plan_price'],
                "createdDate" => $outputfill['created_date'],
                "status" => $outputfill['status'],
                "className" => $outputfill['class_name']
            );
        }
        $output['page:title'] = 'Plans'; //page title set 
        $output['pagination'] = ($pagination = $this->pagination->create_links()) ? $pagination : '';
        // display with cms layer
        $this->pages->view('plans', $output, TRUE);
    }

    function selectPlan() {
        // check user is logged in, if not send them away from this controller
        if (!$this->session->userdata('session_user')) {
            redirect('/users/login/' . $this->core->encode($this->uri->uri_string()));
        }
        if (!$this->input->get('plan')) {
            redirect('/plans');
        }


        //if there is credit in users table
        $whereuser['userID'] = $this->session->userdata('userID');
        $this->redirect = '/plans';

        $data = $this->core->viewall('users', $whereuser);
        $userData = $data['users'][0];
     
        if ($userData['link_credit'] > 0) {
            $data = $this->core->viewall('orders', $whereuser, array('order_id', 'desc'), 1);
            $orderData = $data['orders'][0];

            $mydate = strtotime($orderData['expire_date']);
            $curdate = strtotime("now");

            if ($curdate < $mydate) {
                echo "<script>alert('your plan is already running,You cannot purchase another plan.');window.location='/plans';</script>";
            }
        }


        $this->core->set['userID'] = $this->session->userdata('userID');
        $this->core->set['planID'] = $this->input->get('plan');
        $planID = $this->input->get('plan');

        //get plans data
        $where['planID'] = $this->input->get('plan');
        $out = $this->core->viewall('plans', $where);
        $data = $out['plans'];


        $this->core->set['plan_name'] = $data[0]['plan_name'];
        $this->core->set['no_of_credit'] = $data[0]['no_of_credit'];
        $this->core->set['credit_validity'] = $data[0]['credit_validity'];
        $this->core->set['per_day_limit'] = $data[0]['per_day_limit'];
        $this->core->set['days'] = $data[0]['days'];
        $this->core->set['plan_price'] = $data[0]['plan_price'];
        $amount = $data[0]['plan_price'];

        $date = strtotime("+" . $data[0]['days'] . " days");
        //$date = strtotime("+ 8 days");
        // echo date('Y-m-d', $date);
        $this->core->set['expire_date'] = date('Y-m-d H:i:s', $date); //set expire date
        //die;
        //set users data in form
        $whereUser['userID'] = $this->session->userdata('userID');
        $userData = $this->core->viewall('users', $whereUser);

        $output['form:email'] = set_value('email', $userData['users'][0]['email']);
        $output['form:fname'] = set_value('firstName', $userData['users'][0]['firstName']);
        $output['form:lname'] = set_value('lastName', $userData['users'][0]['lastName']);
        $output['form:phone'] = set_value('phone', $userData['users'][0]['phone']);
        $output['form:city'] = set_value('city', $userData['users'][0]['city']);
        $output['form:address'] = set_value('address', $userData['users'][0]['address1']);
        $output['select:country'] = @display_countries('c', set_value('country', $userData['users'][0]['country']), 'id="country" class="formelement"');
        $output['select:state'] = @display_states('s', set_value('state', $userData['users'][0]['state']), 'id="state" class="formelement"');


        $where = "";

        if ($this->core->update('orders', $where)) {

            $orderID = $this->db->insert_id();

            // where to redirect to
            //  redirect($this->redirect);
        }
        //$this->redirect = 'plans/payment';
        //call payment form

        $output['plan_name'] = $data[0]['plan_name'];
        $output['no_of_credit'] = $data[0]['no_of_credit'];
        $output['credit_validity'] = $data[0]['credit_validity'];
        $output['per_day_limit'] = $data[0]['per_day_limit'];
        //$this->core->set['days']=$data['days'];
        $output['plan_price'] = $data[0]['plan_price'];
        $output['page:title'] = 'Payment'; //page title set 
        // where to redirect to
        //redirect($this->redirect);


        if (count($_POST)) {

            $this->core->required = array(
                'card' => array('label' => 'link url', 'rules' => 'required|trim'),
                'mm' => array('label' => 'link url', 'rules' => 'required|trim'),
                'yy' => array('label' => 'link url', 'rules' => 'required|trim'),
                'code' => array('label' => 'link url', 'rules' => 'required|trim'),
                'email' => array('label' => 'link url', 'rules' => 'required|trim'),
                'phone' => array('label' => 'link url', 'rules' => 'required|trim'),
                'fname' => array('label' => 'link url', 'rules' => 'required|trim'),
                'lname' => array('label' => 'link url', 'rules' => 'required|trim'),
                'city' => array('label' => 'link url', 'rules' => 'required|trim'),
            );

            //$tax = number_format($price * .095, 2); // Set tax
            //$amount = number_format($price + $tax, 2); // Set total amount
            //load AuthorizeNetAIM
            $this->load->library('authorizenet') or die('error');
            $transaction = new AuthorizeNetAIM;
            $transaction->setFields(
                    /* array(
                      'amount' => '10.00',
                      'card_num' => '6011000000000012',
                      'exp_date' => '04/17',
                      'first_name' => 'John',
                      'last_name' => 'Doe',
                      'address' => '123 Main Street',
                      'city' => 'Boston',
                      'state' => 'MA',
                      'country' => 'USA',
                      'zip' => '02142',
                      'email' => 'some@email.com',
                      'card_code' => '782',
                      ) */
                    array(
                        'amount' => $amount,
                        'card_num' => $this->input->post('card'),
                        'exp_date' => $this->input->post('mm') . "/" . $this->input->post('yy'),
                        'first_name' => $this->input->post('fname'),
                        'last_name' => $this->input->post('lname'),
                        'address' => $this->input->post('address'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'country' => $this->input->post('country'),
                        'email' => $this->input->post('email'),
                        'card_code' => $this->input->post('code'),
                    )
            );
            $response = $transaction->authorizeAndCapture();
            if ($response->approved) {


                $this->core->set['status'] = '1';


                if (isset($response->transaction_id) and isset($response->authorization_code)) {
                    $this->core->set['transaction_id'] = $response->transaction_id;
                    $this->core->set['auth_code'] = $response->authorization_code;
                }


                $this->core->set['bil_fname'] = $this->input->post('fname');
                $this->core->set['bil_lname'] = $this->input->post('lname');
                $this->core->set['bil_address'] = $this->input->post('address') .
                        "," . $this->input->post('city') .
                        "," . $this->input->post('state') .
                        "," . $this->input->post('country');
                $this->core->set['bil_email'] = $this->input->post('email');
                $this->core->set['bil_phone'] = $this->input->post('phone');
                $where = array('order_id' => $orderID);
                //$where = "";


                if ($this->core->update('orders', $where)) {

                    $orderID = $this->db->insert_id();

                    //set credit in user table
                    $this->core->set['link_credit'] = $data[0]['no_of_credit'];
                    $whereUser['userID'] = $this->session->userdata('userID');
                    $this->core->update('users', $whereUser);


                    // where to redirect to
                    $this->redirect = 'links?status=1';
                    redirect($this->redirect);
                    // where to redirect to
                    //  redirect($this->redirect);
                }
            } else {
                $output['errors'] = "Access Denied.Please enter Correct Information.";
            }
        }

        $this->pages->view('payment', $output, TRUE);
        //$output['page:title'] = 'Payment'; //page title set 
        //$this->pages->view('payment', $output, TRUE);
    }

    function history() {
        if (!$this->session->userdata('session_user')) {
            redirect('/users/login/' . $this->core->encode($this->uri->uri_string()));
        }
        // grab data and display
        $where['userID'] = $this->session->userdata('userID');
        $data = $this->core->viewall('orders', $where, array('order_id', 'desc'));
        $orderData = $data['orders'];


        foreach ($orderData as $value) {

            //echo $value['order_id'];die;
            $output['plans'][] = array("plan" => $value['plan_name'],
                "expire_date" => date('d-m-y', strtotime($value['expire_date'])),
                "purchase_date" => date('d-m-y', strtotime($value['date'])),
                "amount" => $value['plan_price'],
                "credit" => $value['no_of_credit'],
                "per_day_credit" => $value['per_day_limit'],
            );
        }


        // set pagination
        $output['pagination'] = ($pagination = $this->pagination->create_links()) ? $pagination : '';
        // display with cms layer


        $output['page:title'] = 'My Account'; //page title set

        $this->pages->view('history', $output, TRUE);
    }

}
