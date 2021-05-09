<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('instamojo_payment_model');
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
            $orderId = $this->instamojo_payment_model->generateOrderId();
            $instamojoFormData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('emailaddress'),
                'phone' => $this->input->post('mobilenumber'),
                'amount' => $this->input->post('amount_money'),
                'order_id' => $orderId
            );

            $_SESSION['order_id'] = $orderId;

            $this->instamojo_payment_model->saveInstamojoformData($instamojoFormData);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array("X-Api-Key:test_df406f64400e8da6296a329bac4",
                    "X-Auth-Token:test_de8e1aa77802464e2cd41b14b95"));
            $payload = Array(
                'purpose' => 'Learning Integration of Payment portal',
                'amount' => $this->input->post('amount_money'),
                'phone' => $this->input->post('mobilenumber'),
                'buyer_name' => $this->input->post('name'),
                'redirect_url' => 'http://127.0.0.1/payment_gateway_projects/instamojo_gateway/payment_result_page',
                'send_email' => true,
                //'webhook' => 'http://www.example.com/webhook/',
                'send_sms' => true,
                'email' => $this->input->post('emailaddress'),
                'allow_repeated_payments' => false
            );
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $_SESSION['TID'] = $response->payment_request->id;
            header('location:'.$response->payment_request->longurl);
            //echo $response;

        }
    }

}
