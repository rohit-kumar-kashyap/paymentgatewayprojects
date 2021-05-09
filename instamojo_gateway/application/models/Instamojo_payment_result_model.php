<?php
class Instamojo_payment_result_model extends CI_Model
{
    public function updatePaymentStatus($paymentData,$orderId)
    {
        $this->db->where('order_id',$orderId);
        return $this->db->update('instamojo_payment_form', $paymentData);
    }
}