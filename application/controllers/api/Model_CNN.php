
<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 24/11/2018
 * Time: 21:00
 */

class Model_CNN extends REST_Controller
{

    public function check_exist_and_insert_hash_model_post()
    {
        $data = $this->post();
        $this->load->model('hash_models_network_neurol');
//        var_dump($data);die;
        if ($this->hash_models_network_neurol->check_exist($data)) {
            $this->response([
                'status' => true,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->hash_models_network_neurol->instert_sha256($data);
            $this->response([
                'status' => false,
            ], REST_Controller::HTTP_OK);
        }


    }
}