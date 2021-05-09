<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_result_page extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('paypal_lib');
        $this->load->model('paypal_payment_result_model');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('mainform_layout/payment_result_page');
    }
}