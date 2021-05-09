<?php
class Paypal_payment_result_model extends CI_Model
{

    function updatePaypalformData($updatedPaypalFormData)
    {
        $this->db->where('id', $rowid);
        $this->db->update('paypal_payment_form', $updatedPaypalFormData);

        return $this->db->insert_id();
    }

}