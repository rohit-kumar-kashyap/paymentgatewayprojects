<?php
class Paytm_payment_result_model extends CI_Model
{
    public function updatePaymentStatus($paytmTransactionData, $orderId)
    {
        $this->db->where('order_id',$orderId);
        return $this->db->update('paytm_payment_form', $paytmTransactionData);
    }
}