<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/config_paytm.php');
require_once(APPPATH.'libraries/encdec_paytm.php');

class Mainform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('paytm_payment_model');
    }
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('mainform_layout/index');
    }
    public function savedata()
    {
        if ($this->input->post('submit_form')) {
            $orderId = $this->paytm_payment_model->generateOrderId();
            $paytmFormData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('emailaddress'),
                'phone' => $this->input->post('mobilenumber'),
                'amount' => $this->input->post('amount_money'),
                'order_id' => $orderId
            );

            $_SESSION['order_id'] = $orderId;

            $this->paytm_payment_model->savePaytmformData($paytmFormData);

            $checkSum = "";
            $paramList = array();

            $buyername = $this->input->post('name');
            $buyeremail = $this->input->post('emailaddress');
            $buyermobileno = $this->input->post('mobilenumber');
            $paymentmoney = $this->input->post('amount_money');

            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = PAYTM_MERCHANT_MID;
            $paramList["ORDER_ID"] = $orderId;
            $paramList["CUST_ID"] = rand();
            $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
            $paramList["CHANNEL_ID"] = 'WEB';
            $paramList["TXN_AMOUNT"] = $paymentmoney;
            $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
            $paramList["CALLBACK_URL"] = base_url().'Payment_result_page/index';
            $paramList["MSISDN"] = 9952525255; //Mobile number of customer
            $paramList["EMAIL"] = 'abc@gmial.com'; //Email ID of customer
            $paramList["VERIFIED_BY"] = "EMAIL"; //
            $paramList["IS_USER_VERIFIED"] = "YES"; //

            $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
?>
            <center><h1>Please do not refresh this page...</h1></center>
            <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
                <table border="1">
                    <tbody>
                        <?php
                            foreach($paramList as $name => $value) {
                                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                            }
                        ?>
                        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
                    </tbody>
                </table>
                <script type="text/javascript">
                    document.f1.submit();
                </script>
            </form>
<?php

        }
    }
}
