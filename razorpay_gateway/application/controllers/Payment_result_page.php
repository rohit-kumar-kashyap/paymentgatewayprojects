<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Payment_result_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('razorpay_payment_result_model');
    }

    public function index()
    {
        $this->load->helper('url');
        $success = true;
        $error = "payment_failed";
        if (empty($_POST['razorpay_payment_id']) === false) {
            $api = new Api(RAZOR_KEY, RAZOR_SECRET_KEY);
            try {
                $attributes = array(
                    'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
                $api->utility->verifyPaymentSignature($attributes);
            } catch(SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay_Error : ' . $e->getMessage();
            }
        }

        if ($success === true && isset($_POST['razorpay_payment_id'])!='') {
            $_SESSION['PAYMENT_STATUS'] = true;

            $data = array(
                'payment_status' => 1,
                'payment_id' => $_POST['razorpay_payment_id'],
                'transaction_id' => $_SESSION['razorpay_order_id'],
            );
        }
        else {
            $_SESSION['PAYMENT_STATUS'] = false;
            $data = array(
                'payment_status' => 0,
                'payment_id' => ( isset($_POST['razorpay_payment_id'])? $_POST['razorpay_payment_id']: null),
                'transaction_id' => $_SESSION['razorpay_order_id'],
            );
        }
        $this->razorpay_payment_result_model->updatePaymentStatus($data, $_SESSION['order_id']);
        $this->load->view('mainform_layout/payment_result_page');
        //$this->load->view('mainform_layout/payment_result_page', array('transaction_Data' => $paytmTransactionData));

    }
}