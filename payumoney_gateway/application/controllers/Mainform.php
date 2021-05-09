<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('payumoney_payment_model');
    }
    public function index()
    {
        $this->load->helper('url');
        $callbackUrl = $this->getCallbackUrl();
        $this->load->view('mainform_layout/index',array('callback_url' => $callbackUrl));
    }

    function getCallbackUrl()
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'payment_result_page';
    }

    function getHash(){
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
            //Request hash
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            if(strcasecmp($contentType, 'application/json') == 0){
                $data = json_decode(file_get_contents('php://input'));
                $hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
                $json=array();
                $json['success'] = $hash;
                echo json_encode($json);

            }
            exit(0);
        }
    }
    public function savedata()
    {

        if ($this->input->post('submit_form')) {
            $orderId = $this->payumoney_payment_model->generateOrderId();
            $payumoneyFormData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('emailaddress'),
                'phone' => $this->input->post('mobilenumber'),
                'amount' => $this->input->post('amount_money'),
                'order_id' => $orderId
            );

            $_SESSION['order_id'] = $orderId;

            $this->payumoney_payment_model->savePayumoneyformData($payumoneyFormData);
        }
    }
}
