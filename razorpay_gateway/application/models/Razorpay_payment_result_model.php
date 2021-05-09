<?php
class Razorpay_payment_result_model extends CI_Model
{
    public function updatePaymentStatus($data, $orderId)
    {
        $this->db->where('order_id',$orderId);
        return $this->db->update('razorpay_payment_form', $data);
    }
}