<?php
class Instamojo_payment_model extends CI_Model
{

    function saveInstamojoformData($instamojoFormData)
    {
        //print_r($instamojoFormData);
        $this->db->insert('instamojo_payment_form', $instamojoFormData);
        return $this->db->insert_id();
    }

    /*function updateInstamojoformData($transaction_id){

    }*/

    /**
     * This function generates unique wallet request id
     * @scope local
     * @return string
     */
    public function generateOrderId()
    {
        $random = substr(mt_rand(),0,5);
        $orderNumber = 'ORDER'.$random;
        $query = $this->db->get_where('instamojo_payment_form',array('order_id'=>$orderNumber));
        if ($query->num_rows() > 0){
            $this->generateOrderId();
        }
        return $orderNumber;
    }


}