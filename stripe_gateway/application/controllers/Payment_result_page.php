<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_result_page extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('stripe_payment_result_model');
    }

    public function index()
    {
        $this->load->helper('url');

        /*$paymentData = array(
            'transaction_id' => $_SESSION['TID'],
            'payment_id' => $_REQUEST['payment_id'],
            'payment_status' => $_REQUEST['payment_status'],
            'payment_request_id' => $_REQUEST['payment_request_id'],
        );
        $this->instamojo_payment_result_model->updatePaymentStatus($paymentData,$_SESSION['order_id']);

        $this->load->view('mainform_layout/payment_result_page',array('payment_data' => $paymentData));*/
        $this->load->view('mainform_layout/payment_result_page');
    }
}