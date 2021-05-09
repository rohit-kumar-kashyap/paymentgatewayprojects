<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class Mainform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('razorpay_payment_model');
    }
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('mainform_layout/index');
    }
    public function savedata()
    {
        if ($this->input->post('submit_form')) {
            $orderId = $this->razorpay_payment_model->generateOrderId();
            $razorpayFormData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('emailaddress'),
                'phone' => $this->input->post('mobilenumber'),
                'amount' => $this->input->post('amount_money'),
                'order_id' => $orderId
            );

            $_SESSION['order_id'] = $orderId;

            $this->razorpay_payment_model->saveRazorpayformData($razorpayFormData);

            $api = new Api(RAZOR_KEY, RAZOR_SECRET_KEY);

            $razorpayOrder = $api->order->create(array(
                'receipt' => rand(),
                'amount' => $this->input->post('amount_money') * 100,//2000 * 100, // 2000 rupees in paise
                'currency' => 'INR',
                'payment_capture' => 1 // auto capture
            ));
            $amount = $this->input->post('amount_money');

            $razorpayOrderId = $razorpayOrder['id'];

            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            $data = $this->prepareData($amount, $razorpayOrderId);
            $this->load->view('mainform_layout/automatic',array('data' => $data));
        }
    }
    /**
     * This function preprares payment parameters
     * @param $amount
     * @param $razorpayOrderId
     * @return array
     */
    public function prepareData($amount,$razorpayOrderId)
    {
        $data = array(
            "key" => RAZOR_KEY,
            "amount" => $amount,
            "name" => "Testing Form",
            "description" => "Testing Form description",
            "image" => "",
            "prefill" => array(
                "name"  => $this->input->post('name'),
                "email"  => $this->input->post('emailaddress'),
                "contact" => $this->input->post('mobilenumber'),
            ),
            "notes"  => array(
                "address"  => "Lal bangla Kanpur",
                "merchant_order_id" => rand(),
            ),
            "theme"  => array(
                "color"  => "#F37254"
            ),
            "order_id" => $razorpayOrderId,
        );
        return $data;
    }
}
