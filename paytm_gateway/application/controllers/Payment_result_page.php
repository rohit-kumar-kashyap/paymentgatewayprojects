<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/config_paytm.php');
require_once(APPPATH.'libraries/encdec_paytm.php');

class Payment_result_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('paytm_payment_result_model');
    }

    public function index()
    {
        $this->load->helper('url');

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";

        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


    /*    if($isValidChecksum == "TRUE") {
            echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                echo "<b>Transaction status is success</b>" . "<br/>";
                //Process your transaction here as success transaction.
                //Verify amount & order id received from Payment gateway with your application's order id and amount.
            }
            else {
                echo "<b>Transaction status is failure</b>" . "<br/>";
            }

            if (isset($_POST) && count($_POST)>0 )
            {
                foreach($_POST as $paramName => $paramValue) {
                    echo "<br/>" . $paramName . " = " . $paramValue;
                }
            }
        }
        else {
            echo "<b>Checksum mismatched.</b>";
            //Process transaction as suspicious.
        }
    */

        $paytmTransactionData = array(
            'transaction_id' => $_POST['TXNID'],
            'payment_mode' => $_POST['PAYMENTMODE'],
            'payment_status' =>$_POST['STATUS'],
            'bank_transaction_id' => $_POST['BANKTXNID'],
            'bank_name' => $_POST['BANKNAME']
        );

        $this->paytm_payment_result_model->updatePaymentStatus($paytmTransactionData,$_SESSION['order_id']);

        $this->load->view('mainform_layout/payment_result_page', array('transaction_Data' => $paytmTransactionData));

    }
}