

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReactApi extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('reactapi_model');
  }
  
  public function employees()
  { 
    header("Access-Control-Allow-Origin: *");

    $products = $this->reactapi_model->get_employees();

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($products));
  }
  public function getEmployee()
  { 
    header("Access-Control-Allow-Origin: *");

    $productId = $this->input->post('productId');

    $product = $this->reactapi_model->get_employee($productId);

    $productData = array(
      'id' => $product->id,
      'name' => $product->name,
      'position' => $product->position,
      'office' => $product->office,
      'extn' => $product->extn,
      'salary' => $product->salary
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($productData));
  }

  public function createEmployee()
  { 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");

    $formdata = json_decode(file_get_contents('php://input'), true);

    if( ! empty($formdata)) {

        $name = $formdata['name'];
        $position = $formdata['position'];
        $office = $formdata['office'];
        $extn=$formdata['extn'];
        $salary = $formdata['salary'];
      
      $productData = array(
        'name' => $name,
        'position' => $position,
        'office' => $office,
        'extn' => $extn,
        'salary' => $salary,
        'is_active' => 1,
        
      );

      $id = $this->reactapi_model->insert_employee($productData);

      $response = array(
        'status' => 'success',
        'message' => 'Added successfully'
      );
    }
    else {
      $response = array(
        'status' => 'error'
      );
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }

  public function editEmployee()
  { 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");

    $formdata = json_decode(file_get_contents('php://input'), true);

    if( ! empty($formdata)) {

      $id = $formdata['id'];
        $name = $formdata['name'];
        $position = $formdata['position'];
        $office = $formdata['office'];
        $extn=$formdata['extn'];
        $salary = $formdata['salary'];
      
      $productData = array(
        'name' => $name,
        'position' => $position,
        'office' => $office,
        'extn' => $extn,
        'salary' => $salary,
        
      );

      $id = $this->reactapi_model->update_employee($id, $productData);

      $response = array(
        'status' => 'success',
        'message' => 'Updated successfully.'
      );
    }
    else {
      $response = array(
        'status' => 'error'
      );
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }

  public function deleteEmployee()
  { 
    header("Access-Control-Allow-Origin: *");

    $productId = $this->input->post('productId');

    $product = $this->reactapi_model->delete_employee($productId);

    $response = array(
      'message' => 'Deleted successfully.'
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }

  public function registrationApi()
  { 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");

    $formdata = json_decode(file_get_contents('php://input'), true);

    if( ! empty($formdata)) {

        $name = $formdata['name'];
        $email = $formdata['email'];
        $password = $formdata['password'];
       
      
      $registrationData = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
        
        
      );

      $id = $this->reactapi_model->registration($registrationData);

      $response = array(
        'status' => 'success',
        'message' => 'Registration complete'
      );
    }
    else {
      $response = array(
        'status' => 'error'
      );
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }
  public function login()
  {
      
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
      $formdata = json_decode(file_get_contents('php://input'), true);

    
    $password = $formdata['password'];
        $email = $formdata['email'];
    

    $product = $this->reactapi_model->login($email, $password);
    if($product) {
      
    $response = array(
      'status' => 200,
      'message' => 'Login complete'
    );
    } else {
      $response = array(
        'status' => 401
      );
    }
  
    
    
     $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));

  }
  
}


?>

