<?php
class Paytm_payment_model extends CI_Model
{

    function savePaytmformData($paytmFormData)
    {
        $this->db->insert('paytm_payment_form', $paytmFormData);
        return $this->db->insert_id();
    }

    /**
     * This function generates unique wallet request id
     * @scope local
     * @return string
     */
    public function generateOrderId()
    {
        $random = substr(mt_rand(),0,5);
        $orderNumber = 'ORDER'.$random;
        $query = $this->db->get_where('paytm_payment_form',array('order_id'=>$orderNumber));
        if ($query->num_rows() > 0){
            $this->generateOrderId();
        }
        return $orderNumber;
    }


}