<?php
define('BASEPATH') OR exit('No direct script access allowed');

class Stripe_lib{
    var $CI;
    var $api_error;

    function __construct()
    {
        $this->api_error = '';
        $this->CI =& get_instance();
        $this->CI->load->config('stripe');

        require APPPATH.'third_party/stripe-php-master/init.php';

        //set API key
        \Stripe\Stripe::setApikey($this->CI->config->item('stripe_api_key'));
    }

    function details($name, $email, $token){
        try{
            $data = \Stripe\Customer::create(array(
                'name'=>$name,
                'email'=>$email,
                'source'=>$token
            ));
            return $data;
        }catch(Exception $e){
            $this->api_error = $e->getMessage();
            return false;
        }
    }
}