<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('paypal_lib');
        $this->load->model('paypal_payment_model');
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
            $paypalFormData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('emailaddress'),
                'phone' => $this->input->post('mobilenumber'),
                'amount' => $this->input->post('amount_money')
            );

            $paypalData = $this->paypal_payment_model->savePaypalformData($paypalFormData);

            if($paypalData>0){
                echo "Records Saved Successfully";
            }
            else{
                echo "Insert error !";
            }
        }
    }
}
