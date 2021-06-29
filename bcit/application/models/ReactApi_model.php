
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReactApi_model extends CI_model {
  
  public function get_employees()
  {
    $this->db->where('is_active', 1);
    $query = $this->db->get('details');
    return $query->result();
  }
  public function get_employee($productId)
  {
    $this->db->where('is_active', 1);
    $this->db->where('id', $productId);
    $query = $this->db->get('details');
    return $query->row();
  }

   public function insert_employee($productData)
  {
    $this->db->insert('details', $productData);
    return $this->db->insert_id();
  }
  public function update_employee($id, $productData)
  {
    $this->db->where('id', $id);
    $this->db->update('details', $productData);
  }
   public function delete_employee($productId)
  {
    $this->db->where('id', $productId);
    $this->db->delete('details');
  }
  public function registration($registrationData)
  {
    $this->db->insert('login', $registrationData);
    return $this->db->insert_id();
  }
  public function login($email, $password)
    {
     
        $this->db->where('email', $email);
        $this->db->where('password', $password);
       
        $query = $this->db->get('login');

        if($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }
}
?>
