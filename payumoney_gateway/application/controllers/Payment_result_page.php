<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_result_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('payumoney_payment_result_model');
    }

    public function index()
    {
        $this->load->helper('url');

        $postdata = $_POST;
        $msg = '';
        if (isset($postdata ['key'])) {
            $key				=   $postdata['key'];
            $salt				=   $postdata['salt'];
            $txnid 				= 	$postdata['txnid'];
            $amount      		= 	$postdata['amount'];
            $productInfo  		= 	$postdata['productinfo'];
            $firstname    		= 	$postdata['firstname'];
            $email        		=	$postdata['email'];
            $udf5				=   $postdata['udf5'];
            $mihpayid			=	$postdata['mihpayid'];
            $status				= 	$postdata['status'];
            $resphash				= 	$postdata['hash'];
            //Calculate response hash to verify
            $keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
            $keyArray 	  		= 	explode("|",$keyString);
            $reverseKeyArray 	= 	array_reverse($keyArray);
            $reverseKeyString	=	implode("|",$reverseKeyArray);
            $CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));


            if ($status == 'success'  && $resphash == $CalcHashString) {
                $msg = "Transaction Successful and Hash Verified...";
                //Do success order processing here...
            }
            else {
                //tampered or failed
                $msg = "Payment failed for Hasn not verified...";
            }
        }
        else exit(0);

        $this->load->view('mainform_layout/payment_result_page');


        /*$paytmTransactionData = array(
            'transaction_id' => $_POST['TXNID'],
            'payment_mode' => $_POST['PAYMENTMODE'],
            'payment_status' =>$_POST['STATUS'],
            'bank_transaction_id' => $_POST['BANKTXNID'],
            'bank_name' => $_POST['BANKNAME']
        );

        $this->paytm_payment_result_model->updatePaymentStatus($paytmTransactionData,$_SESSION['order_id']);*/

        //$this->load->view('mainform_layout/payment_result_page', array('transaction_Data' => $paytmTransactionData));

    }
}