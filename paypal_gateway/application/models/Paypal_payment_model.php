<?php
class Paypal_payment_model extends CI_Model
{

    function savePaypalformData($paypalFormData)
    {
        //print_r($instamojoFormData);
        $this->db->insert('paypal_payment_form', $paypalFormData);
        return $this->db->insert_id();
    }

    function insertPaypalformData($data = array()){
        $insert = $this->db->insert('paypal_payment_form',$data);
        return $insert?true:false;
    }
}