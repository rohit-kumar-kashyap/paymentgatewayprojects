<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //$this->load->library('stripe-php-master');
        //$this->load->library('config');
        $this->load->model('stripe_payment_model');
    }
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('mainform_layout/index');
    }
    public function savedata()
    {
        if($this->input->post('submit_form'))
        {
            $orderId = $this->stripe_payment_model->generateOrderId();
            $stripeFormData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('emailaddress'),
                'phone' => $this->input->post('mobilenumber'),
                'amount' => $this->input->post('amount_money'),
                'order_id' => $orderId
            );

            $_SESSION['order_id'] = $orderId;

            $this->stripe_payment_model->saveStripeformData($stripeFormData);

        }
    }
}
